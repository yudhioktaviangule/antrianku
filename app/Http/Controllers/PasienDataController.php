<?php

namespace App\Http\Controllers;

use App\Models\Antri;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasienDataController extends Controller
{
    public function generateAntri()
    {
        $hari = Carbon::now()->format("Y-m-d 00:00:00");
        $hariEnd = Carbon::now()->addDays(1)->format("Y-m-d 00:00:00");
        $antriCount = Antri::whereBetween('created_at',[$hari,$hariEnd])->max('nomor');
        if(!$antriCount==NULL):
            $antriCount = intval(substr($antriCount,1,(strlen($antriCount)-1)));
        endif;
        $antric = $antriCount==NULL? 0 : $antriCount;
        $antriCount=$antric+1;
        $p =  "A".sprintf("%04d",$antriCount);
        return $p;
    }
}
