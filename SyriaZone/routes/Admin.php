<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\SubCategortController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('categories/get_all', [CategoryController::class, 'index']);
    Route::post('categories/store', [CategoryController::class, 'store']);
    Route::put('categories/update/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/delete/{id}', [CategoryController::class, 'destroy']);
    Route::get('/categories/show/{id}', [CategoryController::class, 'show']);

    Route::prefix('subcategories')->group(function () {
        Route::get('getall/', [SubCategortController::class, 'index']); // عرض جميع الفئات الفرعية
        Route::get('show/{id}', [SubCategortController::class, 'show']); // عرض الفئة الفرعية حسب ID
        Route::post('store', [SubCategortController::class, 'store']); // إضافة فئة فرعية جديدة
        Route::put('update/{id}', [SubCategortController::class, 'update']); // تعديل الفئة الفرعية حسب ID
        Route::delete('delete/{id}', [SubCategortController::class, 'destroy']); // حذف الفئة الفرعية حسب ID
    });
});
