<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { bg-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN KAS RESTO DIGITAL</h2>
        <p>Periode: Oktober 2023</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Tipe</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $r)
            <tr>
                <td>{{ $r['tanggal'] }}</td>
                <td>{{ $r['keterangan'] }}</td>
                <td>{{ ucfirst($r['tipe']) }}</td>
                <td>Rp {{ number_format($r['jumlah'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>