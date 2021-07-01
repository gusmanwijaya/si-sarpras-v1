<table>
    <thead>
        <tr>
            <th></th>
            <th>
                DAFTAR INVENTARIS RUANG (DIR) <br/>
                Penanggung Jawab Ruang : @foreach ($namaGuru as $item)
                    {{ $item->nama }}
                @endforeach <br/>
                Gedung/Ruang : {{ $namaRuangan }}
            </th>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Merek/Type</th>
            <th>Kategori</th>
            <th>No. Reg</th>
            <th>Tahun</th>
            <th>Unit</th>
            <th>Kondisi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barang as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->merek }}</td>
                <td>{{ $item->Kategori->kategori }}</td>
                <td>{{ $item->no_reg }}</td>
                <td>{{ $item->tahun }}</td>
                <td>{{ $item->unit }}</td>
                <td>{{ $item->kondisi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<br/>

<table>
    <tr>
        <th></th>
        <th>Waka. Sarana dan Prasarana</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Bengkulu, {{ $tanggalNow }} 
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
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <th></th>
        <th>Drs. Adenan <br />
            NIP. 19650721 199703 1 002
        </th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>@foreach ($namaGuru as $item)
            {{ $item->nama }} <br />
            NIP. {{ $item->nip }}
        @endforeach
        </th>
    </tr>
</table>

<table>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Mengetahui <br />
            Kepala
        </th>
        <th></th>
        <th></th>
        <th></th>
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
        <th>
            Eza Avlenda, S.Pd., M.Si <br />
            NIP. 19790406 200312 2 002
        </th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
</table>