<?php

namespace App\Http\Controllers\waitress\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //PARA TOMAR LA ORDEN DEL CLIENTE
    public function index()
    {
        return view('waitress.order.index');
    }
}
