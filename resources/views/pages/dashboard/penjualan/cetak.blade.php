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
                    <td class="text-dark">Rp. {{ number_format($transaction->total_price,2) }}</td>
                </tr>    
                <?php
                $total = $total + $transaction->total_price;
                $format = number_format($total,2);
                ?>
                @endforeach
                <tr>
                    <td colspan="3">
                        Total Pemasukan
                    </td>
                    <td>Rp.{{ $format }}</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>