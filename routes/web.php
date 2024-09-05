<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('posts/create',[PostController::class,'create'])->name('posts.create');
Route::post('posts/store',[PostController::class,'store'])->name('posts.store');
Route::get('posts/',[PostController::class,'index'])->name('posts.index');
Route::get('posts/{id}',[PostController::class,'show']);
Route::get('posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');
Route::put('posts/{post}',[PostController::class,'update'])->name('posts.update');
Route::post('posts/{id}/delete',[PostController::class,'delete'])->name('posts.delete');





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
