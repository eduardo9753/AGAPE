<?php

namespace App\Http\Controllers\waitress\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuOrder extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
}
