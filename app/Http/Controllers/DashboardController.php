<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogistikTambang;
use App\Models\TransaksiLogistik;


class DashboardController extends Controller
{
    //
    public function index()
    {
        // 1. Hitung ringkasan statistik dasar gudang logistik
        $totalBarang = LogistikTambang::count();
        $stokKritis = LogistikTambang::whereColumn('stok_aktual', '<=', 'stok_minimum')->count();
        $transaksiHariIni = TransaksiLogistik::whereDate('tanggal_transaksi', today())->count();

        // 2. Jalankan komparasi K-Means ringkas untuk widget visual status cluster
        $barang = LogistikTambang::with(['transaksi' => function($q) {
            $q->where('jenis_transaksi', 'Keluar');
        }])->get();

        $fastMovingCount = 0;
        $mediumMovingCount = 0;
        $slowMovingCount = 0;

        if ($barang->count() >= 3) {
            $dataset = [];
            foreach ($barang as $item) {
                $dataset[] = [
                    'x' => $item->transaksi->sum('kuantitas'),
                    'y' => $item->transaksi->count(),
                    'cluster' => null
                ];
            }

            $k = 3;
            $centroids = [
                ['x' => $dataset[0]['x'], 'y' => $dataset[0]['y']],
                ['x' => $dataset[1]['x'], 'y' => $dataset[1]['y']],
                ['x' => $dataset[2]['x'], 'y' => $dataset[2]['y']],
            ];

            for ($iter = 0; $iter < 5; $iter++) {
                foreach ($dataset as $idx => $data) {
                    $minDist = INF;
                    $closest = 0;
                    for ($i = 0; $i < $k; $i++) {
                        $dist = sqrt(pow($data['x'] - $centroids[$i]['x'], 2) + pow($data['y'] - $centroids[$i]['y'], 2));
                        if ($dist < $minDist) {
                            $minDist = $dist;
                            $closest = $i;
                        }
                    }
                    $dataset[$idx]['cluster'] = $closest;
                }

                $newC = array_fill(0, $k, ['x' => 0, 'y' => 0, 'count' => 0]);
                foreach ($dataset as $d) {
                    $c = $d['cluster'];
                    $newC[$c]['x'] += $d['x'];
                    $newC[$c]['y'] += $d['y'];
                    $newC[$c]['count']++;
                }
                for ($i = 0; $i < $k; $i++) {
                    if ($newC[$i]['count'] > 0) {
                        $centroids[$i]['x'] = $newC[$i]['x'] / $newC[$i]['count'];
                        $centroids[$i]['y'] = $newC[$i]['y'] / $newC[$i]['count'];
                    }
                }
            }

            $sortC = [];
            foreach ($centroids as $index => $c) { $sortC[$index] = $c['x']; }
            asort($sortC);
            
            $mapping = [];
            $labels = ['slow', 'medium', 'fast'];
            $lIdx = 0;
            foreach ($sortC as $origIndex => $val) {
                $mapping[$origIndex] = $labels[$lIdx++];
            }

            foreach ($dataset as $d) {
                $lbl = $mapping[$d['cluster']];
                if ($lbl === 'fast') $fastMovingCount++;
                elseif ($lbl === 'medium') $mediumMovingCount++;
                else $slowMovingCount++;
            }
        }

        // 3. Ambil data stok kritis teratas untuk peringatan dini operasional
        $barangKritis = LogistikTambang::whereColumn('stok_aktual', '<=', 'stok_minimum')
                                        ->orderBy('stok_aktual', 'asc')
                                        ->take(5)
                                        ->get();

        return view('dashboard', compact('totalBarang', 'stokKritis', 'transaksiHariIni', 'fastMovingCount', 'mediumMovingCount', 'slowMovingCount', 'barangKritis'));
    }
}
