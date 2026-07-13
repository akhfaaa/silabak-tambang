<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Si Bungas | PPA Logistics')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { height: 8px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        div:where(.swal2-container) { font-family: 'Inter', sans-serif !important; }
        .animate-slide-up { animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; transform: translateY(20px); }
        @keyframes slideUp { to { opacity: 1; transform: translateY(0); } }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-slate-900 text-white flex flex-col transition-all duration-300 shadow-xl z-20 flex-shrink-0">
        <div class="h-16 flex items-center px-6 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-red-600 rounded-lg flex items-center justify-center font-extrabold text-white tracking-tighter shadow-lg shadow-red-600/20">PPA</div>
                <span class="font-bold text-lg tracking-wide text-white">Si Bungas</span>
            </div>
        </div>
        
        <div class="px-5 py-6">
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-4 px-2">Modul Operasional</p>
            <nav class="space-y-1.5">
                <a href="{{ route('logistik.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-all {{ request()->routeIs('logistik.*') ? 'bg-red-600 text-white shadow-md shadow-red-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white group' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('logistik.*') ? 'opacity-90' : 'opacity-70 group-hover:opacity-100 transition-opacity' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Master Inventori
                </a>
                
                <a href="{{ route('transaksi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-all {{ request()->routeIs('transaksi.*') ? 'bg-red-600 text-white shadow-md shadow-red-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white group' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('transaksi.*') ? 'opacity-90' : 'opacity-70 group-hover:opacity-100 transition-opacity' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    Mutasi Stok
                </a>

                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest mt-6 mb-4 px-2">Modul Analitik</p>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg font-medium transition-all group">
                    <svg class="w-5 h-5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Analisis K-Means
                </a>
            </nav>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50/50">
        
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 flex-shrink-0 z-10">
            <div class="flex items-center text-sm font-medium text-slate-500">
                <span class="text-slate-400">Si Bungas</span>
                <svg class="w-4 h-4 mx-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                @yield('breadcrumb')
            </div>

            <div class="flex items-center gap-4 cursor-pointer hover:bg-slate-50 p-1.5 rounded-lg transition-colors">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-slate-700 leading-tight">Akhmad Daffa</p>
                    <p class="text-xs text-slate-500 font-medium">Administrator</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-white font-bold border-2 border-slate-200 shadow-sm">AD</div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>