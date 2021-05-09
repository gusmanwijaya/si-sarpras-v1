<?php

use App\Models\Ruangan;
use App\Models\Barang;
use App\Models\Guru;

function ruanganSidebar()
{
    $ruanganSidebar = Ruangan::orderBy('id', 'asc')->get();
    return $ruanganSidebar;
}

function filterBarang($id)
{
    $ruangan = Ruangan::find($id);
    $barang = Barang::where('ruangan_id', $ruangan->id)->orderBy('nama_barang', 'asc')->get('nama_barang');
    return $barang;
}

function guru()
{
    $guru = Guru::orderBy('nama', 'asc')->get();
    return $guru;
}

function totalGuru()
{
    return Guru::count();
}

function totalRuangan()
{
    return Ruangan::count();
}

function totalBarangBaik()
{
    $barangBaik = Barang::where('kondisi', 'Baik')->get();
    return $barangBaik->count();
}

function totalBarangRusak()
{
    $barangRusa = Barang::where('kondisi', 'Rusak')->get();
    return $barangRusa->count();
}

?>