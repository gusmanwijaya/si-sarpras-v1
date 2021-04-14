@extends('layouts.print')

@section('title')
    Print - Sistem Informasi Sarana dan Prasarana
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
                            <p class="text-base text-center">KEMENTERIAN AGAMA REPUBLIK INDONESIA <br/>
                                KEMENTERIAN AGAMA KOTA BENGKULU <br/>
                                MADRASAH TSANAWIYAH NEGERI (MTsN) 1 KOTA BENGKULU <br/>
                                Jalan Nangka Km.6 Bengkulu, Kode Pos 38226
                            </p>
                        </div>
                    </td>
                    <td class="w-8"></td>
                </tr>
            </table>
        </div>
    
        <hr class="mt-2"/>
        <br/>
    
        <p class="text-center text-sm">
            LAPORAN SARANA DAN PRASARANA <br/> RUANGAN <span class="uppercase">{{ $ruangan->nama_ruangan }}</span> <br/> TAHUN {{ $tahunNow }}
        </p>
    
        <br/>
    
        <table class="table-auto relative border-collapse border border-gray-500 w-full mx-auto">
            <thead class="text-center">
                <tr>
                    <th class="border border-gray-500">No</th>
                    <th class="border border-gray-500">Kode Barang</th>
                    <th class="border border-gray-500">Nama Barang</th>
                    <th class="border border-gray-500">Merek</th>
                    <th class="border border-gray-500">Jumlah</th>
                    <th class="border border-gray-500">Satuan</th>
                    <th class="border border-gray-500">Sumber Dana</th>
                    <th class="border border-gray-500">Tahun Barang</th>
                    <th class="border border-gray-500">Kondisi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($barang as $item)
                    <tr>
                        <td class="border border-gray-500">{{ $loop->iteration }}</td>
                        <td class="border border-gray-500">{{ $item->kode_barang }}</td>
                        <td class="border border-gray-500">{{ $item->nama_barang }}</td>
                        <td class="border border-gray-500">{{ $item->merek }}</td>
                        <td class="border border-gray-500">{{ $item->jumlah }}</td>
                        <td class="border border-gray-500">{{ $item->satuan }}</td>
                        <td class="border border-gray-500">{{ $item->SumberDana->sumber_dana }}</td>
                        <td class="border border-gray-500">{{ $item->tahun_barang }}</td>
                        <td class="border border-gray-500">{{ $item->kondisi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <br/>
        <br/>
        <br/>
        <br/>

        <div class="flex items-end justify-end">
            <table class="table-auto">
                <tr>
                    <th class="w-80">Bengkulu, {{ $tanggalNow }} {{ $bulanNow }} {{ $tahunNow }} <br/>
                        Mengetahui, <br/> Kepala MTs Negeri 1 Kota Bengkulu</th>
                </tr>
                <tr>
                    <th class="w-80 h-48">Eza Avlenda, S.Pd., M.Si <br/> NIP. 197904062003122002</th>
                </tr>
            </table>
        </div>
    </div>
@endsection

@push('after-script')
    <script>
        window.print();
    </script>
@endpush