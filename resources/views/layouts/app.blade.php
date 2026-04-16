<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Académico Pro</title>

    @vite(['resources/css/app.css'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            scroll-behavior: smooth;
        }
        .page-transition {
            animation: fadeIn 0.4s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .progress-bar {
            animation: shrink 5s linear forwards;
        }

        @keyframes shrink {
            from { width: 100%; }
            to { width: 0%; }
        }
        .glass-nav {
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>

<body class="bg-[#fcfcfd] antialiased text-slate-900">

<nav class="glass-nav sticky top-0 z-50 border-b border-black shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        
        <div class="flex items-center gap-3 group">
            <div class="bg-gradient-to-tr from-gray-600 to-black p-2.5 rounded-2xl group-hover:rotate-6 transition-transform duration-300">
                <i class="fas fa-graduation-cap text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-xl font-extrabold text-white tracking-tight leading-tight">GESTOR</h1>
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Panel Administrativo</span>
            </div>
        </div>

        <div class="flex items-center gap-2 bg-white/5 p-1.5 rounded-2xl border border-white/10">
            <a href="{{ route('students.index') }}"
               class="{{ request()->routeIs('students.*') ? 'bg-white text-black' : 'text-slate-400 hover:text-white hover:bg-white/5' }} px-5 py-2 rounded-xl text-sm font-bold flex items-center gap-2 transition-all duration-300">
                <i class="fas fa-user-graduate text-xs"></i> Estudiantes
            </a>
            <a href="{{ route('careers.index') }}"
               class="{{ request()->routeIs('careers.*') ? 'bg-white text-black' : 'text-slate-400 hover:text-white hover:bg-white/5' }} px-5 py-2 rounded-xl text-sm font-bold flex items-center gap-2 transition-all duration-300">
                <i class="fas fa-book text-xs"></i> Carreras
            </a>
        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 page-transition">
    @yield('content')
</main>

@if (session('success'))
<div id="notification" class="fixed bottom-8 right-8 z-[100] animate-slide-in">
    <div class="bg-slate-900 text-white pl-6 pr-5 py-5 rounded-[24px] flex items-center gap-5 shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] border border-white/10 relative overflow-hidden group">
        
        <div class="relative flex items-center justify-center">
            <i class="fas fa-check-circle text-emerald-400 text-2xl z-10"></i>
            <span class="absolute inset-0 rounded-full bg-emerald-400/20 animate-ping"></span>
        </div>

        <div class="flex flex-col">
            <p class="text-[13px] font-extrabold tracking-wide">¡Completado!</p>
            <p class="text-slate-400 text-xs font-medium">{{ session('success') }}</p>
        </div>

        <button onclick="dismissNotification()" class="ml-4 w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-white/10 transition-all hover:scale-105 active:scale-95 text-slate-300 hover:text-white">
            <i class="fas fa-times text-xs"></i>
        </button>

        <div class="absolute bottom-0 left-0 h-[3px] bg-gradient-to-r from-emerald-500 to-teal-400 progress-bar"></div>
    </div>
</div>

<script>
    function dismissNotification() {
        const el = document.getElementById('notification');
        if (el) {
            el.style.transform = 'translateX(120%) scale(0.9)';
            el.style.opacity = '0';
            el.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            setTimeout(() => el.remove(), 500);
        }
    }

    setTimeout(dismissNotification, 5000);
</script>

<style>
    @keyframes slideIn {
        from { transform: translateX(100px) scale(0.95); opacity: 0; }
        to { transform: translateX(0) scale(1); opacity: 1; }
    }
    .animate-slide-in { 
        animation: slideIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; 
    }
</style>
@endif

</body>
</html>