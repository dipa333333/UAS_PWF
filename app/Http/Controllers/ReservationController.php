<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // === PUBLIC: KIRIM RESERVASI ===
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'pax' => 'required|integer|min:1',
            'reservation_time' => 'required',
        ]);

        Reservation::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'pax' => $request->pax,
            'reservation_time' => $request->reservation_time,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Reservasi berhasil dikirim.');
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
