<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $reports = [
            ['tanggal' => '2023-10-01', 'keterangan' => 'Penjualan Nasi Goreng', 'tipe' => 'masuk', 'jumlah' => 500000],
            ['tanggal' => '2023-10-01', 'keterangan' => 'Beli Bahan Baku', 'tipe' => 'keluar', 'jumlah' => 200000],
            ['tanggal' => '2023-10-02', 'keterangan' => 'Penjualan Minuman', 'tipe' => 'masuk', 'jumlah' => 300000],
            ['tanggal' => '2023-10-03', 'keterangan' => 'Bayar Listrik', 'tipe' => 'keluar', 'jumlah' => 150000],
            ['tanggal' => '2023-10-04', 'keterangan' => 'Penjualan Paket Ayam', 'tipe' => 'masuk', 'jumlah' => 750000],
        ];

        $totalMasuk = collect($reports)->where('tipe', 'masuk')->sum('jumlah');
        $totalKeluar = collect($reports)->where('tipe', 'keluar')->sum('jumlah');
        $saldo = $totalMasuk - $totalKeluar;

        return view('reports.index', compact('reports', 'totalMasuk', 'totalKeluar', 'saldo'));
    }

    public function exportPdf()
    {
        $reports = [
            ['tanggal' => '2023-10-01', 'keterangan' => 'Penjualan Nasi Goreng', 'tipe' => 'masuk', 'jumlah' => 500000],
            ['tanggal' => '2023-10-01', 'keterangan' => 'Beli Bahan Baku', 'tipe' => 'keluar', 'jumlah' => 200000],
            ['tanggal' => '2023-10-02', 'keterangan' => 'Penjualan Minuman', 'tipe' => 'masuk', 'jumlah' => 300000],
        ];

        $pdf = Pdf::loadView('reports.export_pdf', compact('reports'));
        return $pdf->download('laporan-keuangan.pdf');
    }
}