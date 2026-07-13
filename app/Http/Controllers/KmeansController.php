<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogistikTambang;

class KmeansController extends Controller
{
    //
    public function index()
    {
        // 1. Ambil data barang beserta riwayat mutasi keluar
        $barang = LogistikTambang::with(['transaksi' => function($q) {
            $q->where('jenis_transaksi', 'Keluar');
        }])->get();

        $dataset = [];
        foreach ($barang as $item) {
            $total_keluar = $item->transaksi->sum('kuantitas');
            $frekuensi = $item->transaksi->count();

            $dataset[] = [
                'id' => $item->id,
                'kode_barang' => $item->kode_barang,
                'nama_barang' => $item->nama_barang,
                'x' => $total_keluar, // Fitur 1: Total Kuantitas Keluar
                'y' => $frekuensi,    // Fitur 2: Frekuensi Keluar
                'cluster' => null
            ];
        }

        // Proteksi jika data operasional pengeluaran belum mencukupi batas minimum K=3
        if (count($dataset) < 3) {
            return view('analitik.kmeans', ['dataset' => [], 'error' => 'Data transaksi keluar belum mencukupi untuk klasterisasi (Minimal diperlukan 3 data jenis barang aktif).']);
        }

        // 2. Inisialisasi Algoritma K-Means (K = 3)
        $k = 3;
        
        // Penentuan Centroid awal menggunakan data riil sebagai jangkar posisi awal
        $centroids = [
            ['x' => $dataset[0]['x'], 'y' => $dataset[0]['y']],
            ['x' => $dataset[1]['x'], 'y' => $dataset[1]['y']],
            ['x' => $dataset[2]['x'], 'y' => $dataset[2]['y']],
        ];

        $maxIterations = 100;
        $isChanged = true;
        $iteration = 0;

        // Perulangan pencarian titik pusat optimal (Centroid Convergence)
        while ($isChanged && $iteration < $maxIterations) {
            $isChanged = false;
            $iteration++;

            // Tahap A: Hitung Euclidean Distance ke setiap centroid
            foreach ($dataset as $idx => $data) {
                $minDistance = INF;
                $closestCluster = 0;

                for ($i = 0; $i < $k; $i++) {
                    $distance = sqrt(pow($data['x'] - $centroids[$i]['x'], 2) + pow($data['y'] - $centroids[$i]['y'], 2));
                    if ($distance < $minDistance) {
                        $minDistance = $distance;
                        $closestCluster = $i;
                    }
                }

                if ($dataset[$idx]['cluster'] !== $closestCluster) {
                    $dataset[$idx]['cluster'] = $closestCluster;
                    $isChanged = true;
                }
            }

            // Tahap B: Hitung ulang rata-rata posisi Centroid baru
            $newCentroids = array_fill(0, $k, ['x' => 0, 'y' => 0, 'count' => 0]);
            foreach ($dataset as $data) {
                $c = $data['cluster'];
                $newCentroids[$c]['x'] += $data['x'];
                $newCentroids[$c]['y'] += $data['y'];
                $newCentroids[$c]['count']++;
            }

            for ($i = 0; $i < $k; $i++) {
                if ($newCentroids[$i]['count'] > 0) {
                    $centroids[$i]['x'] = $newCentroids[$i]['x'] / $newCentroids[$i]['count'];
                    $centroids[$i]['y'] = $newCentroids[$i]['y'] / $newCentroids[$i]['count'];
                }
            }
        }

        // 3. Pemetaan otomatis nama label klaster berdasarkan bobot akumulasi nilai X (Volume Keluar)
        $sortCentroids = [];
        foreach ($centroids as $index => $c) {
            $sortCentroids[$index] = $c['x'];
        }
        asort($sortCentroids); 
        
        $mapping = [];
        $labels = ['Slow Moving', 'Medium Moving', 'Fast Moving'];
        $lIdx = 0;
        foreach ($sortCentroids as $origIndex => $val) {
            $mapping[$origIndex] = $labels[$lIdx];
            $lIdx++;
        }

        foreach ($dataset as $idx => $data) {
            $dataset[$idx]['label_cluster'] = $mapping[$data['cluster']];
        }

        return view('analitik.kmeans', compact('dataset', 'iteration', 'centroids'));
    }
}
