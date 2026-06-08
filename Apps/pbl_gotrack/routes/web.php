<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\OrderInvoiceController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $contact = \Illuminate\Support\Facades\Schema::hasTable('contacts')
        ? \App\Models\Contact::where('is_active', true)->latest()->first()
        : null;

    $reviews = \Illuminate\Support\Facades\Schema::hasTable('reviews')
        ? \App\Models\Review::where('is_visible', true)
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

    return view('welcome', compact('contact', 'testimonials'));
})->name('home');
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/katalog/{product:slug}', [CatalogController::class, 'show'])->name('product.detail');
Route::redirect('/product-detail', '/katalog');
Route::get('/lacak', [TrackingController::class, 'index'])->name('tracking.index');
Route::post('/lacak/{trackingId}/review', [TrackingController::class, 'storeReview'])->name('tracking.review');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

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
    Route::get('/admin/orders/{order}/invoice/download', [OrderInvoiceController::class, 'download'])
        ->name('admin.orders.invoice.download');
});

require __DIR__.'/auth.php';
