<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Logistik | Si Bungas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Efek Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen text-white font-sans">
    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-72 glass m-4 p-6 hidden md:flex flex-col">
            <h2 class="text-3xl font-extrabold mb-2 tracking-wide text-cyan-400">Si Bungas</h2>
            <p class="text-xs text-slate-400 mb-8 uppercase tracking-widest">Site Operations</p>
            <nav class="flex-1 space-y-3">
                <a href="{{ route('logistik.index') }}" class="block p-3 rounded-xl bg-cyan-600 bg-opacity-40 border border-cyan-400 hover:bg-cyan-500 transition shadow-[0_0_15px_rgba(34,211,238,0.3)]">📦 Master Logistik</a>
                <a href="#" class="block p-3 rounded-xl hover:bg-white hover:bg-opacity-10 transition">📊 Analitik K-Means</a>
            </nav>
        </aside>

        <main class="flex-1 p-4 md:p-8 overflow-y-auto">
            <header class="mb-8">
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">APLIKASI LOGISTIK DAN ANALITIK BARANG K-MEANS</h1>
                <p class="text-slate-400 mt-2">Manajemen Sparepart & Consumable Pertambangan</p>
            </header>

            <div class="glass p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold">Daftar Barang Aktual</h3>
                    <a href="{{ route('logistik.create') }}" class="bg-cyan-500 hover:bg-cyan-400 text-slate-900 px-5 py-2.5 rounded-lg transition font-bold shadow-lg">
                        + Tambah Logistik Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-600 text-sm uppercase tracking-wider text-slate-300">
                                <th class="p-4 font-semibold">Kode</th>
                                <th class="p-4 font-semibold">Nama Barang</th>
                                <th class="p-4 font-semibold">Kategori</th>
                                <th class="p-4 font-semibold">Stok</th>
                                <th class="p-4 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data_logistik as $barang)
                            <tr class="border-b border-slate-700/50 hover:bg-white hover:bg-opacity-5 transition">
                                <td class="p-4 font-mono text-sm text-cyan-200">{{ $barang->kode_barang }}</td>
                                <td class="p-4">{{ $barang->nama_barang }}</td>
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-slate-700 border border-slate-600">
                                        {{ $barang->kategori }}
                                    </span>
                                </td>
                                <td class="p-4 font-bold text-lg">
                                    <span class="{{ $barang->stok_aktual <= $barang->stok_minimum ? 'text-red-400' : 'text-green-400' }}">
                                        {{ $barang->stok_aktual }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <button class="text-yellow-400 hover:text-yellow-300 text-sm font-medium transition">Edit</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400">Data logistik belum tersedia. Silakan tambahkan barang baru.</td>
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