<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        // Redirect to the shopping list index route if authenticated
        return redirect()->route('shopping-list.index');
    }
    return view('index');
});

// Shopping List Routes (Resource)
Route::resource('shopping-list', ShoppingListController::class)
    ->middleware(['auth', 'verified'])
    ->except(['show']);

Route::post('/shopping-list/{itemId}/check', [ShoppingListController::class, 'checkItem'])
    ->middleware(['auth', 'verified'])
    ->name('shopping_list.check');

Route::post('/shopping-list/reorder', [ShoppingListController::class, 'reorder'])
    ->middleware(['auth', 'verified'])
    ->name('shopping_list.reorder');

Route::post('/shopping-list/reorder', [ShoppingListController::class, 'reorder'])
    ->middleware(['auth', 'verified'])
    ->name('shopping_list.reorder');

Route::controller(UserProfileController::class)->prefix('set-budget')->group(function () {
    Route::get('/', 'showSetBudgetForm')->name('set-budget');
    Route::post('/', 'saveBudget')->name('save-budget');
});

Route::controller(EmailController::class)->prefix('send_email')->group(function () {
    Route::get('/{id}', 'index')->name('email.index'); // accepts id for index
    Route::post('/{id}', 'sendEmail')->name('email.send'); // accepts id for sendEmail
});


require __DIR__ . '/auth.php';
