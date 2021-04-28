<?php

namespace App\Exports;

use App\Models\Barang;
use App\Models\Guru;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BarangExport implements FromView, ShouldAutoSize
{
    public function __construct(int $ruangan, string $namaRuangan, int $guruId)
    {
        $this->ruangan = $ruangan;
        $this->namaRuangan = $namaRuangan;
        $this->guruId = $guruId;
    }

    public function view(): View
    {
        $tanggalNow = Carbon::now()->format('d');
        $bulanNow = Carbon::now()->format('F');
        $tahunNow = Carbon::now()->format('Y');
        $namaRuangan = $this->namaRuangan;

        return view('exports.export-barang-excel', [
            'barang' => Barang::where('ruangan_id', $this->ruangan)->get(),
            'namaGuru' => Guru::where('id', $this->guruId)->get(),
            'namaRuangan' => $namaRuangan,
            'tanggalNow' => $tanggalNow,
            'bulanNow' => $bulanNow,
            'tahunNow' => $tahunNow
        ]);
    }
}
