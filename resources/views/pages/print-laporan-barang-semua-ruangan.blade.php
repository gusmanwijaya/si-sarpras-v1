@extends('layouts.print')

@section('title')
    Print Laporan Barang Semua Ruangan - Sistem Informasi Sarana dan Prasarana
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
    
        <table class="table-auto relative border-collapse border border-gray-500 w-full mx-auto">
            <thead class="text-center">
                <tr>
                    <th class="border border-gray-500">No</th>
                    <th class="border border-gray-500">Nama Barang</th>
                    <th class="border border-gray-500">Merek</th>
                    <th class="border border-gray-500">Kategori</th>
                    <th class="border border-gray-500">No Reg</th>
                    <th class="border border-gray-500">Tahun</th>
                    <th class="border border-gray-500">Unit</th>
                    <th class="border border-gray-500">Kondisi</th>
                    <th class="border border-gray-500">Ruangan</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($barang as $item)
                    <tr>
                        <td class="border border-gray-500">{{ $loop->iteration }}</td>
                        <td class="border border-gray-500">{{ $item->nama_barang }}</td>
                        <td class="border border-gray-500">{{ $item->merek }}</td>
                        <td class="border border-gray-500">{{ $item->Kategori->kategori }}</td>
                        <td class="border border-gray-500">{{ $item->no_reg }}</td>
                        <td class="border border-gray-500">{{ $item->tahun }}</td>
                        <td class="border border-gray-500">{{ $item->unit }}</td>
                        <td class="border border-gray-500">{{ $item->kondisi }}</td>
                        <td class="border border-gray-500">{{ $item->Ruangan->nama_ruangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <br />
        @if ($barang->count() >= 27)
            <br />
            <br />
        @endif

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
                            Kepala</th>
                    </tr>
                    <tr>
                        <th class="w-80 h-48">
                            Eza Avlenda, S.Pd., M.Si <br />
                            NIP. 19790406 200312 2 002
                        </th>
                    </tr>
                </table>
            </div>

        </div>

    </div>

@endsection

@push('after-script')
    <script>
        window.print();
    </script>
@endpush