<table>
    <thead>
        <tr>
            <th></th>
            <th>
                Laporan Sarana dan Prasarana <br/>
                Ruangan {{ $namaRuangan }} <br/>
                Tahun {{ $tahunNow }}
            </th>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Merek</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Sumber Dana</th>
            <th>Tahun Barang</th>
            <th>Kondisi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barang as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->merek }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->satuan }}</td>
                <td>{{ $item->SumberDana->sumber_dana }}</td>
                <td>{{ $item->tahun_barang }}</td>
                <td>{{ $item->kondisi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<br/>

<table>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Bengkulu, {{ $tanggalNow }} 
            @if($bulanNow == "January")
            Januari
            @elseif($bulanNow == "February")
            February
            @elseif($bulanNow == "March")
            Maret
            @elseif($bulanNow == "April")
            April
            @elseif($bulanNow == "May")
            Mei
            @elseif($bulanNow == "June")
            Juni
            @elseif($bulanNow == "July")
            Juli
            @elseif($bulanNow == "August")
            Agustus
            @elseif($bulanNow == "September")
            September
            @elseif($bulanNow == "October")
            Oktober
            @elseif($bulanNow == "November")
            Nopember
            @elseif($bulanNow == "December")
            Desember
            @endif 
            {{ $tahunNow }} <br/>
            Mengetahui, <br/> 
            Kepala MTs Negeri 1 Kota Bengkulu</th>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Eza Avlenda, S.Pd., M.Si <br/> 
            NIP. 197904062003122002
        </th>
    </tr>
</table>