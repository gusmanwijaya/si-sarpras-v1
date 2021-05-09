@extends('layouts.print')

@section('title')
    Print Laporan Barang Peruangan - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
    <div class="h-screen">
        <div class="flex flex-row items-center justify-center">
            <table class="table-auto">
                <tr>
                    <td>
                        <img src="{{ asset('img/logo-mtsn1.png') }}" alt="Logo MTS Negeri 1 Kota Bengkulu" class="ml-0 w-32 h-32">
                    </td>
                    <td class="w-12"></td>
                    <td>
                        <div class="mx-auto">
                            <p class="text-base text-center font-bold">KEMENTERIAN AGAMA REPUBLIK INDONESIA <br/>
                                KANTOR KEMENTERIAN AGAMA KOTA BENGKULU <br/>
                                MADRASAH TSANAWIYAH NEGERI 1 <br/>
                                Jalan Nangka Km.6 Telepon 341483
                            </p>
                        </div>
                    </td>
                    <td class="w-8"></td>
                </tr>
            </table>
        </div>
    
        <hr class="mt-2"/>
        <br/>
    
        <p class="text-center text-base font-bold">
            DAFTAR INVENTARIS RUANG (DIR)
        </p>
    
        <br>

        <p class="text-left text-sm font-medium leading-5">Penanggung Jawab Ruang     : 
            @foreach ($guruPenanggungJawab as $item)
                {{ $item->nama }}
            @endforeach
            
            <br/>
            
            Gedung/Ruang : {{ $ruangan->nama_ruangan }}
            
        </p> <br />
    
        <table class="table-auto relative border-collapse border border-gray-500 w-full mx-auto">
            <thead class="text-center">
                <tr>
                    <th class="border border-gray-500">No</th>
                    <th class="border border-gray-500">Nama Barang</th>
                    <th class="border border-gray-500">Merek</th>
                    <th class="border border-gray-500">No Reg</th>
                    <th class="border border-gray-500">Tahun</th>
                    <th class="border border-gray-500">Unit</th>
                    <th class="border border-gray-500">Kondisi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($barang as $item)
                    <tr>
                        <td class="border border-gray-500">{{ $loop->iteration }}</td>
                        <td class="border border-gray-500">{{ $item->nama_barang }}</td>
                        <td class="border border-gray-500">{{ $item->merek }}</td>
                        <td class="border border-gray-500">{{ $item->no_reg }}</td>
                        <td class="border border-gray-500">{{ $item->tahun }}</td>
                        <td class="border border-gray-500">{{ $item->unit }}</td>
                        <td class="border border-gray-500">{{ $item->kondisi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br />

        <div class="flex flex-row justify-between">

            <div class="flex justify-center">
                <table class="table-auto">
                    <tr>
                        <th class="w-80 pt-6">Waka. Sarana dan Prasarana</th>
                    </tr>
                    <tr>
                        <th class="w-80 h-48">
                            Drs. Adenan <br />
                            NIP. 19650721 199703 1 002
                        </th>
                    </tr>
                </table>
            </div>
    
            <div class="flex items-end justify-end">
                <table class="table-auto">
                    <tr>
                        <th class="w-80">Bengkulu, {{ $tanggalNow }} 
                            {{ $bulanNow == 'January' ? 'Januari' : '' }}
                            {{ $bulanNow == 'February' ? 'Februari' : '' }}
                            {{ $bulanNow == 'March' ? 'Maret' : '' }}
                            {{ $bulanNow == 'April' ? 'April' : '' }}
                            {{ $bulanNow == 'May' ? 'Mei' : '' }}
                            {{ $bulanNow == 'June' ? 'Juni' : '' }}
                            {{ $bulanNow == 'July' ? 'Juli' : '' }}
                            {{ $bulanNow == 'August' ? 'Agustus' : '' }}
                            {{ $bulanNow == 'September' ? 'September' : '' }}
                            {{ $bulanNow == 'October' ? 'Oktober' : '' }}
                            {{ $bulanNow == 'November' ? 'November' : '' }}
                            {{ $bulanNow == 'December' ? 'Desember' : '' }}
                            {{ $tahunNow }} <br/>
                            Penanggung Jawab Ruang</th>
                    </tr>
                    <tr>
                        <th class="w-80 h-48">
                            @foreach ($guruPenanggungJawab as $item)
                                {{ $item->nama }} <br />
                                NIP. {{ $item->nip }}
                            @endforeach
                        </th>
                    </tr>
                </table>
            </div>

        </div>

        @if($barang->count() > 10 && $barang->count() < 14)
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
        @elseif($barang->count() >= 14)
            <br />
            <br />
            <br />
            <br />
            <br />
        @endif

        <div class="flex flex-row justify-center">

            <div class="flex flex-col pb-48">
                <p class="font-bold text-center">
                    Mengetahui <br />
                    Kepala
                </p>
    
                <br />
                <br />
                <br />
    
                <p class="font-bold text-center">
                    Eza Avlenda, S.Pd., M.Si <br />
                    NIP. 19790406 200312 2 002
                </p>
            </div>

        </div>

    </div>

@endsection

@push('after-script')
    <script>
        window.print();
    </script>
@endpush