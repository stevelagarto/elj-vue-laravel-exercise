<?php

namespace App\ColorAnalyzer;

class ColorDistance {
  public function calculateColorDistance ($r, $g, $b) {
    function hexToRgb ($hex) {
      list($red, $green, $blue) = sscanf($hex, "#%02x%02x%02x");
      
      return array($red, $green, $blue);
    }

    function rgbToHex ($rgb) {
      return sprintf("#%02x%02x%02x", $rgb[0], $rgb[1], $rgb[2]);
    }

    function compareColors($colorA, $colorB) {
      return abs($colorA[0] - $colorB[0]) + abs($colorA[1] - $colorB[1]) + abs($colorA[2] - $colorB[2]);
    }

    $colors = array(
      array(hexToRgb("#00FFFF"), "Aqua"),
      array(hexToRgb("#000000"), "Black"),
      array(hexToRgb("#0000FF"), "Blue"),
      array(hexToRgb("#FF00FF"), "Fuchsia"),
      array(hexToRgb("#808080"), "Grey"),
      array(hexToRgb("#008000"), "Green"),
      array(hexToRgb("#00FF00"), "Lime"),
      array(hexToRgb("#800000"), "Maroon"),
      array(hexToRgb("#000080"), "Navy"),
      array(hexToRgb("#808000"), "Olive"),
      array(hexToRgb("#800080"), "Purple"),
      array(hexToRgb("#FF0000"), "Red"),
      array(hexToRgb("#C0C0C0"), "Silver"),
      array(hexToRgb("#008080"), "Teal"),
      array(hexToRgb("#FFFFFF"), "White"),
      array(hexToRgb("#FFFF00"), "Yellow")
    );

    $inputColor = array($r,$g,$b);
    $selectedColor = $colors[0];
    $deviation = PHP_INT_MAX;

    foreach ($colors as $color) {
      $curDev = compareColors($inputColor, $color[0]);
      if ($curDev < $deviation) {
          $deviation = $curDev;
          $selectedColor = $color;
      }
    }
    $selectedColorName = $selectedColor[1];

    return array(rgbToHex($selectedColor[0]), $selectedColorName, rgbToHex($inputColor));
  }
}