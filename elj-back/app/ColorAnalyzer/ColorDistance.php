<?php

namespace App\ColorAnalyzer;

class ColorDistance {
  public function calculateColorDistance ($r, $g, $b) {
    function hexToRgb ($hex) {
      list($red, $green, $blue) = sscanf($hex, "#%02x%02x%02x");
      
      return array($red, $green, $blue);
    }

    function compareColors($colorA, $colorB) {
      return abs($colorA[0] - $colorB[0]) + abs($colorA[1] - $colorB[1]) + abs($colorA[2] - $colorB[2]);
    }

    $colors = array(
      array(hexToRgb("#00FFFF"), "AQUA"),
      array(hexToRgb("#000000"), "BLACK"),
      array(hexToRgb("#0000FF"), "BLUE"),
      array(hexToRgb("#FF00FF"), "FUCHSIA"),
      array(hexToRgb("#808080"), "GREY"),
      array(hexToRgb("#008000"), "GREEN"),
      array(hexToRgb("#00FF00"), "LIME"),
      array(hexToRgb("#800000"), "MAROON"),
      array(hexToRgb("#000080"), "NAVY"),
      array(hexToRgb("#808000"), "OLIVE"),
      array(hexToRgb("#800080"), "PURPLE"),
      array(hexToRgb("#FF0000"), "RED"),
      array(hexToRgb("#C0C0C0"), "SILVER"),
      array(hexToRgb("#008080"), "TEAL"),
      array(hexToRgb("#FFFFFF"), "WHITE"),
      array(hexToRgb("#FFFF00"), "YELLOW")
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

    return array($selectedColor[0], $selectedColor[1], $inputColor);
  }
}