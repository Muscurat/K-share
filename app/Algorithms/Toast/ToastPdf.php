<?php

namespace App\Algorithms\Toast;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Milon\Barcode\DNS2D;

class ToastPdf
{

    public function __construct()
    {
    }

    public function printToastPdf($domain, $specialty, $author, $text, $title){

        $mytime = Carbon::now();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<table style="margin-top: -35px;margin-left: -28px;" width="180">
                           <tr style="font-size: 9.5px;color: dimgrey;">
                              <td style="width: 100%;">
                                  Ticket number :
                              </td>
                              <td style="width: 100%;">
                                 115
                              </td>  
                           </tr >
                           <tr style="font-size: 9.5px;color: slategray;">
                              <td style="width: 50%;">
                                    Date :
                              </td>
                              <td style="width: 70%;">
                                   '.$mytime->toDateTimeString().'
                              </td>
                           </tr>
                           <tr style="font-size: 9.5px;color: slategray;">
                              <td style="width: 50%;">
                                    Domain :
                              </td>
                              <td style="width: 70%;">
                                   '.$domain.'
                              </td>
                        
                           </tr>
                           <tr style="font-size: 9.5px;color: slategray;">
                              <td style="width: 50%;">
                                    Specialty :
                              </td>
                              <td style="width: 70%;">
                                   '.$specialty.'
                              </td>
                        
                           </tr>
                           <tr class="spacer"><td></td></tr><tr class="spacer"><td></td></tr><tr class="spacer"><td></td></tr><tr class="spacer"><td></td></tr><tr class="spacer"><td></td></tr><tr class="spacer"><td></td></tr><tr class="spacer"><td></td></tr><tr class="spacer"><td></td></tr>
                           <tr style="font-size: 25px;color: black;text-align: center;">
                              <td colspan="2"><b><i>'.$title.'</i></b></td>
                           </tr>
                           <tr style="font-size: 20px;color: black;font-family: Arial;">
                              <td colspan="2"><p>'.$text.'</p></td>
                           </tr>
                            <tr style="font-size: 12px;color: #0056b3;">
                              <td colspan="2">
                                  <span>By :</span><span style="display:inline-block; width: 20px;"></span><span>'.$author.'</span>
                              </td>                              
                           </tr>
                        </table>

                       <img style="position: absolute;left: 130px;top: 357px;" src="data:image/png;base64,'.DNS2D::getBarcodePNG("https://thecodingstuff.com", "QRCODE" ,4 ,4).'" alt="barcode"   />
                       <img src="'.public_path().'/Photos/dustbin.png" style="position: absolute;left: -30px;top: 435px;" width="30" height="30"/>');
        $pdf->setPaper([0, 0, 210, 360]);
        return $pdf;

    }

}