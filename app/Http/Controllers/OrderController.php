<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = [
            [
                'id' => 'ORD-005',
                'customer_name' => 'Budi Santoso',
                'whatsapp' => '62812345678',
                'items' => [
                    ['name' => 'Nasi Goreng Spesial', 'qty' => 2],
                    ['name' => 'Es Teh Manis', 'qty' => 2],
                ],
                'total' => 60000,
                'status' => 'Baru',
                'time' => '5 menit yang lalu'
            ],
            [
                'id' => 'ORD-004',
                'customer_name' => 'Siti Aminah',
                'whatsapp' => '62898765432',
                'items' => [
                    ['name' => 'Ayam Bakar Madu', 'qty' => 1],
                    ['name' => 'Nasi Putih', 'qty' => 1],
                    ['name' => 'Jeruk Hangat', 'qty' => 1],
                ],
                'total' => 35000,
                'status' => 'Diproses',
                'time' => '15 menit yang lalu'
            ],
            [
                'id' => 'ORD-003',
                'customer_name' => 'Doni Tata',
                'whatsapp' => '62811223344',
                'items' => [
                    ['name' => 'Mie Goreng Seafood', 'qty' => 3],
                ],
                'total' => 75000,
                'status' => 'Diproses',
                'time' => '25 menit yang lalu'
            ],
            [
                'id' => 'ORD-002',
                'customer_name' => 'Rina Nose',
                'whatsapp' => '62855667788',
                'items' => [
                    ['name' => 'Burger Cheese', 'qty' => 2],
                    ['name' => 'French Fries', 'qty' => 1],
                ],
                'total' => 90000,
                'status' => 'Selesai',
                'time' => '1 jam yang lalu'
            ],
            [
                'id' => 'ORD-001',
                'customer_name' => 'Pak RT',
                'whatsapp' => '62899887766',
                'items' => [
                    ['name' => 'Kopi Hitam', 'qty' => 5],
                    ['name' => 'Pisang Goreng', 'qty' => 5],
                ],
                'total' => 100000,
                'status' => 'Selesai',
                'time' => '2 jam yang lalu'
            ],
        ];

        return view('orders.index', compact('orders'));
    }
}