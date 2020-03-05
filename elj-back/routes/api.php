<?php

use Illuminate\Http\Request;
use App\ColorAnalyzer\ColorAnalyzer;

Route::middleware('cors:api')->post('analize_image', function (Request $request) {
    $bodyContent = $request->file('file');
    $analycer = new ColorAnalyzer();
    return $analycer->analize($bodyContent);
});




