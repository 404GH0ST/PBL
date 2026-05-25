<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAddon;
use App\Models\Contact;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CatalogController extends Controller
{
    public function index(): View
    {
        $products = $this->catalogProductsQuery()
            ->latest('id')
            ->get();

        $topProductIds = $products
            ->sortByDesc(fn (Product $product) => [
                $product->reviews_count,
                $product->reviews_avg_product_rating ?? 0,
                $product->id,
            ])
            ->take(min(4, $products->count()))
            ->pluck('id')
            ->all();

        $newProductIds = $products
            ->sortByDesc('created_at')
            ->take(min(4, $products->count()))
            ->pluck('id')
            ->all();

        $featuredProductIds = collect($topProductIds)
            ->merge($newProductIds)
            ->unique()
            ->take(4)
            ->all();

        $catalogProducts = $products
            ->map(fn (Product $product) => $this->mapCatalogProduct(
                $product,
                isNew: in_array($product->id, $newProductIds, true),
                isTop: in_array($product->id, $topProductIds, true),
                isFeatured: in_array($product->id, $featuredProductIds, true),
            ))
            ->values();

        $catalogFilters = collect([
            ['slug' => 'all', 'label' => 'Semua Produk', 'icon' => 'grid'],
        ])
            ->merge(
                $products
                    ->pluck('category')
                    ->filter()
                    ->unique('id')
                    ->values()
                    ->map(fn ($category) => [
                        'slug' => $category->slug,
                        'label' => $category->name,
                        'icon' => $this->resolveCategoryIcon($category->slug),
                    ])
            )
            ->push(['slug' => 'new', 'label' => 'Produk Baru', 'icon' => 'spark'])
            ->push(['slug' => 'top', 'label' => 'Terlaris', 'icon' => 'trophy'])
            ->values();

        return view('catalog', [
            'catalogFilters' => $catalogFilters,
            'catalogProducts' => $catalogProducts,
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load('category');
        $product->loadCount([
            'reviews' => fn ($query) => $query->where('is_visible', true),
        ]);
        $product->loadAvg([
            'reviews' => fn ($query) => $query->where('is_visible', true),
        ], 'product_rating');

        $visibleReviews = Review::query()
            ->whereBelongsTo($product)
            ->where('is_visible', true)
            ->with('order:id,customer_name')
            ->latest()
            ->get();

        $ratingBreakdown = collect(range(5, 1))
            ->mapWithKeys(fn (int $rating) => [
                $rating => $visibleReviews->where('product_rating', $rating)->count(),
            ]);

        $addons = ProductAddon::query()
            ->where('category_id', $product->category_id)
            ->orderBy('type')
            ->orderBy('price')
            ->get()
            ->groupBy('type')
            ->map(fn (Collection $items) => $items
                ->map(fn (ProductAddon $addon) => [
                    'name' => $addon->name,
                    'price' => $addon->price,
                ])
                ->values()
                ->all()
            )
            ->all();

        $recommendations = $this->catalogProductsQuery()
            ->whereKeyNot($product->getKey())
            ->orderByRaw('category_id = ? desc', [$product->category_id])
            ->orderByDesc('reviews_count')
            ->orderByDesc('reviews_avg_product_rating')
            ->latest('id')
            ->limit(4)
            ->get()
            ->map(fn (Product $recommended) => $this->mapCatalogProduct($recommended))
            ->values();

        $gallery = $this->resolveProductGallery($product);
        $reviewCount = (int) $product->reviews_count;
        $averageRating = round((float) ($product->reviews_avg_product_rating ?? 0), 1);
        $reviewState = [
            'gallery' => $gallery,
            'productName' => $product->name,
            'order' => [
                'whatsappNumber' => $this->resolveOrderWhatsappNumber(),
                'productName' => $product->name,
                'category' => $product->category?->name,
                'price' => 'Rp '.number_format($product->price, 0, ',', '.'),
                'url' => route('product.detail', $product),
            ],
            'reviews' => $visibleReviews
                ->map(fn (Review $review) => [
                    'author' => $review->order?->customer_name ?: 'Pelanggan Deenhag',
                    'avatar' => $this->resolveReviewAvatar($review),
                    'date' => $review->created_at?->locale('id')->diffForHumans() ?? 'Baru saja',
                    'title' => $this->resolveReviewTitle($review),
                    'comment' => $review->comment ?: 'Pelanggan belum meninggalkan komentar tertulis.',
                    'rating' => (int) $review->product_rating,
                ])
                ->values(),
            'breakdown' => collect(range(5, 1))
                ->map(fn (int $rating) => [
                    'rating' => $rating,
                    'count' => $ratingBreakdown[$rating] ?? 0,
                    'percent' => $reviewCount > 0
                        ? (int) round((($ratingBreakdown[$rating] ?? 0) / $reviewCount) * 100)
                        : 0,
                ])
                ->values(),
        ];

        return view('product-detail', [
            'product' => $product,
            'productGallery' => $gallery,
            'productPrimaryImage' => $gallery[0] ?? null,
            'productAverageRating' => $averageRating,
            'productReviewCount' => $reviewCount,
            'productReviewCountLabel' => $this->formatReviewCount($reviewCount),
            'productOptions' => $addons,
            'productRecommendations' => $recommendations,
            'productDetailState' => $reviewState,
        ]);
    }

    protected function catalogProductsQuery()
    {
        return Product::query()
            ->where('is_active', true)
            ->with('category:id,name,slug')
            ->withCount([
                'reviews' => fn ($query) => $query->where('is_visible', true),
            ])
            ->withAvg([
                'reviews' => fn ($query) => $query->where('is_visible', true),
            ], 'product_rating');
    }

    protected function mapCatalogProduct(
        Product $product,
        bool $isNew = false,
        bool $isTop = false,
        bool $isFeatured = false,
    ): array {
        $reviewCount = (int) ($product->reviews_count ?? 0);
        $averageRating = round((float) ($product->reviews_avg_product_rating ?? 0), 1);

        return [
            'slug' => $product->slug,
            'title' => $product->name,
            'category' => $product->category?->slug ?? 'other',
            'category_label' => $product->category?->name ?? 'Produk',
            'image' => $this->resolveProductImage($product),
            'rating' => $averageRating > 0 ? $averageRating : 5.0,
            'reviews' => $this->formatReviewCount($reviewCount),
            'price' => (int) $product->price,
            'is_new' => $isNew,
            'is_top' => $isTop,
            'featured' => $isFeatured,
            'detail_url' => route('product.detail', $product),
        ];
    }

    protected function resolveProductImage(Product $product): string
    {
        if ($product->image_path) {
            if (Str::startsWith($product->image_path, ['http://', 'https://', '/storage/', '/images/'])) {
                return Str::startsWith($product->image_path, '/')
                    ? asset(ltrim($product->image_path, '/'))
                    : $product->image_path;
            }

            return Storage::disk('public')->url($product->image_path);
        }

        return match ($product->category?->slug) {
            'jersey' => asset('images/catalog/kaos-black.png'),
            'banner-spanduk' => asset('images/catalog/tripod-banner.png'),
            'stempel' => asset('images/catalog/kartu-nama.png'),
            default => asset('images/product/konveksi-apparel.png'),
        };
    }

    protected function resolveProductGallery(Product $product): array
    {
        $primaryImage = $this->resolveProductImage($product);

        $fallbacks = match ($product->category?->slug) {
            'jersey' => [
                asset('images/hero/jersey-front-new.png'),
                asset('images/hero/jersey-back-new.png'),
                asset('images/hero/jersey-front-clean.png'),
                asset('images/hero/jersey-back-clean.png'),
            ],
            'banner-spanduk' => [
                asset('images/catalog/banner-custom.png'),
                asset('images/catalog/tripod-banner.png'),
                asset('images/catalog/standing-banner.png'),
                asset('images/catalog/photobooth.png'),
            ],
            'stempel' => [
                asset('images/catalog/kartu-nama.png'),
                asset('images/catalog/paraloid.png'),
                asset('images/catalog/poster-piala.png'),
                asset('images/product/kebutuhan-bisnis.png'),
            ],
            default => [$primaryImage],
        };

        return collect([$primaryImage])
            ->merge($fallbacks)
            ->filter()
            ->unique()
            ->take(4)
            ->values()
            ->all();
    }

    protected function resolveCategoryIcon(string $slug): string
    {
        return match ($slug) {
            'jersey' => 'jersey',
            'banner-spanduk' => 'banner',
            'stempel' => 'dots',
            default => 'grid',
        };
    }

    protected function resolveReviewAvatar(Review $review): string
    {
        return match ($review->product_id % 2) {
            0 => asset('images/testimonials/fahrul-kz.png'),
            default => asset('images/testimonials/ajeng-febria.png'),
        };
    }

    protected function resolveReviewTitle(Review $review): string
    {
        return match (true) {
            $review->product_rating >= 5 => 'Saya sangat menyukai produk ini!',
            $review->product_rating >= 4 => 'Produk sesuai harapan.',
            $review->product_rating >= 3 => 'Produknya cukup baik.',
            default => 'Masih ada yang perlu ditingkatkan.',
        };
    }

    protected function formatReviewCount(int $reviewCount): string
    {
        if ($reviewCount >= 1000) {
            return round($reviewCount / 1000, 1).'K';
        }

        return (string) $reviewCount;
    }

    protected function resolveOrderWhatsappNumber(): ?string
    {
        $number = Contact::query()
            ->where('is_active', true)
            ->value('whatsapp_number');

        if (! $number) {
            return null;
        }

        $digits = preg_replace('/\D+/', '', $number);

        if (! $digits) {
            return null;
        }

        if (Str::startsWith($digits, '0')) {
            return '62'.substr($digits, 1);
        }

        return $digits;
    }
}
