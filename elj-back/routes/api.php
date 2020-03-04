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
    echo "inside";
    return $request->user();
});

Route::middleware('cors:api')->post('analize_image', function (Request $request) {
    $bodyContent = $request->getContent();
    //echo $bodyContent;
    //print_r($bodyContent);
    //print $bodyContent;
    return $bodyContent;
});




