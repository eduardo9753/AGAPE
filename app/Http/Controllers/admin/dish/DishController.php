<?php

namespace App\Http\Controllers\admin\dish;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DishController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //vista del crud platos con livewire
    public function index()
    {
        return view('admin.dish.index');
    }
}
