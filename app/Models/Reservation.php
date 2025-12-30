<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Pastikan 'table_id' tetap ada di sini (ini sudah benar)
    protected $fillable = [
        'name',
        'phone',
        'pax',
        'reservation_time',
        'status',
        'table_id'
    ];

    protected $casts = [
        'reservation_time' => 'datetime',
    ];

    // --- TAMBAHAN YANG KURANG ---
    // Fungsi ini agar kita bisa memanggil $reservation->table->name
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}