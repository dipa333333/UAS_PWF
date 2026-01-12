<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

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
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}