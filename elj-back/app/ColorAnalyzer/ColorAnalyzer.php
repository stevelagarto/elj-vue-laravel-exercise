<?php

namespace App\ColorAnalyzer;

class ColorAnalyzer {
  public function analize($image) {
    try {
      $image_type = exif_imagetype($image);
      $filepath = $image;

      switch ($image_type) {
        case IMAGETYPE_GIF :
            $im = imageCreateFromGif($filepath);
        break;
        case IMAGETYPE_JPEG :
            $im = imageCreateFromJpeg($filepath);
        break;
        case IMAGETYPE_PNG :
            $im = imageCreateFromPng($filepath);
        break;
        case IMAGETYPE_BMP :
            $im = imageCreateFromBmp($filepath);
        break;
      }   
    } catch (Exception $e) {
        return $e;
    }

    $rTotal = 0;
    $gTotal = 0;
    $bTotal = 0;
    $total = 0;
    for ($x=0;$x<imagesx($im);$x++) {
      for ($y=0;$y<imagesy($im);$y++) {
        $rgb = imagecolorat($im,$x,$y);
        $r   = ($rgb >> 16) & 0xFF;
        $g   = ($rgb >> 8) & 0xFF;
        $b   = $rgb & 0xFF;
        $rTotal += $r;
        $gTotal += $g;
        $bTotal += $b;
        $total++;
      }
    }

    $redAverage = round($rTotal/$total);
    $greenAverage = round($gTotal/$total);
    $blueAverage = round($bTotal/$total);

    $hexAverageColor = sprintf("#%02x%02x%02x", $redAverage, $greenAverage, $blueAverage);

    $averageHexAndRgb = [$hexAverageColor, $redAverage, $greenAverage, $blueAverage];
  
    return $hexAverageColor;  
  }
}