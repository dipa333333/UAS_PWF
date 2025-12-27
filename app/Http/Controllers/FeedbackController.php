<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Simpan Pesan dari Pelanggan
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'customer_phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:500',
        ]);

        Feedback::create($request->all());

        return back()->with('success', 'Terima kasih! Saran Anda telah kami terima.');
    }

    // Tampilkan Daftar Pesan untuk Admin
    public function index()
    {
        $feedbacks = Feedback::latest()->paginate(10);
        return view('feedbacks.index', compact('feedbacks'));
    }

    // Hapus Pesan
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Pesan dihapus.');
    }
}