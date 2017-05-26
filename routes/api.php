<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('/TypeDocs', 'TypeDocController',
        [
            'only' => ['index']
        ]
    );
    Route::resource('client', 'ClientController',
        [
            'except' => ['destroy']
        ]
    );
});
Route::resource('typeWork', 'TypeWorkController',
    [
        'except' => ['destroy']
    ]
);
Route::resource('unitMeasure', 'UnitOfMeasureController',
    [
        'except' => ['destroy']
    ]
);
Route::resource('work', 'WorkController',
    [
        'except' => ['destroy']
    ]
);