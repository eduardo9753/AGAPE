<?php

namespace App\Http\Controllers\waitress\table;

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
        $tables = Table::all();
        return view('waitress.table.index', [
            'tables' => $tables
        ]);
    }


    public function fetchTables()
    {
        $tables = Table::all();

        $data = view('waitress.table.all-tables', [
            'tables' => $tables
        ])->render();

        return response()->json([
            'code' => 1,
            'result' => $data
        ]);
    }
}
