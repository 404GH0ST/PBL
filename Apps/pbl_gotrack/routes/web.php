<?php

use App\Http\Controllers\Admin\OrderInvoiceController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackingController;
use App\Models\Contact;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    $contact = Schema::hasTable('contacts')
        ? Contact::where('is_active', true)->latest()->first()
        : null;

    $services = Schema::hasTable('services')
        ? Service::where('is_active', true)->orderBy('sort_order')->get()
        : collect();

    $reviews = Schema::hasTable('reviews')
        ? Review::where('is_visible', true)
            ->with('order')
            ->latest()
            ->get()
        : collect();

    $testimonials = $reviews->map(function ($review) {
        return [
            'avatar' => null,
            'name' => $review->order?->customer_name ?: 'Pelanggan',
            'quote' => $review->comment ?: 'Bahan sangat bagus, kualitas luar biasa.',
            'rating' => (int) $review->product_rating,
        ];
    });

    return view('welcome', compact('contact', 'testimonials', 'services'));
})->name('home');
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/katalog/{product:slug}', [CatalogController::class, 'show'])->name('product.detail');
Route::redirect('/product-detail', '/katalog');
Route::get('/lacak', [TrackingController::class, 'index'])->name('tracking.index');
Route::get('/lacak/{trackingId}/invoice', [OrderInvoiceController::class, 'showForTracking'])
    ->middleware('throttle:10,1')
    ->name('tracking.invoice');
Route::post('/lacak/{trackingId}/review', [TrackingController::class, 'storeReview'])
    ->middleware('throttle:5,1')
    ->name('tracking.review');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])
    ->middleware('throttle:5,1')
    ->name('contact.submit');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role?->role_kode === 'customer') {
        return redirect('/');
    }

    if (in_array($user->role?->role_kode, ['superAdmin', 'admin'])) {
        return redirect()->route('filament.admin.pages.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/orders/{order}/invoice', [OrderInvoiceController::class, 'show'])
        ->name('admin.orders.invoice');
});

require __DIR__.'/auth.php';
