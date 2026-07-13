<?php

namespace Database\Seeders;

use App\Models\LogistikTambang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $data = [
            ['kode_barang' => 'PPA-HD-002', 'nama_barang' => 'Alternator 24V 50A Komatsu HD785', 'kategori' => 'Kelistrikan', 'harga_beli' => 8500000, 'stok_aktual' => 5, 'stok_minimum' => 10],
            ['kode_barang' => 'PPA-HD-003', 'nama_barang' => 'O-Ring Kit Hydraulic Cylinder', 'kategori' => 'Hidrolik', 'harga_beli' => 1250000, 'stok_aktual' => 45, 'stok_minimum' => 20],
            ['kode_barang' => 'PPA-HD-004', 'nama_barang' => 'Filter Oli Mesin CAT 777D', 'kategori' => 'Consumable', 'harga_beli' => 450000, 'stok_aktual' => 120, 'stok_minimum' => 50],
            ['kode_barang' => 'PPA-HD-005', 'nama_barang' => 'Hose Hydraulic 1/2 Inch High Pressure', 'kategori' => 'Hidrolik', 'harga_beli' => 850000, 'stok_aktual' => 15, 'stok_minimum' => 25],
            ['kode_barang' => 'PPA-HD-006', 'nama_barang' => 'Lampu Sorot LED Worklight 48W', 'kategori' => 'Kelistrikan', 'harga_beli' => 250000, 'stok_aktual' => 60, 'stok_minimum' => 30],
            ['kode_barang' => 'PPA-HD-007', 'nama_barang' => 'Solar Industri (HSD) - Liter', 'kategori' => 'BBM', 'harga_beli' => 11500, 'stok_aktual' => 15000, 'stok_minimum' => 5000],
            ['kode_barang' => 'PPA-HD-008', 'nama_barang' => 'V-Belt Cooling Fan Komatsu', 'kategori' => 'Consumable', 'harga_beli' => 750000, 'stok_aktual' => 8, 'stok_minimum' => 15],
            ['kode_barang' => 'PPA-HD-009', 'nama_barang' => 'Motor Starter Assy 24V', 'kategori' => 'Kelistrikan', 'harga_beli' => 12000000, 'stok_aktual' => 12, 'stok_minimum' => 5],
            ['kode_barang' => 'PPA-HD-010', 'nama_barang' => 'Main Relief Valve Hydraulic', 'kategori' => 'Hidrolik', 'harga_beli' => 4500000, 'stok_aktual' => 25, 'stok_minimum' => 10],
        ];

        foreach ($data as $item) {
            LogistikTambang::create($item);
        }
    }
}
