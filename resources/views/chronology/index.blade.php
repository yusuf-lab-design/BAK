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
                    <a href="{{ route('chronology.create')}}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg" title="Buat Baru">
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
                                    <td class="px-4 py-2 border">{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td class="px-4 py-2 border">{{ $item->no }}
                                        @if ($item->status === 'draft')
                                            <span class="text-yellow-500 font-bold ml-2" title="Draft">D</span>
                                        @elseif ($item->status === 'pending')
                                            <span class="text-blue-500 font-bold ml-2" title="Pending">P</span>
                                        @elseif ($item->status === 'approved')
                                            <span class="text-green-500 font-bold ml-2">A</span>
                                        @elseif ($item->status === 'rejected')
                                            <span class="text-red-500 font-bold ml-2" title="Rejected">R</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border">{{ $item->area }}</td>
                                    <td class="px-4 py-2 border">
                                        @if (!empty($item->subject))
                                            <span class="text-gray-700 text-xs">
                                                {{ implode(', ', $item->subject) }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border text-center space-x-2"><a href="{{ route('chronology.preview', $item->uuid) }}"
                                        class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 text-sm" title="Preview Pdf">
                                            Preview
                                        </a>

                                        <a href="{{ route('chronology.edit', $item->uuid) }}"
                                            class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-sm" title="Edit Pdf">
                                            Edit
                                        </a>

                                        @if (auth()->user()->role === 'area' && in_array($item->status,['draft', 'rejected']))
                                            <button class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 text-sm" title="Upload Pdf"
                                                onclick="openUploadModal('{{ $item->uuid }}')">Upload Dokumen
                                            </button>
                                        @endif

                                        <a href="{{ route('chronology.download', $item->uuid)}}"
                                            class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 text-sm" title="Download Pdf">
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

                    <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 hidden item-center justify-center z-50">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
                            <h2 class="text-lg font-semibold mb-4">Upload Dokumen</h2>
                            <form id="uploadForm" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="_method" value="POST">

                                <div class="mb-4">
                                    <label class="block text-sm font-medium">Attach</label>
                                    <input type="file" name="signed_document" accept=".pdf" required
                                    class="mt-1 block w-full border rounded px-3 py-2">
                                </div>

                                <div class="flex justify-end space-x-2">
                                    <button type="button" onclick="closeUploadModal()" 
                                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Upload</button>
                                </div>
                            </form>
                            <button onclick="closeUploadModal()" class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openUploadModal(uuid) {
            const form = document.getElementById('uploadForm');
            form.action = "{{ url('/chronology') }}/" + uuid + "/upload";
            document.getElementById('uploadModal').classList.remove('hidden');
            document.getElementById('uploadModal').classList.add('flex');
        }
        function closeUploadModal() {
            const modal = document.getElementById('uploadModal');
            modal.classList.add('hidden')
            modal.classList.remove('flex');
            document.getElementById(uploadForm).reset();
        }
    </script>

</x-app-layout>