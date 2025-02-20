<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BabyController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MealRecordController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\VaccineController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});



// Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Permission Management
    Route::resource('permissions', PermissionController::class);
    Route::post('/store-user-roles', [PermissionController::class, 'addUsers'])->name('add.user.roles');
    Route::post('/add-permissions', [PermissionController::class, 'addPermissions'])->name('add.permissions');
    Route::get('/assign-permissions-view/{id}', [PermissionController::class, 'assignPermissionsView'])->name('assign.permissions.view');
    Route::post('/assign-permissions-view', [PermissionController::class, 'assignPermissions'])->name('assign.permissions');

    // User Management
    Route::get('view-users', [UserController::class, 'showUsers'])->name('users.showUsers');
    Route::get('view-other-users', [UserController::class, 'showOtherUsers'])->name('users.showOtherUsers');
    Route::resource('users', UserController::class);
    Route::get('/users/{id}/babies', [UserController::class, 'getBabies'])->name('users.babies');
    Route::get('/users/{id}/meal-plans', [UserController::class, 'getMealPlans'])->name('users.meal-plans');

    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.delete');


    // Baby Management
    Route::resource('babies', BabyController::class);
    Route::get('babies/{baby}/parents', [BabyController::class, 'viewParents'])->name('babies.parents');
    Route::get('babies/{baby}/weights', [BabyController::class, 'viewWeights'])->name('babies.weights');
    Route::get('babies/{baby}/meal-plans', [BabyController::class, 'showMealPlans'])->name('babies.meal-plans');

    Route::get('/meal-records/{id}', [MealRecordController::class, 'show'])->name('meal-records.show');

    Route::resource('recipes', RecipeController::class)->except(['show']);
    Route::resource('tags', TagController::class)->except(['show']);

    Route::get('/posts/pending', [PostController::class, 'index'])->name('posts.pending');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{postId}/comment', [PostController::class, 'commentOnPost'])->name('posts.comment');
    // Route::patch('/posts/{postId}/status', [PostController::class, 'updatePostStatus'])->name('posts.updateStatus');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/destroy/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('comments/{postId}/{commentId}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('comments/{postId}/{commentId}', [CommentController::class, 'update'])->name('comments.update');

    Route::get('/baby/summary/{id}', [BabyController::class, 'showSummary'])->name('baby.summary');

    Route::resource('blogs', BlogController::class)->except(['show']);
    Route::resource('topics', TopicController::class)->except(['show']);

    Route::resource('vaccines', VaccineController::class)->except(['show']);



});


require __DIR__.'/auth.php';
