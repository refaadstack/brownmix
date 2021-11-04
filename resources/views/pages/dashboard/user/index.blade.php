<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
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
                    { data:'email', name:'email'},
                    { data:'roles', name:'roles'},
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
            <div class="shadow overflow-hidden sm-rounded-md">
                <div class="py-4 px-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>Role</td>
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