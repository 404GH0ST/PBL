<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrackingReviewRequest;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrackingController extends Controller
{
    public function index(Request $request): View
    {
        $trackingId = trim((string) $request->query('tracking_id'));
        $order = null;
        $trackingItems = [];

        if ($trackingId !== '') {
            $order = Order::query()
                ->with([
                    'product.category',
                    'review',
                    'progress' => fn ($query) => $query
                        ->with(['productionStage', 'staff'])
                        ->latest(),
                ])
                ->where('tracking_id', $trackingId)
                ->first();

            if ($order) {
                $trackingItems = $this->buildTrackingItems($order);
            }
        }

        return view('tracking.index', [
            'order' => $order,
            'trackingId' => $trackingId,
            'trackingItems' => $trackingItems,
            'trackingNotFound' => $trackingId !== '' && $order === null,
        ]);
    }

    public function storeReview(StoreTrackingReviewRequest $request, string $trackingId): RedirectResponse
    {
        $order = Order::query()
            ->with(['product', 'review'])
            ->where('tracking_id', $trackingId)
            ->firstOrFail();

        abort_if($order->review !== null, 409);
        abort_if($order->status === 'cancelled', 422);

        $validated = $request->validated();

        Review::create([
            'order_id' => $order->id,
            'product_id' => $order->product_id,
            'product_rating' => $validated['rating'],
            'service_rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
            'is_visible' => false,
        ]);

        if ($order->status !== 'completed') {
            $order->update(['status' => 'completed']);
        }

        return redirect()
            ->route('tracking.index', ['tracking_id' => $trackingId])
            ->with('tracking_success', 'Terima kasih. Konfirmasi dan ulasan Anda sudah kami simpan.');
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function buildTrackingItems(Order $order): array
    {
        $items = $order->progress
            ->map(fn ($progress) => [
                'title' => $progress->title,
                'occurred_at' => $progress->created_at,
                'is_current' => false,
            ])
            ->values();

        if ($order->status === 'completed') {
            $completedAt = $order->review?->created_at ?? $order->updated_at;

            $items->prepend([
                'title' => 'Pesanan Selesai',
                'occurred_at' => $completedAt,
                'is_current' => true,
            ]);
        } elseif ($items->isNotEmpty()) {
            $items = $items->map(
                fn (array $item, int $index) => [...$item, 'is_current' => $index === 0]
            );
        }

        return $items->all();
    }
}
