<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-sm">
                @if (session('success'))
                    <div class="mb-4 font-medium text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('chronology.store') }}">
                    @csrf
                    <div class="py-8">
                        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                            

                            <!-- Nomor -->
                            <div class="mb-6 flex items-center">
                                <label for="area" class="w-24 text-sm font-semibold">Nomor :</label>
                                <input type="text" id="nomor" name="nomor"
                                    class="border border-gray-300 rounded-lg px-4 py-2 flex-1 bg-gray-100 cursor-not-allowed"
                                    value="{{ $nextNumber }}" readonly>
                            </div>

                            <!-- Area -->
                            <div class="mb-6 flex items-center">
                                <label for="area" class="w-24 text-sm font-semibold">Area :</label>
                                <input type="text" id="area" name="area"
                                    class="border border-gray-300 rounded-lg px-4 py-2 flex-1 bg-gray-100 cursor-not-allowed"
                                    value="{{ $area }}" disabled>
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-6 flex items-center">
                                <label for="tanggal" class="w-24 text-sm font-semibold">Tanggal :</label>
                                <input type="text" id="tanggal" name="tanggal"
                                    class="border border-gray-300 rounded-lg px-4 py-2 flex-1 bg-gray-100 cursor-not-allowed"
                                    disabled>
                            </div>

                            <!-- Subject -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold mb-2">Subject :</label>                                
                                <div class="grid grid-cols-4 gap-4 mb-3">
                                    <label class="flex items-center text-xs"><input type="checkbox" name="subject[]" value="Fraud" class="mr-2"> Fraud</label>
                                    <label class="flex items-center text-xs"><input type="checkbox" name="subject[]" value="Kecelakaan" class="mr-2"> Kecelakaan</label>
                                    <label class="flex items-center text-xs"><input type="checkbox" name="subject[]" value="Perbaikan Sistem" class="mr-2"> Perbaikan Sistem</label>
                                    <label class="flex items-center text-xs"><input type="checkbox" name="subject[]" value="Penambahan Pencatatan / Sistem" class="mr-2"> Penambahan Pencatatan / Sistem</label>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-4">
                                    <label class="flex items-center text-xs"><input type="checkbox" name="subject[]" value="Pemutihan" class="mr-2"> Pemutihan</label>
                                    <label class="flex items-center text-xs"><input type="checkbox" name="subject[]" value="Pengajuan Diluar Surkom" class="mr-2"> Pengajuan Diluar Surkom</label>
                                    <label class="flex items-center text-xs"><input type="checkbox" name="subject[]" value="PBS" class="mr-2"> PBS</label>
                                    <div class="invisible"></div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="kronologis" class="block font-semibold mb-1">Kronologis :</label>
                                <textarea id="kronologis" name="kronologis" rows="5" 
                                    class="w-full border rounded-md p-2 text-sm"></textarea>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow">Submit</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Isi otomatis tanggal hari ini
                        document.getElementById("tanggal").value = new Date().toLocaleDateString('id-ID', {
                            day: '2-digit', month: '2-digit', year: 'numeric'
                        });
                    </script>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>