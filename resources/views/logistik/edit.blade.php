<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang | PPA Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-slate-900 text-white flex flex-col transition-all duration-300 shadow-xl z-20 flex-shrink-0">
        <div class="h-16 flex items-center px-6 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-red-600 rounded-lg flex items-center justify-center font-extrabold text-white tracking-tighter shadow-lg shadow-red-600/20">PPA</div>
                <span class="font-bold text-lg tracking-wide text-white">Logistics</span>
            </div>
        </div>
        <div class="px-5 py-6">
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-4 px-2">Modul Utama</p>
            <nav class="space-y-1.5">
                <a href="{{ route('logistik.index') }}" class="flex items-center gap-3 px-3 py-2.5 bg-red-600 text-white rounded-lg font-medium shadow-md shadow-red-600/20 transition-all">
                    <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Master Inventori
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg font-medium transition-all group">
                    <svg class="w-5 h-5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012-2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Analitik K-Means
                </a>
            </nav>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50/50">
        
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 flex-shrink-0 z-10">
            <div class="flex items-center text-sm font-medium text-slate-500">
                <a href="{{ route('logistik.index') }}" class="text-slate-400 hover:text-blue-600 transition-colors">Master Inventori</a>
                <svg class="w-4 h-4 mx-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-slate-800 font-semibold">Edit Data</span>
            </div>
            <div class="flex items-center gap-4 cursor-pointer hover:bg-slate-50 p-1.5 rounded-lg transition-colors">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-slate-700 leading-tight">Akhmad Daffa</p>
                    <p class="text-xs text-slate-500 font-medium">Site Manager</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-white font-bold border-2 border-slate-200 shadow-sm">AD</div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-4xl mx-auto">
                <div class="mb-6">
                    <a href="{{ route('logistik.index') }}" class="text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors inline-flex items-center mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Tabel Data
                    </a>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Data Logistik</h2>
                    <p class="text-slate-500 mt-1.5 text-sm">Perbarui informasi part number <span class="font-bold text-slate-700">{{ $logistik->kode_barang }}</span>.</p>
                </div>

                <div class="bg-white border border-slate-200 rounded-xl shadow-sm">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 rounded-t-xl flex justify-between items-center">
                        <h3 class="text-sm font-bold text-slate-800">Ubah Rincian Barang</h3>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full ring-1 ring-blue-600/20">Mode Edit Aktif</span>
                    </div>
                    
                    <form action="{{ route('logistik.update', $logistik->id) }}" method="POST" class="p-6 md:p-8">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Part Number</label>
                                <input type="text" name="kode_barang" value="{{ $logistik->kode_barang }}" class="w-full px-4 py-2.5 bg-slate-50 rounded-lg border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm" required>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Deskripsi Lengkap</label>
                                <input type="text" name="nama_barang" value="{{ $logistik->nama_barang }}" class="w-full px-4 py-2.5 bg-slate-50 rounded-lg border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Kategori</label>
                                <select name="kategori" class="w-full px-4 py-2.5 bg-slate-50 rounded-lg border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm" required>
                                    <option value="Kelistrikan" {{ $logistik->kategori == 'Kelistrikan' ? 'selected' : '' }}>Kelistrikan</option>
                                    <option value="Hidrolik" {{ $logistik->kategori == 'Hidrolik' ? 'selected' : '' }}>Hidrolik</option>
                                    <option value="Consumable" {{ $logistik->kategori == 'Consumable' ? 'selected' : '' }}>Consumable (Filter, Hose, dll)</option>
                                    <option value="BBM" {{ $logistik->kategori == 'BBM' ? 'selected' : '' }}>Bahan Bakar Minyak</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Estimasi Harga (Rp)</label>
                                <input type="number" name="harga_beli" value="{{ $logistik->harga_beli }}" class="w-full px-4 py-2.5 bg-slate-50 rounded-lg border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Stock On Hand (Aktual)</label>
                                <input type="number" name="stok_aktual" value="{{ $logistik->stok_aktual }}" class="w-full px-4 py-2.5 bg-slate-50 rounded-lg border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Batas Kritis (Minimum)</label>
                                <input type="number" name="stok_minimum" value="{{ $logistik->stok_minimum }}" class="w-full px-4 py-2.5 bg-slate-50 rounded-lg border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm" required>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-3">
                            <a href="{{ route('logistik.index') }}" class="px-6 py-2.5 rounded-lg font-semibold text-slate-600 hover:bg-slate-100 transition-colors text-sm border border-transparent">Batal</a>
                            <button type="submit" class="px-6 py-2.5 rounded-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-600/20 transition-all text-sm transform hover:-translate-y-0.5">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>