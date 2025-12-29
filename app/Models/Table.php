<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'capacity', 'status'];

    // Helper untuk warna status (Badge Tailwind)
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'kosong' => 'bg-green-100 text-green-700 border-green-200',
            'terisi' => 'bg-red-100 text-red-700 border-red-200',
            'reservasi' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            default => 'bg-gray-100 text-gray-700'
        };
    }
}