<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Barang | Si Bungas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glass-input {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        .glass-input:focus {
            outline: none;
            border-color: #22D3EE;
            background: rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 10px rgba(34, 211, 238, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen text-white font-sans flex items-center justify-center p-4">
    
    <div class="glass w-full max-w-3xl p-8 md:p-10 relative">
        <a href="{{ route('logistik.index') }}" class="absolute top-6 left-6 text-slate-400 hover:text-white transition flex items-center gap-2">
            <span>&larr;</span> Kembali
        </a>
        
        <div class="text-center mb-10 mt-6">
            <h2 class="text-3xl font-extrabold text-cyan-400 tracking-tight">Registrasi Logistik</h2>
            <p class="text-slate-400 mt-1">Sistem Operasional Si Bungas</p>
        </div>

        <form action="{{ route('logistik.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-2 text-slate-300">Kode Barang</label>
                    <input type="text" name="kode_barang" class="w-full p-3.5 rounded-xl glass-input" placeholder="Contoh: ELK-001" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2 text-slate-300">Nama Barang / Sparepart</label>
                    <input type="text" name="nama_barang" class="w-full p-3.5 rounded-xl glass-input" placeholder="Contoh: Alternator 24V HD785" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2 text-slate-300">Kategori</label>
                    <select name="kategori" class="w-full p-3.5 rounded-xl glass-input [&>option]:text-slate-900" required>
                        <option value="Kelistrikan">Kelistrikan</option>
                        <option value="Hidrolik">Hidrolik</option>
                        <option value="Consumable">Consumable (Filter, Hose, dll)</option>
                        <option value="BBM">Bahan Bakar Minyak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2 text-slate-300">Harga Satuan (Rp)</label>
                    <input type="number" name="harga_beli" class="w-full p-3.5 rounded-xl glass-input" placeholder="0" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2 text-slate-300">Stok Awal (Aktual)</label>
                    <input type="number" name="stok_aktual" class="w-full p-3.5 rounded-xl glass-input" placeholder="0" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2 text-slate-300">Batas Stok Kritis (Minimum)</label>
                    <input type="number" name="stok_minimum" class="w-full p-3.5 rounded-xl glass-input" placeholder="0" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-400 text-slate-900 font-extrabold py-4 px-6 rounded-xl transition mt-8 shadow-[0_0_20px_rgba(34,211,238,0.4)] text-lg">
                Simpan ke Database
            </button>
        </form>
    </div>

</body>
</html>