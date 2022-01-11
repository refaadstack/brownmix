<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden sm-rounded-md">
                <div class="py-4 px-5 bg-white sm:p-6">
                    <h1>Detail User</h1>
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg mb-10">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <table class="table-auto w-full">
                                <tr>
                                    <th class="border px-6 py-4 text-right">Nama</th>
                                    <td class="border px-6 py-4">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th class="border px-6 py-4 text-right">Email</th>
                                    <td class="border px-6 py-4">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th class="border px-6 py-4 text-right">avatar</th>
                                    <td class="border px-6 py-4">
                                        <img
                                        src="{{ Storage::url($user->profile_photo_path) }}"
                                        alt="Avatar"
                                        class="object-cover w-full h-full rounded-lg"
                                        />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                                    
                                    
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>