<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Libraries\BarCode128\barcode;

class BarCodeGenerator extends Controller
{

  public function generate(){

      header("Content-Type: image/png");

      $data = Auth::user()->barCode;

      $image = barcode::image($data, 600,7);

      imagepng($image);

      imagedestroy($image);

      exit;

  }

}
