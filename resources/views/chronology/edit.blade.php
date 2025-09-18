<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-sm">
                @if (session('success'))
                    <div class="mb-4 font-medium text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('chronology.update', $chronology->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="py-8">
                        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                            <div class="mb-6 flex items-center">
                                <label for="area" class="w-24 text-sm font-semibold">Nomor :</label>
                                <input type="text" name="nomor"
                                class="border border-gray-300 rounded-lg px-4 py-2 flex-1 bg-gray-100 cursor-not-allowed"
                                value="{{ $chronology->no }}" readonly>
                            </div>

                            <div class="mb-6 flex items-center">
                                <label class="w-24 text-sm font-semibold">Area :</label>
                                <input type="text"
                                class="border border-gray-300 rounded-lg px-4 py-2 flex-1 bg-gray-100 cursor-not-allowed"
                                value="{{ $chronology->area }}" disabled>
                            </div>

                            <div class="mb-6 flex items-center">
                                <label class="w-24 text-sm font-semibold">Judul :</label>
                                <input type="text" name="judul"
                                class="border border-gray-300 rounded-lg px-4 py-2 flex-1"
                                value="{{ $chronology->judul }}">
                            </div>

                            <div class="mb-6 flex items-center">
                                <label class="w-24 text-sm font-semibold">Tanggal :</label>
                                <input type="text"
                                class="border border-gray-300 rounded-lg px-4 py-2 flex-1 bg-gray-100 cursor-not-allowed"
                                value="{{ $chronology->created_at }}" disabled>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-semibold mb-2">Subject :</label>
                                @php
                                    $selectedSubject = is_array($chronology->subject) ? $chronology->subject : json_decode($chronology->subject, true);
                                @endphp
                                <div class="grid grid-cols-4 gap-4 mb-3">
                                    @foreach (['Fraud', 'Kecelakaan', 'Perbaikan Sistem', 'Penambahan Pencatatan / Sistem'] as $sub)
                                        <label class="flex items-center text-xs">
                                            <input type="checkbox" name="subject[]" value= "{{ $sub }}" class="mr-2"
                                            {{ in_array($sub, $selectedSubject ?? []) ? 'checked' : '' }}> {{ $sub }}
                                        </label>
                                    @endforeach
                                </div>
                                <div class="grid grid-cols gap-4">
                                    @foreach (['Pemutihan', 'Pengajuan Diluar Surkom', 'PBS'] as $sub)
                                        <label class="flex items-center text-xs">
                                            <input type="checkbox" name="subject[]" value="{{ $sub }}" class="mr-2"
                                            {{ in_array($sub, $selectedSubjects ?? []) ? 'checked' : '' }}>{{ $sub }}
                                        </label>
                                    @endforeach
                                    <div class="invisible"></div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="kronologis" class="block font-semibold mb-1">Kronologis :</label>
                                <textarea name="kronologis" id="kronologis" rows="10"
                                class="w-full border rounded-md p-2 text-sm">{{ $chronology->kronologis }}</textarea>
                            </div>

                            <div class="mt-4">
                                <label for="solutions" class="block text-sm font-medium text-gray-700">Solusi</label>
                                @php
                                    $selectedSolutions = is_array($chronology->solutions) ? $chronology->solutions : json_decode($chronology->solutions, true);
                                @endphp
                                <select id="solution-select" class="w-full" multiple>
                                    @foreach ([
                                        "Proses Sesuai Surkom Pembebanan",
                                        "100% Beban BM",
                                        "100% Beban Sales",
                                        "Revisi SI",
                                        "Revisi Receiving",
                                        "Revisi PI",
                                        "Revisi Hasil Opname",
                                        "Revisi Adj. In/Out",
                                        "Lapor Pihak Berwajib",
                                        "Pemberian Surat Peringatan",
                                        "Pemberian Teguran Lisan",
                                        "Batalkan Transaksi",
                                        "Revisi Menggunakan COA:"
                                    ] as $opt)
                                    <option value="{{ $opt }}" {{ in_array($opt, $selectedSolutions ?? []) ? 'selected' : '' }}>{{ $opt }}</option>
                                        
                                    @endforeach
                                </select>
                                
                                <ul id="solution-list" class="mt-2 list-disc list-inside text-sm text-gray-700">
                                    @if (!empty($selectedSolutions))
                                        @foreach ($selectedSolutions as $s)
                                            <li>{{ $s }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                                <input type="hidden" name="solutions" id="solutions-input" value="{{ json_encode($selectedSolutions) }}">
                            </div>

                            <script>
                                $(document).ready(function () {
                                    $('#solution-select').select2();

                                    let inital = {!! json_encode($selectedSolutions) !!};
                                    let list = $('#solution-list');
                                    list.empty();
                                    (inital || []).forEach(v => list.append(`<li>${v}</li>`));

                                    $('#solution-select').on('change', function() {
                                        let values = $(this).val()|| [];
                                        let list = $('#solution-list');
                                        list.empty();
                                        values.forEach(v => list.append(`<li>${v}</li>`));
                                        $('#solutions-input').val(JSON.stringify(values));
                                    });
                                });
                            </script>

                            <div class="mt-4">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>