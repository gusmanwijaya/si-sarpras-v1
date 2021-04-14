<?php

use App\Models\Ruangan;
use App\Models\Barang;
use App\Models\SumberDana;

function ruanganSidebar()
{
    $ruanganSidebar = Ruangan::orderBy('nama_ruangan', 'asc')->get();
    return $ruanganSidebar;
}

function filterBarang($id)
{
    $ruangan = Ruangan::find($id);
    $barang = Barang::where('ruangan_id', $ruangan->id)->orderBy('nama_barang', 'asc')->get('nama_barang');
    return $barang;
}

function sumberDana()
{
    $sumberDana = SumberDana::orderBy('sumber_dana', 'asc')->get();
    return $sumberDana;
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

function totalBarangRusakRingan()
{
    $barangRusakRingan = Barang::where('kondisi', 'Rusak Ringan')->get();
    return $barangRusakRingan->count();
}

function totalBarangRusakBerat()
{
    $barangRusakBerat = Barang::where('kondisi', 'Rusak Berat')->get();
    return $barangRusakBerat->count();
}

?>