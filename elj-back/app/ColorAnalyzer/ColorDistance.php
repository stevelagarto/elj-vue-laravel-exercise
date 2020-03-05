<?php

namespace App\ColorAnalyzer;

class ColorDistance {
  public function calculateColorDistance ($r, $g, $b) {
    $hex = "#FFFFFF";

    list($r1, $g1, $b1) = sscanf($hex, "#%02x%02x%02x");
    
    $colorDistance = sqrt(abs($r-$r1)^2+abs($g-$g1)^2+abs($b-$b1)^2);
    return $colorDistance;
  }
}