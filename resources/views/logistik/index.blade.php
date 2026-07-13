@extends('layouts.app')

@section('title', 'Master Inventori | Si Bungas')

@section('breadcrumb')
    <span class="text-slate-800 font-semibold">Master Inventori</span>
@endsection

@section('content')
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

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm flex flex-col animate-slide-up">
        
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
                                    {{ request('search') ? 'Tidak ada part number atau deskripsi yang cocok dengan kata kunci "'.request('search').'".' : 'Data logistik belum ditambahkan.' }}
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
@endsection

@push('scripts')
<script>
    // FUNGSI KONFIRMASI HAPUS SWEETALERT2
    function konfirmasiHapus(id, partNumber, namaBarang) {
        Swal.fire({
            title: 'Hapus Data Inventori?',
            html: `Apakah Anda yakin ingin menghapus data <b>${partNumber}</b> - <span class="text-slate-600">${namaBarang}</span> secara permanen?<br><br><span class="text-xs text-red-500">Tindakan ini tidak dapat dibatalkan!</span>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Ya, Hapus Data',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-xl shadow-2xl',
                confirmButton: 'rounded-lg font-semibold px-4 py-2.5',
                cancelButton: 'rounded-lg font-medium px-4 py-2.5'
            }
        }).then((result) => {
            if (result.isConfirmed) {
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
@endpush