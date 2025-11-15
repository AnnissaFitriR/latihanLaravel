<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow mt-8">
        <h2 class="text-xl font-semibold mb-4">
            Step 4 | Alamat Domisili & Referensi Pendaftaran
        </h2>

        {{-- Tampilkan Informasi Status Registrasi --}}
            @if (isset($statusMessage))
                <div class="p-3 mb-4 rounded
                    @if ($data->status === 'accepted') bg-green-100 text-green-700 border border-green-300
                    @elseif ($data->status === 'rejected') bg-red-100 text-red-700 border border-red-300
                    @endif">
                    {{ $statusMessage }}
                </div>
            @endif
            {{-- Selesai --}}
            
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('ekyc.storeStep4') }}">
            @csrf

            {{-- Alamat Domisili Lengkap --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Alamat Domisili Lengkap</label>
                <textarea name="domisili" rows="2"
                    class="mt-1 block w-full border-gray-300 rounded-md">{{ old('domisili', $data->domisili ?? '') }}</textarea>
            </div>

            {{-- Provinsi --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                <select name="provinsi" id="provinsi"
                    class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Provinsi --</option>
                    @foreach ($provinsiList as $prov)
                        <option value="{{ $prov }}"
                            {{ old('provinsi', $data->provinsi ?? '') == $prov ? 'selected' : '' }}>
                            {{ $prov }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Kota --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Kota</label>
                <select name="kota" id="kota"
                    class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Kota --</option>
                    @foreach ($kotaList as $kota)
                        <option value="{{ $kota }}"
                            {{ old('kota', $data->kota ?? '') == $kota ? 'selected' : '' }}>
                            {{ $kota }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Kecamatan --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                <select name="kecamatan" id="kecamatan"
                    class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach ($kecamatanList as $kec)
                        <option value="{{ $kec }}"
                            {{ old('kecamatan', $data->kecamatan ?? '') == $kec ? 'selected' : '' }}>
                            {{ $kec }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Kode Pos --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Kode Pos</label>
                <input type="text" name="kode_pos" id="kode_pos"
                    value="{{ old('kode_pos', $data->kode_pos ?? '') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md" readonly>
            </div>

            {{-- Nama Ibu Kandung --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Ibu Kandung</label>
                <input type="text" name="nama_ibu_kandung"
                    value="{{ old('nama_ibu_kandung', $data->nama_ibu_kandung ?? '') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md">
            </div>

            {{-- Referensi Sumber Informasi --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Sumber Informasi Pendaftaran</label>
                <select name="referensi_sumber"
                    class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Sumber --</option>
                    <option value="sosmed" {{ old('referensi_sumber', $data->referensi_sumber ?? '') == 'sosmed' ? 'selected' : '' }}>Sosial Media</option>
                    <option value="teman" {{ old('referensi_sumber', $data->referensi_sumber ?? '') == 'teman' ? 'selected' : '' }}>Teman</option>
                    <option value="kampus" {{ old('referensi_sumber', $data->referensi_sumber ?? '') == 'kampus' ? 'selected' : '' }}>Langsung dari Kampus</option>
                </select>
            </div>

            {{-- Tombol Navigasi --}}
            <div class="flex justify-between items-center mt-4">
                <a href="{{ route('ekyc.step3') }}"
                    class="text-sm text-gray-500 hover:text-gray-700">← Kembali ke Step 3</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Simpan & Lanjut Step 5 →
                </button>
            </div>
        </form>
    </div>

    {{-- Script Dinamis (Provinsi → Kota → Kecamatan → Kode Pos) --}}
    <script>
        const domisiliData = @json($domisiliList);

        document.getElementById('provinsi').addEventListener('change', function () {
            const prov = this.value;
            const kotaSelect = document.getElementById('kota');
            kotaSelect.innerHTML = '<option value="">-- Pilih Kota --</option>';

            const filteredKota = domisiliData.filter(item => item.provinsi === prov);
            filteredKota.forEach(item => {
                kotaSelect.innerHTML += `<option value="${item.kota}">${item.kota}</option>`;
            });
        });

        document.getElementById('kota').addEventListener('change', function () {
            const kota = this.value;
            const kecSelect = document.getElementById('kecamatan');
            kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

            const filteredKec = domisiliData.filter(item => item.kota === kota);
            filteredKec.forEach(item => {
                kecSelect.innerHTML += `<option value="${item.kecamatan}">${item.kecamatan}</option>`;
            });
        });

        document.getElementById('kecamatan').addEventListener('change', function () {
            const kec = this.value;
            const kodeInput = document.getElementById('kode_pos');
            const selected = domisiliData.find(item => item.kecamatan === kec);
            kodeInput.value = selected ? selected.kode_pos : '';
        });
    </script>
</x-app-layout>