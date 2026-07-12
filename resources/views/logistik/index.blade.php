<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Operasional Logistik | PPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-slate-900 text-white flex flex-col transition-all duration-300">
        <div class="h-16 flex items-center px-6 border-b border-slate-800">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-red-600 rounded flex items-center justify-center font-bold text-white tracking-tighter">
                    PPA
                </div>
                <span class="font-bold text-lg tracking-wide text-white">Logistics</span>
            </div>
        </div>
        
        <div class="px-6 py-4">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4">Modul Utama</p>
            <nav class="space-y-2">
                <a href="{{ route('logistik.index') }}" class="flex items-center gap-3 px-3 py-2.5 bg-red-600/10 text-red-500 rounded-lg font-medium border border-red-600/20 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Master Inventori
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg font-medium transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Analitik K-Means
                </a>
            </nav>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 flex-shrink-0 z-10">
            <h1 class="text-xl font-semibold text-slate-800">Manajemen Sparepart & Consumable</h1>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-slate-500">Site Manager (Preview)</span>
                <div class="w-9 h-9 rounded-full bg-slate-200 border border-slate-300"></div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Master Data Logistik</h2>
                    <p class="text-sm text-slate-500 mt-1">Kelola data persediaan barang secara aktual.</p>
                </div>
                <a href="{{ route('logistik.create') }}" class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2.5 px-5 rounded-lg shadow-sm shadow-red-600/30 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Registrasi Barang Baru
                </a>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Part Number</th>
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Deskripsi Barang</th>
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Stok Aktual (SOH)</th>
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Status</th>
                                <th class="py-3 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($data_logistik as $barang)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6 text-sm font-mono text-slate-600">{{ $barang->kode_barang }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-slate-900">{{ $barang->nama_barang }}</td>
                                <td class="py-4 px-6 text-sm">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                        {{ $barang->kategori }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-sm font-semibold text-right {{ $barang->stok_aktual <=$barang->stok_minimum ? 'text-red-600' : 'text-slate-700' }}">
                                    {{ number_format($barang->stok_aktual, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6 text-sm text-center">
                                    @if($barang->stok_aktual <= $barang->stok_minimum)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Kritis</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Aman</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-sm text-center">
                                    <button class="text-blue-600 hover:text-blue-800 font-medium transition-colors text-sm">Detail</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <p class="mt-4 text-sm font-medium text-slate-500">Belum ada data inventori terdaftar.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>