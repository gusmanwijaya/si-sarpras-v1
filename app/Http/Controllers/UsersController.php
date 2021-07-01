<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use App\Models\Guru;
use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{

    // START: Dashboard
    public function view_dashboard()
    {
        return view('pages.dashboard');
    }
    // END: Dashboard


    // START: Ruangan
    public function view_kelolaRuangan(Request $request)
    {
        if($request->has('cari')) {
            $ruangan = Ruangan::where('nama_ruangan', 'LIKE', '%' .$request->cari. '%')
                ->orWhere('kode_ruangan', 'LIKE', '%' .$request->cari. '%')
                ->get();
        }else {
            $ruangan = Ruangan::orderBy('id', 'asc')->paginate(8);
        }

        return view('pages.kelola-ruangan', compact(['ruangan']));
    }

    public function view_tambahRuangan()
    {
        return view('pages.tambah-ruangan');
    }

    public function view_editRuangan(Ruangan $ruangan)
    {
        return view('pages.edit-ruangan', compact(['ruangan']));
    }

    public function destroyFotoRuangan(Ruangan $ruangan)
    {
        $countDb = Ruangan::where('image_url', $ruangan->image_url)->get()->count();

        if($ruangan->image_url != null) {
            if($countDb > 1) {
                $ruangan->update([
                    'image_url' => null,
                ]);
            } else {
                Storage::delete('public/unggah/Ruangan/' . $ruangan->image_url);
                
                $ruangan->update([
                    'image_url' => null,
                ]);
            }

            return redirect()->route('edit-ruangan', $ruangan->id)->with('sukses', 'Foto berhasil dihapus!');
        }
    }

    public function storeRuangan(Request $request)
    {
        // START: Check validasi
        $rules = [
            'nama_ruangan' => 'required', 
            'guru_id' => 'required|unique:ruangan'
        ];
        $message = [
            'nama_ruangan.required' => 'Nama ruangan harus diisi!', 
            'guru_id.required' => 'Penanggung jawab ruangan harus dipilih!',
            'guru_id.unique' => 'Penanggung jawab sudah ada!'
        ];
        $validate = $this->validate($request, $rules, $message);
        // END: Check validasi

        if($validate) {
            if($request->file('image_url') != null) {
                // START: Upload Gambar
                $file = $request->file('image_url');
                $fileName = $request->nama_ruangan . '.' . $file->extension();
                $file->storeAs('public/unggah/Ruangan/', $fileName);
                // END: Upload Gambar

                // START: Simpan data ke database
                Ruangan::create([
                    'kode_ruangan' => $request->kode_ruangan,
                    'nama_ruangan' => $request->nama_ruangan,
                    'image_url' => $fileName,
                    'guru_id' => $request->guru_id
                ]);
                // END: Simpan data ke database
                return redirect()->route('kelola-ruangan')->with('sukses', 'Ruangan berhasil ditambahkan!');
            } else {
                // START: Simpan data ke database
                Ruangan::create([
                    'kode_ruangan' => $request->kode_ruangan,
                    'nama_ruangan' => $request->nama_ruangan,
                    'guru_id' => $request->guru_id
                ]);
                // END: Simpan data ke database
                return redirect()->route('kelola-ruangan')->with('sukses', 'Ruangan berhasil ditambahkan!');
            }
        }
    }

    public function destroyRuangan(Ruangan $ruangan)
    {
        $checkDb = Barang::where('ruangan_id', $ruangan->id)->get()->count();
        $checkDbTrashed = Barang::onlyTrashed()->where('ruangan_id', $ruangan->id)->get()->count();

        if($checkDb > 0 || $checkDbTrashed > 0) {
            return redirect()->route('kelola-ruangan')->with('gagal', 'Ruangan tidak bisa dihapus karena masih memiliki data barang!');
        } else {
            if($ruangan->image_url != null){
                $countImg = Ruangan::where('image_url', $ruangan->image_url)->get()->count();

                if($countImg > 1) {
                    $ruangan->delete();
                }else{
                    Storage::move('public/unggah/Ruangan/'.$ruangan->image_url, 'public/unggah/Trashed/Ruangan/'.$ruangan->image_url);
                    $ruangan->delete();
                }
            }else{
                $ruangan->delete();
            }

            return redirect()->route('kelola-ruangan')->with('sukses', 'Ruangan berhasil dihapus!');
        }
    }

    public function destroySemuaRuangan()
    {
        $checkSemuaRuangan = Barang::select('ruangan_id')->get()->count();
        $checkSemuaBarangInRuanganTrashed = Barang::onlyTrashed()->select('ruangan_id')->get()->count();

        if($checkSemuaRuangan > 0 || $checkSemuaBarangInRuanganTrashed > 0) {
            return redirect()->route('kelola-ruangan')->with('gagal', 'Semua ruangan tidak bisa dihapus karena salah satu ruangan masih memiliki barang!');
        } else {
            $semuaRuangan = Ruangan::all()->count();

            if($semuaRuangan < 1) {
                return redirect()->route('kelola-ruangan')->with('gagal', 'Data sudah kosong!');
            }else {
                $directoryRuangan = new Filesystem();
                $directoryRuangan->copyDirectory('../storage/app/public/unggah/Ruangan', '../storage/app/public/unggah/Trashed/Ruangan');
                Storage::deleteDirectory('public/unggah/Ruangan');

                Ruangan::query()->delete();
    
                return redirect()->route('kelola-ruangan')->with('sukses', 'Semua ruangan berhasil dihapus!');
            }
        }
    }

    public function storeEditRuangan(Request $request, Ruangan $ruangan)
    {
        // START: Check validasi
        $rules = [
            'nama_ruangan' => 'required',
        ];
        $message = [
            'nama_ruangan.required' => 'Nama ruangan harus diisi!',
        ];
        $validate = $this->validate($request, $rules, $message);
        // END: Check validasi

        if($validate) {
            if($request->file('image_url') != null) {
                // START: Upload Gambar
                $file = $request->file('image_url');
                $fileName = $request->nama_ruangan . '.' . $file->extension();
                $file->storeAs('public/unggah/Ruangan/', $fileName);
                // END: Upload Gambar
                
                // START: Simpan data ke database
                $ruangan->update([
                    'kode_ruangan' => $request->kode_ruangan,
                    'nama_ruangan' => $request->nama_ruangan,
                    'image_url' => $fileName,
                ]);
                // END: Simpan data ke database
                return redirect()->route('kelola-ruangan')->with('sukses', 'Ruangan berhasil diubah!');
            } else {
                // START: Simpan data ke database
                $ruangan->update([
                    'kode_ruangan' => $request->kode_ruangan,
                    'nama_ruangan' => $request->nama_ruangan,
                ]);
                // END: Simpan data ke database
                return redirect()->route('kelola-ruangan')->with('sukses', 'Ruangan berhasil diubah!');
            }
        }
    }

    public function view_ubahPenanggungJawabRuangan(Ruangan $ruangan)
    {
        return view('pages.ubah-penanggung-jawab-ruangan', compact('ruangan'));
    }

    public function storeUbahPenanggungJawabRuangan(Request $request, Ruangan $ruangan)
    {
        // START: Check validasi
        $rules = [
            'guru_id' => 'required|unique:ruangan',
        ];
        $message = [
            'guru_id.required' => 'Penanggung jawab ruangan harus diisi!',
            'guru_id.unique' => 'Penanggung jawab ruangan sudah ada!',
        ];
        $validate = $this->validate($request, $rules, $message);
        // END: Check validasi

        if($validate){
            $ruangan->update([
                'guru_id' => $request->guru_id
            ]);

            return redirect()->route('edit-ruangan', $ruangan->id)->with('sukses', 'Penanggung jawab ruangan berhasil diubah!');
        }
    }

    public function view_tongSampahRuangan()
    {
        $ruanganTrashed = Ruangan::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('pages.tong-sampah-ruangan', compact('ruanganTrashed'));
    }

    public function pulihkanRuangan($id = null, $img = null)
    {
        if($id != null) {
            if($img != null) {
                $checkImgTrashed = Ruangan::onlyTrashed()->where('image_url', $img)->get()->count();

                if($checkImgTrashed > 1) {
                    Storage::move('public/unggah/Trashed/Ruangan/'.$img, 'public/unggah/Ruangan/'.$img);
                    Ruangan::onlyTrashed()->where('id', $id)->restore();
                }else{
                    $checkImgDb = Ruangan::where('image_url', $img)->get()->count();

                    if($checkImgDb > 0) {
                        Ruangan::onlyTrashed()->where('id', $id)->restore();
                    }else{
                        Storage::move('public/unggah/Trashed/Ruangan/'.$img, 'public/unggah/Ruangan/'.$img);
                        Ruangan::onlyTrashed()->where('id', $id)->restore();
                    }
                }
            }else{
                Ruangan::onlyTrashed()->where('id', $id)->restore();
            }

            return redirect()->route('tong-sampah-ruangan')->with('sukses', 'Ruangan berhasil dipulihkan!');
        }else{
            $ruanganTrashed = Ruangan::onlyTrashed()->get()->count();
            if($ruanganTrashed < 1) {
                return redirect()->route('tong-sampah-ruangan')->with('gagal', 'Data sudah kosong!');
            }else{
                $directoryRuangan = new Filesystem();
                $directoryRuangan->copyDirectory('../storage/app/public/unggah/Trashed/Ruangan', '../storage/app/public/unggah/Ruangan');
                Storage::deleteDirectory('public/unggah/Trashed/Ruangan');
    
                Ruangan::onlyTrashed()->restore();
            }

            return redirect()->route('kelola-ruangan')->with('sukses', 'Ruangan berhasil dipulihkan!');
        }
    }

    public function hapusPermanenRuangan($id = null, $img = null)
    {
        if($id != null){
            if($img != null){
                $checkImgTrashed = Ruangan::onlyTrashed()->where('image_url', $img)->get()->count();

                if($checkImgTrashed > 1) {
                    Ruangan::onlyTrashed()->where('id', $id)->forceDelete();
                }else{
                    $checkImgDb = Ruangan::where('image_url', $img)->get()->count();

                    if($checkImgDb > 0){
                        Ruangan::onlyTrashed()->where('id', $id)->forceDelete();
                    }else{
                        Storage::delete('public/unggah/Trashed/Ruangan/' . $img);
                        Ruangan::onlyTrashed()->where('id', $id)->forceDelete();
                    }
                }
            }else{
                Ruangan::onlyTrashed()->where('id', $id)->forceDelete();
            }

            return redirect()->route('tong-sampah-ruangan')->with('sukses', 'Ruangan berhasil dihapus secara permanen!');
        }else{
            $ruanganTrashed = Ruangan::onlyTrashed()->get()->count();

            if($ruanganTrashed < 1){
                return redirect()->route('tong-sampah-ruangan')->with('gagal', 'Data sudah kosong!');
            }else{
                Storage::deleteDirectory('public/unggah/Trashed/Ruangan');
                Ruangan::onlyTrashed()->forceDelete();
            }
            return redirect()->route('kelola-ruangan')->with('sukses', 'Ruangan berhasil dihapus secara permanen!');
        }
    }
    // END: Ruangan


    // START: Guru
    public function view_kelolaGuru(Request $request)
    {
        if($request->has('cari')) {
            $dataGuru = Guru::where('nama', 'LIKE', '%' .$request->cari. '%')
                ->orWhere('nip', 'LIKE', '%' .$request->cari. '%')
                ->get();
        }else {
            $dataGuru = Guru::orderBy('golongan', 'desc')->paginate(25);
        }

        return view('pages.guru', compact('dataGuru'));
    }

    public function destroyGuru(Guru $guru) {
        $checkDbGuru = Ruangan::where('guru_id', $guru->id)->get()->count();

        if($checkDbGuru > 0){
            return redirect()->route('kelola-guru')->with('gagal', 'Data guru tidak bisa dihapus karena guru tersebut masih menjadi penanggung jawab di ruangan!');
        }else{
            $guru->delete();
        }

        return redirect()->route('kelola-guru')->with('sukses', 'Data guru berhasil dihapus!');
    }

    public function destroySemuaGuru() {
        $checkGuru = Ruangan::select('guru_id')->get()->count();

        if($checkGuru > 0) {
            return redirect()->route('kelola-guru')->with('gagal', 'Semua data guru tidak bisa dihapus karena salah satu guru masih menjadi penanggung jawab di ruangan!');
        }else {
            $dataGuru = Guru::all()->count();

            if($dataGuru < 1) {
                return redirect()->route('kelola-guru')->with('gagal', 'Data sudah kosong!');
            }else{
                Guru::query()->delete();

                return redirect()->route('kelola-guru')->with('sukses', 'Semua data guru berhasil dihapus!');
            }
        }
    }

    public function view_tambahGuru()
    {
        return view('pages.tambah-guru');
    }

    public function storeGuru(Request $request) {
        $rules = [
            'nama' => 'required|string',
            'golongan' => 'required|string',
            'nip' => 'unique:guru'
        ];

        $message = [
            'nama.required' => 'Nama harus diisi!',
            'golongan.required' => 'Golongan harus diisi!',
            'nip.unique' => 'NIP sudah ada!'
        ];

        $validate = $this->validate($request, $rules, $message);

        if($validate){
            Guru::create([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'golongan' => $request->golongan,
                'keterangan' => $request->keterangan
            ]);
            return redirect()->route('kelola-guru')->with('sukses', 'Data Guru berhasil ditambahkan!');
        }
    }

    public function view_editGuru(Guru $guru) {
        return view('pages.edit-guru', compact('guru'));
    }

    public function storeEditGuru(Request $request, Guru $guru) {
        $rules = [
            'nama' => 'required|string',
            'golongan' => 'required|string',
        ];

        $message = [
            'nama.required' => 'Nama harus diisi!',
            'golongan.required' => 'Golongan harus diisi!'
        ];

        $validate = $this->validate($request, $rules, $message);

        if($validate){
            $guru->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'golongan' => $request->golongan,
                'keterangan' => $request->keterangan
            ]);
            return redirect()->route('kelola-guru')->with('sukses', 'Data Guru berhasil diubah!');
        }
    }

    public function view_tongSampahGuru() {
        $guruTrashed = Guru::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('pages.tong-sampah-guru', compact('guruTrashed'));
    }

    public function pulihkanGuru($id = null) {
        if($id != null) {
            Guru::onlyTrashed()->where('id', $id)->restore();
            return redirect()->route('tong-sampah-guru')->with('sukses', 'Data berhasil dipulihkan!');
        }else {
            Guru::onlyTrashed()->restore();
            return redirect()->route('kelola-guru')->with('sukses', 'Data berhasil dipulihkan!');
        }
    }

    public function hapusPermanenGuru($id = null) {
        if($id != null) {
            Guru::onlyTrashed()->where('id', $id)->forceDelete();
            return redirect()->route('tong-sampah-guru')->with('sukses', 'Data berhasil dihapus secara permanen!');
        } else {
            Guru::onlyTrashed()->forceDelete();
            return redirect()->route('kelola-guru')->with('sukses', 'Data berhasil dihapus secara permanen!');
        }
    }
    // END: Guru


    // START: Kategori Barang
    public function view_kategoriBarang(Request $request)
    {
        if($request->has('cari')) {
            $dataKategori = Kategori::where('kategori', 'LIKE', '%' .$request->cari. '%')->get();
        }else {
            $dataKategori = Kategori::orderBy('kategori', 'asc')->paginate(25);
        }

        return view('pages.kategori-barang', compact('dataKategori'));
    }

    public function destroyKategoriBarang(Kategori $kategori) {
        $checkDbBarang = Barang::where('kategori_id', $kategori->id)->get()->count();

        if($checkDbBarang > 0){
            return redirect()->route('kelola-kategori-barang')->with('gagal', 'Data kategori barang tidak bisa dihapus karena kategori barang tersebut masih dipakai di data barang!');
        }else{
            $kategori->delete();
        }

        return redirect()->route('kelola-kategori-barang')->with('sukses', 'Data kategori barang berhasil dihapus!');
    }

    public function destroySemuaKategoriBarang() {
        $checkBarang = Barang::select('kategori_id')->get()->count();

        if($checkBarang > 0) {
            return redirect()->route('kelola-kategori-barang')->with('gagal', 'Semua data kategori barang tidak bisa dihapus karena salah satu kategori barang masih dipakai di data barang!');
        }else {
            $dataKategori = Kategori::all()->count();

            if($dataKategori < 1) {
                return redirect()->route('kelola-kategori-barang')->with('gagal', 'Data sudah kosong!');
            }else{
                Kategori::query()->delete();

                return redirect()->route('kelola-kategori-barang')->with('sukses', 'Semua data kategori barang berhasil dihapus!');
            }
        }
    }

    public function view_tambahKategoriBarang()
    {
        return view('pages.tambah-kategori-barang');
    }

    public function storeKategoriBarang(Request $request) {
        $rules = [
            'kategori' => 'required|string',
        ];

        $message = [
            'kategori.required' => 'Kategori harus diisi!',
        ];

        $validate = $this->validate($request, $rules, $message);

        if($validate){
            Kategori::create([
                'kategori' => $request->kategori,
            ]);
            return redirect()->route('kelola-kategori-barang')->with('sukses', 'Data kategori barang berhasil ditambahkan!');
        }
    }

    public function view_editKategoriBarang(Kategori $kategori) {
        return view('pages.edit-kategori-barang', compact('kategori'));
    }

    public function storeEditKategoriBarang(Request $request, Kategori $kategori) {
        $rules = [
            'kategori' => 'required|string',
        ];

        $message = [
            'kategori.required' => 'Kategori harus diisi!',
        ];

        $validate = $this->validate($request, $rules, $message);

        if($validate){
            $kategori->update([
                'kategori' => $request->kategori,
            ]);
            return redirect()->route('kelola-kategori-barang')->with('sukses', 'Data kategori barang berhasil diubah!');
        }
    }

    public function view_tongSampahKategoriBarang() {
        $kategoriTrashed = Kategori::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('pages.tong-sampah-kategori-barang', compact('kategoriTrashed'));
    }

    public function pulihkanKategoriBarang($id = null) {
        if($id != null) {
            Kategori::onlyTrashed()->where('id', $id)->restore();
            return redirect()->route('tong-sampah-kategori-barang')->with('sukses', 'Data berhasil dipulihkan!');
        }else {
            Kategori::onlyTrashed()->restore();
            return redirect()->route('kelola-kategori-barang')->with('sukses', 'Data berhasil dipulihkan!');
        }
    }

    public function hapusPermanenKategoriBarang($id = null) {
        if($id != null) {
            Kategori::onlyTrashed()->where('id', $id)->forceDelete();
            return redirect()->route('tong-sampah-kategori-barang')->with('sukses', 'Data berhasil dihapus secara permanen!');
        } else {
            Kategori::onlyTrashed()->forceDelete();
            return redirect()->route('kelola-kategori-barang')->with('sukses', 'Data berhasil dihapus secara permanen!');
        }
    }
    // END: Kategori Barang


    // START: Barang
    public function view_kelolaBarang(Request $request, Ruangan $ruangan)
    {
        // Eloquent
        $barang = Barang::query();
        $barang->where('ruangan_id', $ruangan->id);

        if($request->filled('kategori_id')) {
            $barang->where('kategori_id', $request->kategori_id);
        }

        if($request->filled('nama_barang')) {
            $barang->where('nama_barang', $request->nama_barang);
        }

        if($request->filled('kondisi')) {
            $barang->where('kondisi', $request->kondisi);
        }

        return view('pages.kelola-barang', ['ruangan' => $ruangan, 'barang' => $barang->orderBy('nama_barang', 'asc')->paginate(25)]);
    }

    public function view_tambahBarang(Ruangan $ruangan)
    {
        $tahunNow = Carbon::now()->format('Y');
        return view('pages.tambah-barang', compact(['ruangan', 'tahunNow']));
    }

    public function storeBarang(Request $request, Ruangan $ruangan)
    {
        // START: Check validasi
        $rules = [
            'nama_barang' => 'required',
            'unit' => 'required',
            'kondisi' => 'required',
            'kategori_id' => 'required'
        ];
        $message = [
            'nama_barang.required' => 'Nama barang harus diisi!',
            'unit.required' => 'Unit harus diisi!',
            'kondisi.required' => 'Kondisi harus diisi!',
            'kategori_id.required' => 'Kategori harus diisi!'
        ];
        $validate = $this->validate($request, $rules, $message);
        // END: Check validasi

        if($validate) {
            if($request->file('image_url') != null) {
                // START: Upload Gambar
                $file = $request->file('image_url');
                $fileName = $request->nama_barang . '.' . $file->extension();
                $file->storeAs('public/unggah/Barang/' . $ruangan->nama_ruangan, $fileName);
                // END: Upload Gambar

                // START: Simpan data ke database
                Barang::create([
                    'nama_barang' => $request->nama_barang,
                    'merek' => $request->merek,
                    'no_reg' => $request->no_reg,
                    'tahun' => $request->tahun,
                    'unit' => $request->unit,
                    'kondisi' => $request->kondisi,
                    'image_url' => $fileName,
                    'kategori_id' => $request->kategori_id,
                    'ruangan_id' => $ruangan->id,
                ]);
                // END: Simpan data ke database

                return redirect()->route('kelola-barang', $ruangan->id)->with('sukses', 'Barang berhasil ditambahkan!');
            } else {
                // START: Simpan data ke database
                Barang::create([
                    'nama_barang' => $request->nama_barang,
                    'merek' => $request->merek,
                    'no_reg' => $request->no_reg,
                    'tahun' => $request->tahun,
                    'unit' => $request->unit,
                    'kondisi' => $request->kondisi,
                    'kategori_id' => $request->kategori_id,
                    'ruangan_id' => $ruangan->id,
                ]);
                // END: Simpan data ke database

                return redirect()->route('kelola-barang', $ruangan->id)->with('sukses', 'Barang berhasil ditambahkan!');
            }
        }
    }

    public function view_editBarang(Ruangan $ruangan, Barang $barang)
    {
        $tahunNow = Carbon::now()->format('Y');
        return view('pages.edit-barang', compact(['ruangan', 'barang', 'tahunNow']));
    }

    public function destroyFotoBarang(Ruangan $ruangan, Barang $barang)
    {
        $countDb = Barang::where('ruangan_id', $ruangan->id)->where('image_url', $barang->image_url)->get()->count();

        if($barang->image_url != null) {
            if($countDb > 1) {
                $barang->update([
                    'image_url' => null,
                ]);
            } else {
                Storage::delete('public/unggah/Barang/' . $ruangan->nama_ruangan . '/' . $barang->image_url);

                $barang->update([
                    'image_url' => null,
                ]);
            }

            return redirect()->route('edit-barang', [$ruangan->id, $barang->id])->with('sukses', 'Foto berhasil dihapus!');
        }
    }

    public function storeEditBarang(Request $request, Ruangan $ruangan, Barang $barang)
    {
        // START: Check validasi data
        $rules = [
            'nama_barang' => 'required',
            'unit' => 'required',
            'kondisi' => 'required',
            'kategori_id' => 'required'
        ];
        $message = [
            'nama_barang.required' => 'Nama barang harus diisi!',
            'unit.required' => 'Unit harus diisi!',
            'kondisi.required' => 'Kondisi harus diisi!',
            'kategori_id.required' => 'Kategori harus diisi!'
        ];
        $validate = $this->validate($request, $rules, $message);
        // END: Check validasi data

        if($validate) {
            if($request->file('image_url') != null) {
                // START: Upload gambar
                $file = $request->file('image_url');
                $fileName = $request->nama_barang . '.' . $file->extension();
                $file->storeAs('public/unggah/Barang/' . $ruangan->nama_ruangan, $fileName);
                // END: Upload gambar

                // START: Simpan data ke database
                $barang->update([
                    'nama_barang' => $request->nama_barang,
                    'merek' => $request->merek,
                    'no_reg' => $request->no_reg,
                    'tahun' => $request->tahun,
                    'unit' => $request->unit,
                    'kondisi' => $request->kondisi,
                    'image_url' => $fileName,
                    'kategori_id' => $request->kategori_id,
                ]);
                // END: Simpan data ke database

                return redirect()->route('kelola-barang', $ruangan->id)->with('sukses', 'Data barang berhasil diubah!');
            } else {
                // START: Simpan data ke database
                $barang->update([
                    'nama_barang' => $request->nama_barang,
                    'merek' => $request->merek,
                    'no_reg' => $request->no_reg,
                    'tahun' => $request->tahun,
                    'unit' => $request->unit,
                    'kondisi' => $request->kondisi,
                    'kategori_id' => $request->kategori_id,
                ]);
                // END: Simpan data ke database

                return redirect()->route('kelola-barang', $ruangan->id)->with('sukses', 'Data barang berhasil diubah!');
            }
        }
    }

    public function destroyBarang(Ruangan $ruangan, Barang $barang)
    {
        $countDb = Barang::where('ruangan_id', $ruangan->id)->where('image_url', $barang->image_url)->get()->count();
        
        // START: Delete image
        if($barang->image_url != null) {
            if($countDb > 1) {
                $barang->delete();
            } else {
                Storage::move('public/unggah/Barang/'.$ruangan->nama_ruangan.'/'.$barang->image_url, 'public/unggah/Trashed/Barang/'.$ruangan->nama_ruangan.'/'.$barang->image_url);

                $barang->delete();
            }
        } else {
            $barang->delete();
        }
        // END: Delete image

        return redirect()->route('kelola-barang', $ruangan->id)->with('sukses', 'Barang berhasil dihapus!');
    }

    public function destroySemuaBarang(Ruangan $ruangan)
    {
        $semuaBarang = Barang::where('ruangan_id', $ruangan->id)->get()->count();

        if($semuaBarang > 0) {
            $directoryBarang = new Filesystem();
            $directoryBarang->copyDirectory('../storage/app/public/unggah/Barang/'.$ruangan->nama_ruangan, '../storage/app/public/unggah/Trashed/Barang/'.$ruangan->nama_ruangan);
            Storage::deleteDirectory('public/unggah/Barang/' . $ruangan->nama_ruangan);

            Barang::where('ruangan_id', $ruangan->id)->delete();

            return redirect()->route('kelola-barang', $ruangan->id)->with('sukses', 'Semua barang berhasil dihapus!');
        }else {
            return redirect()->route('kelola-barang', $ruangan->id)->with('gagal', 'Data sudah kosong!');
        }
    }

    public function view_tongSampahBarang(Ruangan $ruangan)
    {
        $barangTrashed = Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('pages.tong-sampah-barang', compact(['barangTrashed', 'ruangan']));
    }

    public function pulihkanBarang(Ruangan $ruangan, $id = null, $img = null)
    {
        if($id != null) {
            if($img != null) {
                $checkImgTrashed = Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->where('image_url', $img)->get()->count();

                if($checkImgTrashed > 1) {
                    Storage::move('public/unggah/Trashed/Barang/'.$ruangan->nama_ruangan.'/'.$img, 'public/unggah/Barang/'.$ruangan->nama_ruangan.'/'.$img);
                    Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->where('id', $id)->restore();
                }else{
                    $checkImgDb = Barang::where('ruangan_id', $ruangan->id)->where('image_url', $img)->get()->count();

                    if($checkImgDb > 0) {
                        Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->where('id', $id)->restore();
                    }else{
                        Storage::move('public/unggah/Trashed/Barang/'.$ruangan->nama_ruangan.'/'.$img, 'public/unggah/Barang/'.$ruangan->nama_ruangan.'/'.$img);
                        Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->where('id', $id)->restore();
                    }
                }
            }else{
                Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->where('id', $id)->restore();
            }

            return redirect()->route('tong-sampah-barang', $ruangan->id)->with('sukses', 'Barang berhasil dipulihkan!');
        }else{
            $barangTrashed = Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->get()->count();
            if($barangTrashed < 1) {
                return redirect()->route('tong-sampah-barang', $ruangan->id)->with('gagal', 'Data sudah kosong!');
            }else{
                $directoryBarang = new Filesystem();
                $directoryBarang->copyDirectory('../storage/app/public/unggah/Trashed/Barang/'.$ruangan->nama_ruangan, '../storage/app/public/unggah/Barang/'.$ruangan->nama_ruangan);
                Storage::deleteDirectory('public/unggah/Trashed/Barang/'.$ruangan->nama_ruangan);
    
                Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->restore();
            }
        }

        return redirect()->route('kelola-barang', $ruangan->id)->with('sukses', 'Barang berhasil dipulihkan!');
    }

    public function hapusPermanenBarang(Ruangan $ruangan, $id = null, $img = null)
    {
        if($id != null){
            if($img != null){
                $checkImgTrashed = Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->where('image_url', $img)->get()->count();

                if($checkImgTrashed > 1) {
                    Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->where('id', $id)->forceDelete();
                }else{
                    $checkImgDb = Barang::where('ruangan_id', $ruangan->id)->where('image_url', $img)->get()->count();

                    if($checkImgDb > 0){
                        Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->where('id', $id)->forceDelete();
                    }else{
                        Storage::delete('public/unggah/Trashed/Barang/'.$ruangan->nama_ruangan. '/' . $img);
                        Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->where('id', $id)->forceDelete();
                    }
                }
            }else{
                Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->where('id', $id)->forceDelete();
            }

            return redirect()->route('tong-sampah-barang', $ruangan->id)->with('sukses', 'Barang berhasil dihapus secara permanen!');
        }else{
            $barangTrashed = Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->get()->count();

            if($barangTrashed < 1){
                return redirect()->route('tong-sampah-barang', $ruangan->id)->with('gagal', 'Data sudah kosong!');
            }else{
                Storage::deleteDirectory('public/unggah/Trashed/Barang/'.$ruangan->nama_ruangan);
                Barang::where('ruangan_id', $ruangan->id)->onlyTrashed()->forceDelete();
            }

            return redirect()->route('kelola-barang', $ruangan->id)->with('sukses', 'Barang berhasil dihapus secara permanen!');
        }
    }
    // END: Barang


    // START: Laporan Barang Peruangan
    public function view_laporanBarangPeruangan()
    {
        $ruangan = Ruangan::orderBy('id', 'asc')->paginate(8);
        return view('pages.laporan-barang-peruangan', compact('ruangan'));
    }

    public function view_cetakLaporanBarangPeruangan(Ruangan $ruangan)
    {
        return view('pages.cetak-laporan-barang-peruangan', compact('ruangan'));
    }

    public function printLaporanBarangPeruangan(Request $request, Ruangan $ruangan)
    {
        $barang = Barang::query();
        $barang->where('ruangan_id', $ruangan->id);
        $tanggalNow = Carbon::now()->format('d');
        $bulanNow = Carbon::now()->format('F');
        $tahunNow = Carbon::now()->format('Y');
        $guruPenanggungJawab = Guru::where('id', $ruangan->guru_id)->get();

        if($request->filled('kategori_id')) {
            $barang->where('kategori_id', $request->kategori_id);
        }

        if($request->filled('kondisi')) {
            $barang->where('kondisi', $request->kondisi);
        }

        return view('pages.print-laporan-barang-peruangan', [
            'barang' => $barang->get(), 
            'ruangan' => $ruangan, 
            'tanggalNow' => $tanggalNow,
            'bulanNow' => $bulanNow,
            'tahunNow' => $tahunNow,
            'guruPenanggungJawab' => $guruPenanggungJawab
        ]);
    }
    // END: Laporan Barang Peruangan


    // START: Laporan Barang Perangkatan
    public function view_laporanBarangPerangkatan()
    {
        return view('pages.laporan-barang-perangkatan');
    }


    // START: VII
    public function view_cetakLaporanBarangAngkatanVII()
    {
        return view('pages.cetak-laporan-barang-angkatan-vii');
    }

    public function printLaporanBarangAngkatanVII(Request $request)
    {
        $tanggalNow = Carbon::now()->format('d');
        $bulanNow = Carbon::now()->format('F');
        $tahunNow = Carbon::now()->format('Y');

        $barang = DB::table('ruangan')->join('barang', 'ruangan.id', '=', 'barang.ruangan_id')
                    ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
                    ->where('nama_ruangan', 'LIKE', '%VII__')
                    ->orderBy('nama_ruangan', 'asc');

        if($request->filled('kategori_id')) {
            $barang->where('kategori_id', $request->kategori_id);
        }

        if($request->filled('kondisi')) {
            $barang->where('kondisi', $request->kondisi);
        }

        return view('pages.print-laporan-barang-angkatan-vii', [
            'barang' => $barang->get(),
            'tanggalNow' => $tanggalNow,
            'bulanNow' => $bulanNow,
            'tahunNow' => $tahunNow
        ]);
    }
    // END: VII


    // START: VIII
    public function view_cetakLaporanBarangAngkatanVIII()
    {
        return view('pages.cetak-laporan-barang-angkatan-viii');
    }

    public function printLaporanBarangAngkatanVIII(Request $request)
    {
        $tanggalNow = Carbon::now()->format('d');
        $bulanNow = Carbon::now()->format('F');
        $tahunNow = Carbon::now()->format('Y');

        $barang = DB::table('ruangan')->join('barang', 'ruangan.id', '=', 'barang.ruangan_id')
                    ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
                    ->where('nama_ruangan', 'LIKE', '%VIII__')
                    ->orderBy('nama_ruangan', 'asc');

        if($request->filled('kategori_id')) {
            $barang->where('kategori_id', $request->kategori_id);
        }

        if($request->filled('kondisi')) {
            $barang->where('kondisi', $request->kondisi);
        }
        
        return view('pages.print-laporan-barang-angkatan-viii', [
            'barang' => $barang->get(),
            'tanggalNow' => $tanggalNow,
            'bulanNow' => $bulanNow,
            'tahunNow' => $tahunNow
        ]);
    }
    // END: VIII


    // START: IX
    public function view_cetakLaporanBarangAngkatanIX()
    {
        return view('pages.cetak-laporan-barang-angkatan-ix');
    }

    public function printLaporanBarangAngkatanIX(Request $request)
    {
        $tanggalNow = Carbon::now()->format('d');
        $bulanNow = Carbon::now()->format('F');
        $tahunNow = Carbon::now()->format('Y');

        $barang = DB::table('ruangan')->join('barang', 'ruangan.id', '=', 'barang.ruangan_id')
                    ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
                    ->where('nama_ruangan', 'LIKE', '%IX__')
                    ->orderBy('nama_ruangan', 'asc');

        if($request->filled('kategori_id')) {
            $barang->where('kategori_id', $request->kategori_id);
        }

        if($request->filled('kondisi')) {
            $barang->where('kondisi', $request->kondisi);
        }

        return view('pages.print-laporan-barang-angkatan-ix', [
            'barang' => $barang->get(),
            'tanggalNow' => $tanggalNow,
            'bulanNow' => $bulanNow,
            'tahunNow' => $tahunNow
        ]);
    }
    // END: IX

    // END: Laporan Barang Perangkatan


    // START: Laporan Barang Semua Ruangan
    public function view_laporanBarangSemuaRuangan()
    {
        $dataBarang = Barang::orderBy('ruangan_id', 'asc')->paginate(10);
        return view('pages.laporan-barang-semua-ruangan', compact('dataBarang'));
    }

    public function printLaporanBarangSemuaRuangan(Request $request)
    {
        $barang = Barang::query();
        $barang->orderBy('ruangan_id', 'asc');
        $tanggalNow = Carbon::now()->format('d');
        $bulanNow = Carbon::now()->format('F');
        $tahunNow = Carbon::now()->format('Y');

        if($request->filled('kategori_id')) {
            $barang->where('kategori_id', $request->kategori_id);
        }

        if($request->filled('kondisi')) {
            $barang->where('kondisi', $request->kondisi);
        }

        return view('pages.print-laporan-barang-semua-ruangan', [
            'barang' => $barang->get(),
            'tanggalNow' => $tanggalNow,
            'bulanNow' => $bulanNow,
            'tahunNow' => $tahunNow
        ]);
    }
    // END: Laporan Barang Semua Ruangan


    // START: Pengguna (Users)
    public function view_pengguna()
    {
        $users = User::where('role', 1)->orderBy('name', 'asc')->paginate(5);
        return view('pages.pengguna', compact(['users']));
    }

    public function view_tambahPengguna()
    {
        return view('pages.tambah-pengguna');
    }

    public function storePengguna(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'min:8|confirmed',
        ];

        $message = [
            'name.required' => 'Nama lengkap harus diisi!',
            'email.required' => 'Email address harus diisi!',
            'unique' => 'Email sudah terdaftar!',
            'password.min' => 'Password minimal 8 karakter!',
            'password.confirmed' => 'Password tidak sama dengan konfirmasi password!'
        ];

        $validate = $this->validate($request, $rules, $message);

        if($validate) {
            if($request->file('image_url') != null) {
                // START: Upload gambar
                $file = $request->file('image_url');
                $fileName = $request->name . '.' . $file->extension();
                $file->storeAs('public/unggah/Profile/Operator/', $fileName);
                // END: Upload gambar

                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'image_url' => $fileName,
                    'role' => 1,
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->route('pengguna')->with('sukses', 'Pengguna berhasil didaftarkan!');
            } else {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 1,
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->route('pengguna')->with('sukses', 'Pengguna berhasil didaftarkan!');
            }
        }
    }

    public function destroyPengguna(User $users)
    {
        if($users->image_url != null){
            $countImg = User::where('role', 1)->where('image_url', $users->image_url)->get()->count();

            if($countImg > 1) {
                $users->delete();
            }else{
                Storage::move('public/unggah/Profile/Operator/'.$users->image_url, 'public/unggah/Trashed/Profile/Operator/'.$users->image_url);
                $users->delete();
            }
        }else{
            $users->delete();
        }

        return redirect()->route('pengguna')->with('sukses', 'Pengguna berhasil dihapus!');
    }

    public function destroySemuaPengguna()
    {
        $semuaPengguna = User::where('role', 1)->get()->count();

        if($semuaPengguna < 1) {
            return redirect()->route('pengguna')->with('gagal', 'Data sudah kosong!');
        }else {
            $directoryPengguna = new Filesystem();
            $directoryPengguna->copyDirectory('../storage/app/public/unggah/Profile/Operator', '../storage/app/public/unggah/Trashed/Profile/Operator');
            Storage::deleteDirectory('public/unggah/Profile/Operator');

            User::query()->where('role', 1)->delete();

            return redirect()->route('pengguna')->with('sukses', 'Semua pengguna berhasil dihapus!');
        }
    }

    public function view_tongSampahPengguna()
    {
        $penggunaTrashed = User::where('role', 1)->onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('pages.tong-sampah-pengguna', compact('penggunaTrashed'));
    }

    public function pulihkanPengguna($id = null, $img = null)
    {
        if($id != null) {
            if($img != null) {
                $checkImgTrashed = User::where('role', 1)->onlyTrashed()->where('image_url', $img)->get()->count();

                if($checkImgTrashed > 1) {
                    Storage::move('public/unggah/Trashed/Profile/Operator/'.$img, 'public/unggah/Profile/Operator/'.$img);
                    User::where('role', 1)->onlyTrashed()->where('id', $id)->restore();
                }else{
                    $checkImgDb = User::where('role', 1)->where('image_url', $img)->get()->count();

                    if($checkImgDb > 0) {
                        User::where('role', 1)->onlyTrashed()->where('id', $id)->restore();
                    }else{
                        Storage::move('public/unggah/Trashed/Profile/Operator/'.$img, 'public/unggah/Profile/Operator/'.$img);
                        User::where('role', 1)->onlyTrashed()->where('id', $id)->restore();
                    }
                }
            }else{
                User::where('role', 1)->onlyTrashed()->where('id', $id)->restore();
            }

            return redirect()->route('tong-sampah-pengguna')->with('sukses', 'Pengguna berhasil dipulihkan!');
        }else{
            $penggunaTrashed = User::where('role', 1)->onlyTrashed()->get()->count();
            if($penggunaTrashed < 1) {
                return redirect()->route('tong-sampah-pengguna')->with('gagal', 'Data sudah kosong!');
            }else{
                $directoryPengguna = new Filesystem();
                $directoryPengguna->copyDirectory('../storage/app/public/unggah/Trashed/Profile/Operator', '../storage/app/public/unggah/Profile/Operator');
                Storage::deleteDirectory('public/unggah/Trashed/Profile/Operator');
    
                User::where('role', 1)->onlyTrashed()->restore();
            }

            return redirect()->route('pengguna')->with('sukses', 'Pengguna berhasil dipulihkan!');
        }
    }

    public function hapusPermanenPengguna($id = null, $img = null)
    {
        if($id != null){
            if($img != null){
                $checkImgTrashed = User::where('role', 1)->onlyTrashed()->where('image_url', $img)->get()->count();

                if($checkImgTrashed > 1) {
                    User::where('role', 1)->onlyTrashed()->where('id', $id)->forceDelete();
                }else{
                    $checkImgDb = User::where('role', 1)->where('image_url', $img)->get()->count();

                    if($checkImgDb > 0){
                        User::where('role', 1)->onlyTrashed()->where('id', $id)->forceDelete();
                    }else{
                        Storage::delete('public/unggah/Trashed/Profile/Operator/' . $img);
                        User::where('role', 1)->onlyTrashed()->where('id', $id)->forceDelete();
                    }
                }
            }else{
                User::where('role', 1)->onlyTrashed()->where('id', $id)->forceDelete();
            }

            return redirect()->route('tong-sampah-pengguna')->with('sukses', 'Pengguna berhasil dihapus secara permanen!');
        }else{
            $penggunaTrashed = User::where('role', 1)->onlyTrashed()->get()->count();

            if($penggunaTrashed < 1){
                return redirect()->route('tong-sampah-pengguna')->with('gagal', 'Data sudah kosong!');
            }else{
                Storage::deleteDirectory('public/unggah/Trashed/Profile/Operator');
                User::where('role', 1)->onlyTrashed()->forceDelete();
            }

            return redirect()->route('pengguna')->with('sukses', 'Pengguna berhasil dihapus secara permanen!');
        }
    }
    // END: Pengguna (Users)


    // START: Profile Setiap Pengguna
    public function view_profile(User $users)
    {
        return view('pages.profile-users', compact(['users']));
    }

    public function destroyFotoProfile(User $users)
    {
        if($users->image_url != null) {
            if($users->role == 0) {
                Storage::delete('public/unggah/Profile/Admin/' . $users->image_url);
            }else {
                Storage::delete('public/unggah/Profile/Operator/' . $users->image_url);
            }

            $users->update([
                'image_url' => null,
            ]);

            return redirect()->route('profile', $users->id)->with('sukses', 'Foto profile berhasil dihapus!');
        }
    }

    public function storeProfile(Request $request, User $users)
    {
        $rules = ['name' => 'required|string'];
        $message = ['name.required' => 'Nama harus diisi!'];
        $validate = $this->validate($request, $rules, $message);

        if($validate) {
            if($request->file('image_url') != null) {
                if($users->role == 0) {
                    // START: Upload gambar
                    $file = $request->file('image_url');
                    $fileName = $request->name . '.' . $file->extension();
                    $file->storeAs('public/unggah/Profile/Admin/', $fileName);
                    // END: Upload gambar
                }else {
                    // START: Upload gambar
                    $file = $request->file('image_url');
                    $fileName = $request->name . '.' . $file->extension();
                    $file->storeAs('public/unggah/Profile/Operator/', $fileName);
                    // END: Upload gambar
                }

                $users->update([
                    'name' => $request->name,
                    'image_url' => $fileName,
                ]);

                return redirect()->back()->with('sukses', 'Profile berhasil diubah!');
            } else {
                $users->update([
                    'name' => $request->name,
                ]);

                return redirect()->back()->with('sukses', 'Profile berhasil diubah!');
            }
        }
    }
    // END: Profile Setiap Pengguna


    // START: Ganti Email
    public function view_ubahEmail(User $users)
    {
        return view('pages.ubah-email', compact('users'));
    }

    public function storeUbahEmail(Request $request, User $users)
    {
        $rules = ['email' => 'email|unique:users'];
        $message = ['email.unique' => 'Email sudah digunakan!'];
        $validate = $this->validate($request, $rules, $message);

        if($validate){
            $users->update([
                'email' => $request->email,
                'email_verified_at' => null
            ]);
            return redirect()->route('profile', $users->id)->with('sukses', 'Email anda berhasil diubah!');
        }
    }
    // END: Ganti Email


    // START: Ganti Password
    public function view_gantiPassword(User $users)
    {
        return view('pages.ganti-password', compact(['users']));
    }

    public function storeGantiPassword(Request $request, User $users)
    {
        if(!(Hash::check($request->password_lama, $users->password))) {
            return back()->with('gagal', 'Password lama anda salah!');
        }

        if(strcmp($request->password_lama, $request->password_baru) == 0) {
            return back()->with('gagal', 'Password lama tidak boleh sama dengan password baru!');
        }

        $rules = [
            'password_lama' => 'required',
            'password_baru' => 'required|string|min:8',
            'password_konfirmasi' => 'same:password_baru',
        ];

        $message = [
            'password_lama.required' => 'Password lama harus diisi!',
            'password_baru.required' => 'Password baru harus diisi!',
            'password_baru.string' => 'Password baru harus berupa karakter, huruf atau angka!',
            'password_baru.min' => 'Password baru minimal 8 karakter!',
            'password_konfirmasi.same' => 'Password baru dan konfirmasi password tidak sama!',
        ];

        $validate = $this->validate($request, $rules, $message);

        if($validate) {
            $users->update([
                'password' => Hash::make($request->password_baru)
            ]);
            return redirect()->route('profile', $users->id)->with('sukses', 'Password berhasil diganti!');
        }
    }
    // END: Ganti Password


    // START: Quick Response (QR) Code
    public function view_QRCode(Ruangan $ruangan)
    {
        return view('pages.qrcode', compact(['ruangan']));
    }

    public function view_printQRCode(Ruangan $ruangan)
    {
        return view('pages.print-qrcode', compact('ruangan'));
    }

    public function view_scanQRCode(Ruangan $ruangan)
    {
        $barang = Barang::where('ruangan_id', $ruangan->id)->orderBy('nama_barang', 'asc')->get();
        return view('pages.scan-qrcode', compact(['barang', 'ruangan']));
    }
    // END: Quick Response (QR) Code


    // START: Export Data Barang ke Excel (.xlsx)
    public function exportBarangExcel(Ruangan $ruangan)
    {
        return Excel::download(new BarangExport($ruangan->id, $ruangan->nama_ruangan, $ruangan->guru_id), 'Ekspor - ' .$ruangan->nama_ruangan. '.xlsx');
    }
    // END: Export Data Barang ke Excel (.xlsx)

}
