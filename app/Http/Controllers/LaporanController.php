<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasmasuk;
use App\Models\SumberMasuk;
use App\Models\SumberKeluar;
use App\Models\Kaskeluar;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)

    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', Auth::user()->id)->get();
        $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')->where('id_user', Auth::user()->id)->orderBy('tanggal', 'desc')->latest()->paginate(5);
        $jumlahmasuk = Kasmasuk::where('id_user', Auth::user()->id)->sum('jumlah');

        $sumberkeluar = SumberKeluar::select('id', 'nama')->where('id_user', Auth::user()->id)->get();
        $kaskeluar = Kaskeluar::select('id', 'tanggal', 'bukti', 'jumlah', 'deskripsi', 'id_sumberkeluar')->where('id_user', Auth::user()->id)->orderBy('tanggal', 'desc')->latest()->paginate(5);
        $jumlahkeluar = Kaskeluar::where('id_user', Auth::user()->id)->sum('jumlah');

        return  view('admin/kas/laporan/index', compact('kasmasuk', 'jumlahmasuk', 'jumlahkeluar', 'awal', 'akhir', 'sumbermasuk', 'sumberkeluar', 'kaskeluar',));
    }

    public function carilaporan(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', Auth::user()->id)->get();
        $jumlahmasuk = Kasmasuk::where('id_user', Auth::user()->id)->sum('jumlah');

        $sumberkeluar = SumberKeluar::select('id', 'nama')->where('id_user', Auth::user()->id)->get();
        $jumlahkeluar = Kaskeluar::where('id_user', Auth::user()->id)->sum('jumlah');

        if (request()->awal) {
            $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', Auth::user()->id)
                ->paginate();
            if (count($kasmasuk) == 0) {
                Alert::warning('Pencarian', 'Data yang anda cari tidak ditemukan');
            }
        }
        if (request()->awal) {
            $kaskeluar = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'bukti', 'id_sumberkeluar')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', Auth::user()->id)
                ->paginate();
            if (count($kaskeluar) == 0) {
                Alert::warning('Pencarian', 'Data yang anda cari tidak ditemukan');
            }
        } else {
            return redirect('/laporan');
            // $kaskeluar = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumberkeluar')->where('id_user', Auth::user()->id)->latest()->paginate(5);
        }

        return view('admin/kas/laporan/index', compact('kaskeluar', 'kasmasuk', 'sumbermasuk', 'jumlahmasuk', 'jumlahkeluar', 'awal', 'akhir', 'sumberkeluar'));
    }

    public function laporanpdf(Request $request, $awal = false, $akhir = false)
    {
        $tanggal = $date = Carbon::now()->toDateTimeString();

        if ($awal) {
            $laporanmasukpdf = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', Auth::user()->id)
                ->paginate();
            $jumlahmasuk1 = Kasmasuk::where('id_user', Auth::user()->id)->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->sum('jumlah');
            $jumlahmasuk = Kasmasuk::where('id_user', Auth::user()->id)->sum('jumlah');
        }
        if ($awal) {
            $laporankeluarpdf = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'bukti', 'id_sumberkeluar')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', Auth::user()->id)
                ->paginate();
            $jumlahkeluar1 = Kaskeluar::where('id_user', Auth::user()->id)->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->sum('jumlah');
            $jumlahkeluar = Kaskeluar::where('id_user', Auth::user()->id)->sum('jumlah');
        } else {
            $laporanmasukpdf = Kasmasuk::all()->where('id_user', Auth::user()->id);
            $jumlahmasuk = Kasmasuk::where('id_user', Auth::user()->id)->sum('jumlah');
            $jumlahmasuk1 = Kasmasuk::where('id_user', Auth::user()->id)->sum('jumlah');

            $laporankeluarpdf = Kaskeluar::all()->where('id_user', Auth::user()->id);
            $jumlahkeluar = Kaskeluar::where('id_user', Auth::user()->id)->sum('jumlah');
            $jumlahkeluar1 = Kaskeluar::where('id_user', Auth::user()->id)->sum('jumlah');
        }

        $pdf = PDF::loadView('admin/kas/laporan/laporanpdf', compact(
            'awal',
            'akhir',
            'tanggal',
            'laporanmasukpdf',
            'laporankeluarpdf',
            'jumlahmasuk',
            'jumlahmasuk1',
            'jumlahkeluar',
            'jumlahkeluar1',
        ));
        return $pdf->stream();
    }
}
