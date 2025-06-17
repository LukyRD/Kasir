<?php

namespace App\Http\Controllers;

use App\Models\ItemsBarangMasuk;
use App\Models\ItemsKasir;
use App\Models\Kasir;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;

        $produk = Produk::count();

        $pendapatan = Kasir::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->sum('total');

        $pengeluaran = ItemsBarangMasuk::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->sum('total');

        $penjualan = Kasir::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->count();

        $produkTerlaris = ItemsKasir::select('nama_produk')
            ->selectRaw("SUM(qty) as total_terjual")
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('nama_produk')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        $produkStokMin = Produk::whereColumn('stok', '<=', 'stok_minimal')->get();

        // dd($produkStokMin);
        return view('dashboard', ['produk' => $produk, 'pendapatan' => number_format($pendapatan), 'pengeluaran' => number_format($pengeluaran), 'penjualan' => $penjualan, "produkTerlaris" => $produkTerlaris, 'produkStokMin' => $produkStokMin]);
    }
}
