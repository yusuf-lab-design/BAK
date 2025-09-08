<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Data User') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-sm">
                @if (session('success'))
                    <div class="mb-4 font-medium text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('generate.pdf') }}">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama</label>
                        <input type="text" name="nama" class="form-input w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" class="form-input w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <input type="hidden" name="id" value="123">

                    <button type="submit" class="bg-green-600 rounded text-white px-4 py-2" >
                        Generate PDF
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>