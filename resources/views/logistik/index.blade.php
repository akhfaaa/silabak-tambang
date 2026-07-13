<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Operasional Logistik | PPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { height: 8px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Kustomisasi font SweetAlert agar senada dengan Tailwind Inter */
        div:where(.swal2-container) { font-family: 'Inter', sans-serif !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-slate-900 text-white flex flex-col transition-all duration-300 shadow-xl z-20 flex-shrink-0">
        <div class="h-16 flex items-center px-6 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-red-600 rounded-lg flex items-center justify-center font-extrabold text-white tracking-tighter shadow-lg shadow-red-600/20">
                    PPA
                </div>
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
                    <svg class="w-5 h-5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Analitik K-Means
                </a>
            </nav>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50/50">
        
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 flex-shrink-0 z-10">
            <div class="flex items-center text-sm font-medium text-slate-500">
                <span class="text-slate-400">Modul Utama</span>
                <svg class="w-4 h-4 mx-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-slate-800 font-semibold">Master Inventori</span>
            </div>

            <div class="flex items-center gap-4 cursor-pointer hover:bg-slate-50 p-1.5 rounded-lg transition-colors">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-slate-700 leading-tight">Akhmad Daffa</p>
                    <p class="text-xs text-slate-500 font-medium">Site Manager</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-white font-bold border-2 border-slate-200 shadow-sm">
                    AD
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Master Data Logistik</h2>
                    <p class="text-sm text-slate-500 mt-1.5">Kelola data persediaan barang operasional secara aktual.</p>
                </div>
                <a href="{{ route('logistik.create') }}" class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2.5 px-5 rounded-lg shadow-md shadow-red-600/20 transition-all transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Registrasi Barang Baru
                </a>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm flex flex-col">
                
                <div class="p-4 border-b border-slate-100 bg-white flex flex-col md:flex-row md:items-center justify-between gap-4 rounded-t-xl">
                    <form id="searchForm" action="{{ route('logistik.index') }}" method="GET" class="w-full md:w-[400px]">
                        <div class="relative flex items-center group">
                            <div id="searchLoading" class="absolute left-3.5 hidden">
                                <svg class="animate-spin h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            </div>
                            <svg id="searchIcon" class="w-5 h-5 text-slate-400 absolute left-3.5 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            
                            <input type="text" id="searchInput" name="search" value="{{ request('search') }}" placeholder="Ketik Part Number atau Deskripsi..." class="w-full pl-11 pr-10 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all shadow-sm text-slate-700 placeholder-slate-400" autocomplete="off">
                            
                            <button type="button" id="clearSearch" class="absolute right-3.5 text-slate-400 hover:text-red-600 transition-colors {{ request('search') ? '' : 'hidden' }}" title="Hapus Pencarian">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </form>

                    <div class="flex items-center gap-2">
                        <button class="inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-200 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                            <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            Filter Kategori
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto custom-scrollbar relative">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Part Number</th>
                                <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Deskripsi Barang</th>
                                <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                                <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-right">Stok Aktual (SOH)</th>
                                <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-center">Status</th>
                                <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="divide-y divide-slate-100 transition-opacity duration-300">
                            @forelse($data_logistik as $barang)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="py-4 px-6 text-sm font-mono font-medium text-slate-600">{{ $barang->kode_barang }}</td>
                                <td class="py-4 px-6 text-sm font-semibold text-slate-900">{{ $barang->nama_barang }}</td>
                                <td class="py-4 px-6 text-sm">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                        {{ $barang->kategori }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-sm font-bold text-right {{ $barang->stok_aktual <= $barang->stok_minimum ? 'text-red-600' : 'text-slate-700' }}">
                                    {{ number_format($barang->stok_aktual, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6 text-sm text-center">
                                    @if($barang->stok_aktual <= $barang->stok_minimum)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 ring-1 ring-inset ring-red-600/20">Kritis</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Aman</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-sm text-center">
                                    <div class="flex items-center justify-center gap-2 opacity-100 md:opacity-50 group-hover:opacity-100 transition-opacity">
                                        
                                        <a href="{{ route('logistik.edit', $barang->id) }}" title="Edit Data" class="p-1.5 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <form id="delete-form-{{ $barang->id }}" action="{{ route('logistik.destroy', $barang->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="konfirmasiHapus('{{ $barang->id }}', '{{ $barang->kode_barang }}', '{{ addslashes($barang->nama_barang) }}')" title="Hapus Data" class="p-1.5 text-red-600 bg-red-50 hover:bg-red-100 rounded-md transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                        
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-700">
                                            {{ request('search') ? 'Data Tidak Ditemukan' : 'Tidak Ada Data Inventori' }}
                                        </h3>
                                        <p class="mt-1 text-sm text-slate-500 max-w-sm">
                                            {{ request('search') ? 'Tidak ada part number atau deskripsi yang cocok dengan kata kunci "'.request('search').'".' : 'Data logistik belum ditambahkan. Klik tombol "Registrasi Barang Baru" di atas untuk mulai mencatat stok operasional.' }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div id="dataCountWrapper">
                    @if(count($data_logistik) > 0)
                    <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50 flex items-center justify-between">
                        <p class="text-xs font-medium text-slate-500">Menampilkan <span class="font-bold text-slate-700">{{ count($data_logistik) }}</span> data registrasi logistik.</p>
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script>
        // FUNGSI KONFIRMASI HAPUS SWEETALERT2
        function konfirmasiHapus(id, partNumber, namaBarang) {
            Swal.fire({
                title: 'Hapus Data Inventori?',
                // Menampilkan nama barang secara dinamis dan spesifik ke dalam pesan dialog
                html: `Apakah Anda yakin ingin menghapus data <b>${partNumber}</b> - <span class="text-slate-600">${namaBarang}</span> secara permanen?<br><br><span class="text-xs text-red-500">Tindakan ini tidak dapat dibatalkan!</span>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626', // Warna merah khas PPA / Tailwind red-600
                cancelButtonColor: '#64748b', // Warna abu-abu Tailwind slate-500
                confirmButtonText: '<svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Ya, Hapus Data',
                cancelButtonText: 'Batal',
                reverseButtons: true, // Memindah tombol hapus ke sebelah kanan (standar UX modern)
                customClass: {
                    popup: 'rounded-xl shadow-2xl',
                    confirmButton: 'rounded-lg font-semibold px-4 py-2.5',
                    cancelButton: 'rounded-lg font-medium px-4 py-2.5'
                }
            }).then((result) => {
                // Jika pengguna mengklik "Ya, Hapus Data"
                if (result.isConfirmed) {
                    // Cari form berdasarkan ID barang lalu kirim secara otomatis
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // FUNGSI AJAX SEARCH
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchForm = document.getElementById('searchForm');
            const tableBody = document.getElementById('tableBody');
            const dataCountWrapper = document.getElementById('dataCountWrapper');
            const clearBtn = document.getElementById('clearSearch');
            const searchIcon = document.getElementById('searchIcon');
            const searchLoading = document.getElementById('searchLoading');
            let typingTimer;
            const doneTypingInterval = 300; 

            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                performAjaxSearch(searchInput.value);
            });

            searchInput.addEventListener('input', function() {
                clearTimeout(typingTimer);
                
                if (this.value.trim().length > 0) {
                    clearBtn.classList.remove('hidden');
                } else {
                    clearBtn.classList.add('hidden');
                }

                typingTimer = setTimeout(() => {
                    performAjaxSearch(this.value);
                }, doneTypingInterval);
            });

            clearBtn.addEventListener('click', function() {
                searchInput.value = '';
                clearBtn.classList.add('hidden');
                performAjaxSearch('');
                searchInput.focus();
            });

            function performAjaxSearch(query) {
                tableBody.style.opacity = '0.3';
                searchIcon.classList.add('hidden');
                searchLoading.classList.remove('hidden');

                fetch(`{{ route('logistik.index') }}?search=${encodeURIComponent(query)}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    tableBody.innerHTML = doc.getElementById('tableBody').innerHTML;
                    dataCountWrapper.innerHTML = doc.getElementById('dataCountWrapper').innerHTML;
                    
                    tableBody.style.opacity = '1';
                    searchLoading.classList.add('hidden');
                    searchIcon.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Terjadi kesalahan AJAX:', error);
                    tableBody.style.opacity = '1';
                    searchLoading.classList.add('hidden');
                    searchIcon.classList.remove('hidden');
                });
            }
        });
    </script>
</body>
</html>