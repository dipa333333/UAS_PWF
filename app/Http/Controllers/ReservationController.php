<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'pax' => 'required|integer|min:1',
            'reservation_time' => 'required',
            'status' => 'nullable|string',
            'table_id' => 'nullable|exists:tables,id',
        ]);
        $status = $request->status ?? 'pending';

        Reservation::create([
            'table_id' => $request->table_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'pax' => $request->pax,
            'reservation_time' => $request->reservation_time,
            'status' => $status,
        ]);

        $message = ($status === 'confirmed')
            ? 'Reservasi berhasil dibuat dan disetujui.'
            : 'Reservasi berhasil dikirim. Mohon tunggu konfirmasi.';

        return back()->with('success', $message);
    }

    // === ADMIN UPDATE STATUS ===
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,done',
        ]);

        $reservation->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status reservasi diperbarui.');
    }
}