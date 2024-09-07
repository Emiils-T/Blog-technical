<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('posts/',[PostController::class,'index'])->name('posts.index');
Route::get('posts/create',[PostController::class,'create'])->middleware('can:create,post')->name('posts.create');
Route::post('posts/store',[PostController::class,'store'])->middleware('can:create,post')->name('posts.store');
Route::get('posts/{post}',[PostController::class,'show'])->name('posts.show');
Route::get('posts/{post}/edit',[PostController::class,'edit'])->middleware('can:update,post')->name('posts.edit');
Route::put('posts/{post}',[PostController::class,'update'])->middleware('can:update,post')->name('posts.update');
Route::delete('posts/{post}',[PostController::class,'destroy'])->middleware('can:delete,post')->name('posts.destroy');

Route::post('posts/{post}/comments',[CommentController::class,'store'])->middleware('can:create,comment')->name('comments.store');
Route::put('posts/{post}/comments/{comment}', [CommentController::class, 'update'])->middleware('can:update,comment')->name('comments.update');
Route::delete('comments/{comment}',[CommentController::class,'destroy'])->middleware('can:delete,comment')->name('comments.destroy');

Route::get('categories/{category}/posts',[CategoryController::class,'index'])->name('category.index');
Route::get('search/',[SearchController::class,'search'])->name('search');


Route::get('/dashboard', function () {
    $posts= Post::all();
    return view('dashboard',compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
