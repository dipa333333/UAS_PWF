<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::orderBy('name')->get();

        // hanya tampilkan reservasi aktif
        $reservations = Reservation::whereIn('status', ['pending', 'confirmed'])
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('tables.index', [
            'tables' => $tables,
            'reservations' => $reservations,
            'totalTables' => $tables->count(),
            'availableTables' => $tables->where('status', 'kosong')->count(),
        ]);
    }

    public function create()
    {
        return view('tables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tables,name',
            'capacity' => 'required|integer|min:1',
        ]);

        Table::create($request->all());

        return redirect()->route('tables.index')
            ->with('success', 'Meja berhasil ditambahkan');
    }

    public function edit(Table $table)
    {
        return view('tables.edit', compact('table'));
    }

    public function update(Request $request, Table $table)
    {
        $request->validate([
            'name' => 'required|unique:tables,name,' . $table->id,
            'capacity' => 'required|integer|min:1',
            'status' => 'required'
        ]);

        $table->update($request->all());

        return redirect()->route('tables.index')
            ->with('success', 'Status meja diperbarui');
    }

    public function destroy(Table $table)
    {
        $table->delete();

        return redirect()->route('tables.index')
            ->with('success', 'Meja dihapus');
    }
}
