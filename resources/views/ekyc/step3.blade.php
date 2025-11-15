<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Step 3 | Data Pendidikan & Upload Dokumen
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-8 bg-white p-6 rounded-lg shadow">
        @if (session('success'))
            <div class="mb-4 text-sm text-green-600">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('ekyc.storeStep3') }}" enctype="multipart/form-data">
            @csrf

            {{-- Asal SD --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Asal Sekolah SD</label>
                <input type="text" name="asal_sd" value="{{ old('asal_sd', $data->asal_sd) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            {{-- Asal SMP --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Asal Sekolah SMP</label>
                <input type="text" name="asal_smp" value="{{ old('asal_smp', $data->asal_smp) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            {{-- Asal SMA --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Asal Sekolah SMA</label>
                <input type="text" name="asal_sma" value="{{ old('asal_sma', $data->asal_sma) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            {{-- Upload KK --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700">Upload Kartu Keluarga (KK)</label>
                <input type="file" name="file_kk" class="mt-1 block w-full border-gray-300 rounded-md">
                @if ($data->file_kk)
                    <p class="text-sm text-gray-500 mt-1">File saat ini:</p>
                    <a href="{{ asset('storage/' . $data->file_kk) }}" target="_blank"
                        class="text-blue-600 underline">Lihat KK</a>
                @endif
            </div>

            {{-- Upload Ijazah --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700">Upload Ijazah Terakhir</label>
                <input type="file" name="file_ijazah" class="mt-1 block w-full border-gray-300 rounded-md">
                @if ($data->file_ijazah)
                    <p class="text-sm text-gray-500 mt-1">File saat ini:</p>
                    <a href="{{ asset('storage/' . $data->file_ijazah) }}" target="_blank"
                        class="text-blue-600 underline">Lihat Ijazah</a>
                @endif
            </div>

            <div class="flex justify-between items-center mt-4">
                <a href="{{ route('ekyc.step4') }}" class="text-sm text-gray-500 hover:text-gray-700"></a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Simpan & Lanjut Step 4 →
                </button>
            </div>
        </form>
    </div>
</x-app-layout>