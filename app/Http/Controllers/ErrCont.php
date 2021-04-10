<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrCont extends Controller
{
    public function not_authorize()
    {
        return "NOT AUTHORIZE";
    }
}
