<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\QuestionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// api/v1
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () { //, 'middleware' => 'auth:sanctum'
    Route::apiResources([
//        'customers' => CustomerController::class,
//        'invoices' => InvoiceController::class,
        'questions' => QuestionController::class,
    ]);

    Route::post('invoices/bulk',['uses' => 'InvoiceController@bulkStore']);

    Route::get('questions/import_excel',['uses' => 'QuestionController@import_csv_questions']);

});