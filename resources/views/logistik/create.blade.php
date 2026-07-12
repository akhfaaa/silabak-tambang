<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Barang Baru | PPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen py-10 px-4 flex justify-center">
    
    <div class="w-full max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('logistik.index') }}" class="text-sm font-medium text-slate-500 hover:text-red-600 transition-colors inline-flex items-center mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Master Data
            </a>
            <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Formulir Registrasi Logistik</h2>
            <p class="text-slate-500 mt-1">Masukkan rincian spesifikasi barang (Sparepart, Consumable, atau BBM).</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm">
            <div class="p-6 md:p-8 border-b border-slate-100">
                <h3 class="text-lg font-semibold text-slate-800">Informasi Dasar Barang</h3>
            </div>
            
            <form action="{{ route('logistik.store') }}" method="POST" class="p-6 md:p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Part Number (Kode Barang) <span class="text-red-500">*</span></label>
                        <input type="text" name="kode_barang" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all text-sm" placeholder="Contoh: PPA-HD-001" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_barang" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all text-sm" placeholder="Contoh: Filter Udara Komatsu HD785" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all text-sm bg-white" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <option value="Kelistrikan">Kelistrikan</option>
                            <option value="Hidrolik">Hidrolik</option>
                            <option value="Consumable">Consumable (Filter, Hose, dll)</option>
                            <option value="BBM">Bahan Bakar Minyak</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Estimasi Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="harga_beli" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all text-sm" placeholder="0" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Stock On Hand (Stok Aktual) <span class="text-red-500">*</span></label>
                        <input type="number" name="stok_aktual" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all text-sm" placeholder="0" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Batas Kritis (Min. Stok) <span class="text-red-500">*</span></label>
                        <input type="number" name="stok_minimum" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all text-sm" placeholder="0" required>
                        <p class="text-xs text-slate-500 mt-2">Sistem akan memberi peringatan jika stok aktual menyentuh angka ini.</p>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-slate-100 flex justify-end gap-3">
                    <a href="{{ route('logistik.index') }}" class="px-6 py-2.5 rounded-lg font-medium text-slate-600 hover:bg-slate-100 transition-colors text-sm border border-transparent">Batal</a>
                    <button type="submit" class="px-6 py-2.5 rounded-lg font-semibold text-white bg-red-600 hover:bg-red-700 shadow-sm transition-colors text-sm">
                        Simpan Data Logistik
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>