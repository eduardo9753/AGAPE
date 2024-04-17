<?php

namespace App\Http\Controllers\cashier\table;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('cashier.table.index');
    }


    public function fetchTables()
    {
        $tables = Table::all();

        $data = view('cashier.table.all-tables', [
            'tables' => $tables
        ])->render();

        return response()->json([
            'code' => 1,
            'result' => $data
        ]);
    }
}
