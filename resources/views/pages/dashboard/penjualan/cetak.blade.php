<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Penjualan Daisee Crafting</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
    <body>
        <h3 class="text-center">
            Laporan Penjualan Daisee Crafting
        </h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Ongkir</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                ?>
                @foreach ($transactions as $transaction)
                <tr>
                    <td class="text-dark">{{ $transaction->name }}</td>
                    <td class="text-dark">{{ $transaction->email }}</td>
                    <td class="text-dark">{{ $transaction->address }}</td>
                    <td class="text-dark">{{ number_format($transaction->ongkir) }}</td>
                    <td class="text-dark">Rp. {{ number_format($transaction->total_price + $transaction->ongkir,2) }}</td>
                </tr>    
                <?php
                $total = $total + $transaction->total_price+$transaction->ongkir;
                $format = number_format($total,2);
                ?>
                @endforeach
                <tr>
                    <td colspan="4">
                        Total Pemasukan
                    </td>
                    <td>Rp.{{ $format }}</td>
                </tr>
            </tbody>
        </table>
        <br><br><br>
        <?php
        function tgl_indo($tanggal){
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);
            
            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun
        
            return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
        }
    ?>
        <p align="left" style="margin-left: 470px" id="tanggal" class="mb-5">Merangin, {{tgl_indo(date('Y-m-d')) }}</p>
        <p align="left" class="mt-2" style="margin-left: 470px">Fakhira </p>
    </body>
</html>