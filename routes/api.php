<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\FlowDataController;
use App\Http\Middleware\AuthenticateDevice;

Route::prefix('v1')->middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    #Route::apiResource('auth', AuthController::class);
    Route::post('auth/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
});

Route::prefix('v1')->middleware([AuthenticateDevice::class])->group(function () {
    Route::apiResource('flow-data', FlowDataController::class);
});
Route::prefix('v1')->get('/test', function (Request $request) {
    return response()->json(['message' => 'Unauthenticated'], 403);
})->name('test');
/*Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('flow-data', FlowDataController::class);
    #Route::apiResource('incomes', IncomeController::class);
    #Route::apiResource('expenses', ExpenseController::class);
    #Route::apiResource('expense-types', ExpenseTypeController::class);
    #Route::apiResource('monthly-budget', MonthlyBudgetController::class);
});*/