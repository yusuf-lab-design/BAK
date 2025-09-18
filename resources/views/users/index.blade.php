<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-grey-800">
            {{ __('List User') }}
        </h2>

        <div class="py-6 px-4">
            <div class="bg-white shadow rounded-lg p-6">
                <table>
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">User Id</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td class="px-4 py-2 border text-center">{{ $index+1 }}</td>
                                <td class="px-4 py-2 border">{{$user->userid}}</td>
                                <td class="px-4 py-2 border">{{$user->name}}</td>
                                <td class="px-4 py-2 border">{{$user->email}}</td>
                                <td class="px-4 py-2 border">{{$user->role}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-slot>
</x-app-layout>