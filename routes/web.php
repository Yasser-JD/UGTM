<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories/{slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/debug-post', function () {
    $post = \App\Models\Post::latest()->first();
    if (!$post) return 'No posts found.';
    
    return [
        'title' => $post->title,
        'image_type' => gettype($post->image),
        'image_count' => is_array($post->image) ? count($post->image) : 1,
        'image_content' => $post->image,
        'raw_image' => $post->getRawOriginal('image'),
    ];
});

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/complaints/create', [App\Http\Controllers\ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [App\Http\Controllers\ComplaintController::class, 'store'])->name('complaints.store');
});


