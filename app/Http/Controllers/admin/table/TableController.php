<?php

namespace App\Http\Controllers\admin\table;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableController extends Controller
{
     //
     public function __construct()
     {
         $this->middleware('auth');
     }
 
     //vista del crud tables con livewire
     public function index()
     {
         return view('admin.table.index');
     }
}
