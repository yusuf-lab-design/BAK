<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Berita Acara Kronologis
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('chronology.create')}}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Insert BAK
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="table-auto w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-4 py-2 border">#</th>
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">No Document</th>
                                <th class="px-4 py-2 border">Area</th>
                                <th class="px-4 py-2 border">Subject</th>
                                <th class="px-4 py-2 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($chronologies as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $index+1 }}</td>
                                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 border">{{ $item->no }}</td>
                                    <td class="px-4 py-2 border">{{ $item->area }}</td>
                                    <td class="px-4 py-2 border">{{ $item->subject }}</td>
                                    <td class="px-4 py-2 border text-center space-x-2"><a href="{{ route('chronology.preview', $item->uuid) }}"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm">
                                            Preview
                                        </a>
                                        <a href="{{ route('chronology.download', $item->uuid)}}"
                                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                                
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center px-4 py-6 text-gray-500">
                                        Kosong
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>