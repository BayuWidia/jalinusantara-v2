<?php

namespace App\Helpers;

use Auth;

class UtilHelper
{


   public static function bytesToHuman($params)
   {
       $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

       for ($i = 0; $params > 1024; $i++) {
           $params /= 1024;
       }

       return round($params, 2) . ' ' . $units[$i];
   }

   public static function convertToIdr($params)
   {
     $hasilIdr = "Rp ".number_format($params,0,',','.');
     return $hasilIdr;
   }

}
