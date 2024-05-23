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
        $tables = Table::all();
        return view('cashier.table.index', [
            'tables' => $tables
        ]);
    }


    public function liberarMesa(Table $table)
    {
        $table = Table::find($table->id);
        $update = $table->update([
            'state' => 'ACTIVO'
        ]);

        if ($update) {
            return redirect()->back()->with('mensaje', 'mesa activada');
        } else {
            return redirect()->back()->with('mensaje', 'mesa no activada');
        }
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
