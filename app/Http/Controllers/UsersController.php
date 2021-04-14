<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\SumberDana;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function view_dashboard()
    {
        return view('pages.dashboard');
    }

    public function view_kelolaRuangan(Request $request)
    {
        if($request->has('cari')) {
            $ruangan = Ruangan::where('nama_ruangan', 'LIKE', '%' .$request->cari. '%')->paginate(8);
        }else {
            $ruangan = Ruangan::orderBy('nama_ruangan', 'asc')->paginate(8);
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
        $rules = ['nama_ruangan' => 'required'];
        $message = ['nama_ruangan.required' => 'Nama ruangan harus diisi!'];
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
                ]);
                // END: Simpan data ke database
                return redirect()->route('kelola-ruangan')->with('sukses', 'Ruangan berhasil ditambahkan!');
            } else {
                // START: Simpan data ke database
                Ruangan::create([
                    'kode_ruangan' => $request->kode_ruangan,
                    'nama_ruangan' => $request->nama_ruangan
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
        $rules = ['nama_ruangan' => 'required'];
        $message = ['nama_ruangan.required' => 'Nama ruangan harus diisi!'];
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
                    'image_url' => $fileName
                ]);
                // END: Simpan data ke database
                return redirect()->route('kelola-ruangan')->with('sukses', 'Ruangan berhasil diubah!');
            } else {
                // START: Simpan data ke database
                $ruangan->update([
                    'kode_ruangan' => $request->kode_ruangan,
                    'nama_ruangan' => $request->nama_ruangan
                ]);
                // END: Simpan data ke database
                return redirect()->route('kelola-ruangan')->with('sukses', 'Ruangan berhasil diubah!');
            }
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

    public function view_kelolaSumberDana()
    {
        $dataSumberDana = SumberDana::orderBy('sumber_dana', 'asc')->paginate(5);
        return view('pages.sumber-dana', compact('dataSumberDana'));
    }

    public function destroySumberDana(SumberDana $sumberDana)
    {
        $checkDb = Barang::where('sumber_dana_id', $sumberDana->id)->get()->count();

        if($checkDb > 0) {
            return redirect()->route('kelola-sumber-dana')->with('gagal', 'Sumber dana tidak bisa dihapus karena masih digunakan pada barang!');
        } else {
            $sumberDana->delete();
        }

        return redirect()->route('kelola-sumber-dana')->with('sukses', 'Sumber dana berhasil dihapus!');
    }

    public function destroySemuaSumberDana()
    {
        $checkSumberDana = Barang::select('sumber_dana_id')->get()->count();
        if($checkSumberDana > 0) {
            return redirect()->route('kelola-sumber-dana')->with('gagal', 'Semua sumber dana tidak bisa dihapus karena masih ada salah satu sumber dana yang digunakan pada barang!');
        }else {
            $dataSumberDana = SumberDana::all()->count();

            if($dataSumberDana < 1) {
                return redirect()->route('kelola-sumber-dana')->with('gagal', 'Data sudah kosong!');
            }else{
                SumberDana::query()->delete();

                return redirect()->route('kelola-sumber-dana')->with('sukses', 'Semua sumber dana berhasil dihapus!');
            }
        }
    }

    public function storeSumberDana(Request $request)
    {
        $rules = ['sumber_dana' => 'required'];
        $message = ['sumber_dana.required' => 'Sumber dana harus diisi!'];
        $validate = $this->validate($request, $rules, $message);

        if($validate) {
            SumberDana::create(['sumber_dana' => $request->sumber_dana]);

            return redirect()->route('kelola-sumber-dana')->with('sukses', 'Sumber dana berhasil ditambahkan!');
        }
    }

    public function view_editSumberDana(SumberDana $sumberDana)
    {
        return view('pages.edit-sumber-dana', compact(['sumberDana']));
    }

    public function storeEditSumberDana(Request $request, SumberDana $sumberDana)
    {
        $rules = ['sumber_dana' => 'required'];
        $message = ['sumber_dana.required' => 'Sumber dana harus diisi!'];
        $validate = $this->validate($request, $rules, $message);

        if($validate){
            $sumberDana->update(['sumber_dana' => $request->sumber_dana]);

            return redirect()->route('kelola-sumber-dana')->with('sukses', 'Sumber dana berhasil diubah!');
        }
    }

    public function view_tongSampahSumberDana()
    {
        $sumberDanaTrashed = SumberDana::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('pages.tong-sampah-sumber-dana', compact('sumberDanaTrashed'));
    }

    public function pulihkanSumberDana($id = null)
    {
        if($id != null) {
            SumberDana::onlyTrashed()->where('id', $id)->restore();
            return redirect()->route('tong-sampah-sumber-dana')->with('sukses', 'Data berhasil dipulihkan!');
        }else {
            SumberDana::onlyTrashed()->restore();
            return redirect()->route('kelola-sumber-dana')->with('sukses', 'Data berhasil dipulihkan!');
        }
    }

    public function hapusPermanenSumberDana($id = null)
    {
        if($id != null) {
            SumberDana::onlyTrashed()->where('id', $id)->forceDelete();
            return redirect()->route('tong-sampah-sumber-dana')->with('sukses', 'Data berhasil dihapus secara permanen!');
        } else {
            SumberDana::onlyTrashed()->forceDelete();
            return redirect()->route('kelola-sumber-dana')->with('sukses', 'Data berhasil dihapus secara permanen!');
        }
    }

    public function view_kelolaBarang(Request $request, Ruangan $ruangan)
    {
        // Eloquent
        $barang = Barang::query();
        $barang->where('ruangan_id', $ruangan->id);

        if($request->filled('nama_barang')) {
            $barang->where('nama_barang', $request->nama_barang);
        }

        if($request->filled('sumber_dana_id')) {
            $barang->where('sumber_dana_id', $request->sumber_dana_id);
        }

        if($request->filled('kondisi')) {
            $barang->where('kondisi', $request->kondisi);
        }

        return view('pages.kelola-barang', ['ruangan' => $ruangan, 'barang' => $barang->orderBy('nama_barang', 'asc')->paginate(5)]);
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
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
            'sumber_dana_id' => 'required',
            'kondisi' => 'required',
        ];
        $message = [
            'kode_barang.required' => 'Kode barang harus diisi!',
            'nama_barang.required' => 'Nama barang harus diisi!',
            'jumlah.required' => 'Jumlah barang harus diisi!',
            'satuan.required' => 'Satuan barang harus diisi!',
            'sumber_dana_id.required' => 'Sumber dana harus diisi!',
            'kondisi.required' => 'Kondisi barang harus diisi!',
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
                    'kode_barang' => $request->kode_barang,
                    'nama_barang' => $request->nama_barang,
                    'merek' => $request->merek,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'sumber_dana_id' => $request->sumber_dana_id,
                    'tahun_barang' => $request->tahun_barang,
                    'kondisi' => $request->kondisi,
                    'image_url' => $fileName,
                    'ruangan_id' => $ruangan->id,
                ]);
                // END: Simpan data ke database

                return redirect()->route('kelola-barang', $ruangan->id)->with('sukses', 'Barang berhasil ditambahkan!');
            } else {
                // START: Simpan data ke database
                Barang::create([
                    'kode_barang' => $request->kode_barang,
                    'nama_barang' => $request->nama_barang,
                    'merek' => $request->merek,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'sumber_dana_id' => $request->sumber_dana_id,
                    'tahun_barang' => $request->tahun_barang,
                    'kondisi' => $request->kondisi,
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
            'kode_barang' => 'required', 
            'nama_barang' => 'required', 
            'sumber_dana_id' => 'required',
        ];
        $message = [
            'kode_barang.required' => 'Kode barang harus diisi!',
            'nama_barang.required' => 'Nama barang harus diisi!',
            'sumber_dana_id.required' => 'Sumber dana harus diisi!',
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
                    'kode_barang' => $request->kode_barang,
                    'nama_barang' => $request->nama_barang,
                    'merek' => $request->merek,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'sumber_dana_id' => $request->sumber_dana_id,
                    'tahun_barang' => $request->tahun_barang,
                    'kondisi' => $request->kondisi,
                    'image_url' => $fileName,
                ]);
                // END: Simpan data ke database

                return redirect()->route('kelola-barang', $ruangan->id)->with('sukses', 'Data barang berhasil diubah!');
            } else {
                // START: Simpan data ke database
                $barang->update([
                    'kode_barang' => $request->kode_barang,
                    'nama_barang' => $request->nama_barang,
                    'merek' => $request->merek,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'sumber_dana_id' => $request->sumber_dana_id,
                    'tahun_barang' => $request->tahun_barang,
                    'kondisi' => $request->kondisi,
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

    public function view_laporanBarang(Request $request, Ruangan $ruangan)
    {
        $barang = Barang::query();
        $barang->where('ruangan_id', $ruangan->id);

        if($request->filled('nama_barang')) {
            $barang->where('nama_barang', $request->nama_barang);
        }

        if($request->filled('sumber_dana_id')) {
            $barang->where('sumber_dana_id', $request->sumber_dana_id);
        }

        if($request->filled('kondisi')) {
            $barang->where('kondisi', $request->kondisi);
        }

        return view('pages.laporan-barang', [
            'ruangan' => $ruangan,
            'barang' => $barang->get(),
        ]);
    }

    public function print(Request $request, Ruangan $ruangan)
    {
        $barang = Barang::query();
        $barang->where('ruangan_id', $ruangan->id);
        $tanggalNow = Carbon::now()->format('d');
        $bulanNow = Carbon::now()->format('F');
        $tahunNow = Carbon::now()->format('Y');

        if($request->filled('nama_barang')) {
            $barang->where('nama_barang', $request->nama_barang);
        }

        if($request->filled('sumber_dana_id')) {
            $barang->where('sumber_dana_id', $request->sumber_dana_id);
        }

        if($request->filled('kondisi')) {
            $barang->where('kondisi', $request->kondisi);
        }

        return view('pages.print', [
            'barang' => $barang->get(), 
            'ruangan' => $ruangan, 
            'tanggalNow' => $tanggalNow,
            'bulanNow' => $bulanNow,
            'tahunNow' => $tahunNow,
        ]);
    }

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
            'username' => 'required|string|unique:users',
            'password' => 'min:6',
        ];

        $message = [
            'name.required' => 'Nama pengguna harus diisi!',
            'username.required' => 'Username harus diisi!',
            'unique' => 'Username sudah terdaftar!',
            'password.min' => 'Password minimal 6 karakter!',
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
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'image_url' => $fileName,
                    'role' => 1,
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->route('pengguna')->with('sukses', 'Pengguna berhasil didaftarkan!');
            } else {
                User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
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
            'password_baru' => 'required|string|min:6',
            'password_konfirmasi' => 'same:password_baru',
        ];

        $message = [
            'password_lama.required' => 'Password lama harus diisi!',
            'password_baru.required' => 'Password baru harus diisi!',
            'password_baru.string' => 'Password baru harus berupa karakter, huruf atau angka!',
            'password_baru.min' => 'Password baru minimal 6 karakter!',
            'password_konfirmasi.same' => 'Password baru dan konfirmasi password tidak sama!',
        ];

        $validate = $this->validate($request, $rules, $message);

        if($validate) {
            $users->update([
                'password' => bcrypt($request->password_baru)
            ]);
            return redirect()->route('profile', $users->id)->with('sukses', 'Password berhasil diganti!');
        }
    }

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

    public function exportBarangExcel(Ruangan $ruangan)
    {
        return Excel::download(new BarangExport($ruangan->id, $ruangan->nama_ruangan), 'Ekspor - ' .$ruangan->nama_ruangan. '.xlsx');
    }
}
