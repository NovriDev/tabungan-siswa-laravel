<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .invoice {
            background: #fff;
            width: 100%;
            max-width: 600px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            color: #333;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
        }
        .details table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        .details table td:first-child {
            font-weight: bold;
            color: #555;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        .btn-print {
            display: block;
            text-align: center;
            margin: 20px auto 0;
            padding: 12px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            transition: 0.3s;
        }
        .btn-print:hover {
            background-color: #0056b3;
        }
        .status-message {
            text-align: center;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .status-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <h1>Invoice Pembayaran</h1>
        </div>
        @if(session('status'))
        <div class="status-message {{ session('status') == 'success' ? 'status-success' : 'status-danger' }}">
            {{ session('message') }}
        </div>
        @endif
        <div class="details">
            <table>
                <tr>
                    <td>ID Transaksi</td>
                    <td>{{ $tabungan->id }}</td>
                </tr>
                <tr>
                    <td>Nama Siswa</td>
                    <td>{{ $tabungan->siswa->nama }}</td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td>{{ $tabungan->siswa->nis }}</td>
                </tr>
                <tr>
                    <td>Jumlah Pembayaran</td>
                    <td style="color: green">Rp {{ number_format($tabungan->saldo, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Tanggal Transaksi</td>
                    <td>{{ $tabungan->tanggal_transaksi }}</td>
                </tr>
            </table>
        </div>
        <a href="javascript:window.print()" class="btn-print">Cetak Invoice</a>
    </div>
</body>
</html>
