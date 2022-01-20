<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>

    </x-slot>
    <x-slot name="script">
        <script>
            //ajax datatable
            var datatable= $('#crudTable').DataTable({
                ajax:{
                    url:'{!! url()->current() !!}'
                },
                columns:[
                    { data:'DT_RowIndex', name:'DT_RowIndex', width:'5%'},
                    { data:'name', name:'name'},
                    { data:'phone', name:'phone'},
                    { data:'total_price', name:'total_price'},
                    { data:'status', name:'status'},
                    { data:'created_at', name:'created_at'},
                    
                    {
                        data:'action',
                        name:'action',
                        orderable: false,
                        searchable: false,
                        width:'25%',
                    }

                ]
            })
        </script>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('dashboard.export.laporan.ready') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg mx-2" target="_blank">
                Cetak Laporan Ready-stock
                </a>
                <a href="{{ route('dashboard.export.laporan.handmade') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded shadow-lg" target="_blank">
                    Cetak Laporan Hand-made
                </a>
            </div>
            <div class="shadow overflow-hidden sm-rounded-md">
                <div class="py-4 px-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Nama</td>
                                <td>Phone</td>
                                <td>Total(Rp.)</td>
                                <td>Status</td>
                                <td>Waktu Transaksi</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>