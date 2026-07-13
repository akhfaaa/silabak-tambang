@extends('layouts.app')

@section('title', 'Dashboard Utama | Si Bungas')

@section('breadcrumb')
    <span class="text-slate-800 font-semibold">Ringkasan Eksekutif</span>
@endsection

@section('content')
<div class="space-y-8 animate-slide-up">
    <div class="bg-gradient-to-r from-slate-900 via-slate-850 to-red-950 p-6 rounded-2xl border border-slate-800 shadow-md flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-white tracking-tight">Selamat Datang di Portal Kendali Si Bungas</h2>
            <p class="text-slate-400 text-xs mt-1">Pantau seluruh indikator volume mutasi logistik pertambangan dan hasil segmentasi analitis secara waktu nyata.</p>
        </div>
        <div class="hidden sm:block text-right">
            <span class="text-xs font-semibold px-3 py-1 bg-red-600/20 text-red-400 rounded-full border border-red-600/30">Site Operational Mode</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-white p-6 border border-slate-200 rounded-xl shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Item Suku Cadang</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $totalBarang }} <span class="text-xs text-slate-500 font-normal">Tersambung</span></h3>
            </div>
            <div class="w-12 h-12 bg-slate-50 rounded-lg flex items-center justify-center text-slate-500 border border-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </div>
        <div class="bg-white p-6 border border-slate-200 rounded-xl shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Peringatan Batas Kritis</p>
                <h3 class="text-3xl font-bold mt-2 {{ $stokKritis > 0 ? 'text-red-600' : 'text-slate-800' }}">{{ $stokKritis }} <span class="text-xs text-slate-500 font-normal">Barang</span></h3>
            </div>
            <div class="w-12 h-12 rounded-lg flex items-center justify-center border {{ $stokKritis > 0 ? 'bg-red-50 text-red-600 border-red-100 animate-pulse' : 'bg-slate-50 text-slate-500 border-slate-100' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-6 border border-slate-200 rounded-xl shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Aktivitas Transaksi Hari Ini</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $transaksiHariIni }} <span class="text-xs text-slate-500 font-normal">Mutasi</span></h3>
            </div>
            <div class="w-12 h-12 bg-slate-50 rounded-lg flex items-center justify-center text-slate-500 border border-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 flex flex-col">
            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wide mb-4">Proporsi Hasil K-Means</h4>
            <div class="space-y-4 my-auto">
                <div>
                    <div class="flex justify-between text-xs font-semibold text-slate-600 mb-1">
                        <span>🚀 Fast Moving (Permintaan Tinggi)</span>
                        <span>{{ $fastMovingCount }} Item</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-red-600 h-2 rounded-full" style="width: calc(var(--fast-moving-percent, 0) * 1%); --fast-moving-percent: {{ $totalBarang > 0 ? ($fastMovingCount / $totalBarang) * 100 : 0 }}"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-semibold text-slate-600 mb-1">
                        <span>📦 Medium Moving (Pergerakan Sedang)</span>
                        <span>{{ $mediumMovingCount }} Item</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: calc(var(--medium-moving-percent, 0) * 1%); --medium-moving-percent: {{ $totalBarang > 0 ? ($mediumMovingCount / $totalBarang) * 100 : 0 }}"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-semibold text-slate-600 mb-1">
                        <span>⏳ Slow Moving (Pergerakan Lambat)</span>
                        <span>{{ $slowMovingCount }} Item</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-slate-400 h-2 rounded-full" style="width: calc(var(--slow-moving-percent, 0) * 1%); --slow-moving-percent: {{ $totalBarang > 0 ? ($slowMovingCount / $totalBarang) * 100 : 0 }}"></div>
                    </div>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-slate-100">
                <a href="{{ route('kmeans.index') }}" class="text-xs font-bold text-red-600 hover:text-red-700 transition-colors flex items-center justify-center gap-1">
                    Buka Detail Analitik Matriks &rarr;
                </a>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 lg:col-span-2 flex flex-col">
            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wide mb-4">Pengawasan SOH Batas Kritis Terendah</h4>
            <div class="overflow-x-auto flex-1 custom-scrollbar">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="border-b border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                            <th class="pb-2">Part Number</th>
                            <th class="pb-2">Deskripsi Suku Cadang</th>
                            <th class="pb-2 text-right">Stok SOH</th>
                            <th class="pb-2 text-right">Batas Min</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($barangKritis as $kritis)
                        <tr class="text-xs font-medium text-slate-700">
                            <td class="py-3 font-mono font-bold text-slate-600">{{ $kritis->kode_barang }}</td>
                            <td class="py-3 font-semibold text-slate-900">{{ $kritis->nama_barang }}</td>
                            <td class="py-3 text-right text-red-600 font-bold">{{ $kritis->stok_aktual }}</td>
                            <td class="py-3 text-right text-slate-400">{{ $kritis->stok_minimum }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-xs font-bold text-emerald-600 bg-emerald-50/50 rounded-lg border border-emerald-100 mt-2">
                                ✅ Seluruh persediaan stock on hand (SOH) berada pada kondisi aman.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection