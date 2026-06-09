<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Khurshid Alam - Full Stack AI Developer Portfolio">
    <meta name="author" content="Khurshid Alam">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $profile->full_name ?? 'Khurshid Alam' }} | {{ $profile->designation ?? 'Full Stack AI Developer' }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'scan': 'scan 3.5s linear infinite',
                    },
                    keyframes: {
                        scan: {
                            '0%': { transform: 'translateY(-100%)' },
                            '100%': { transform: 'translateY(100%)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes scan {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(100%); }
        }
        .animate-scan {
            animation: scan 3.5s linear infinite;
        }
        html {
            scroll-behavior: smooth;
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 antialiased">

<div class="w-full min-h-screen bg-slate-900 text-slate-100 relative">

    {{-- Background Effects --}}
    <div class="fixed inset-0 z-0 bg-slate-900 pointer-events-none overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(to right, rgb(148, 163, 184) 1px, transparent 1px), linear-gradient(rgb(148, 163, 184) 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="absolute top-1/2 left-1/2 w-[60%] h-[60%] bg-cyan-500/10 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-transparent via-slate-900/40 to-slate-900 opacity-90"></div>
    </div>

    <main>
        @yield('content')
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                const target = document.querySelector(targetId);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Insight modal functionality
        const modal = document.getElementById('insightModal');
        const modalContent = document.getElementById('modalContent');
        const closeModal = document.getElementById('closeModal');

        if (modal && modalContent && closeModal) {
            document.querySelectorAll('.insight-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const insight = btn.getAttribute('data-insight');
                    modalContent.textContent = insight;
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });

            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        }

        // Terminal button
        const toggleTerminal = document.getElementById('toggleTerminal');
        if (toggleTerminal) {
            toggleTerminal.addEventListener('click', () => {
                alert('Terminal feature coming soon!');
            });
        }
    });
</script>

{{-- Insight Modal --}}
<div id="insightModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm">
    <div class="bg-slate-800 rounded-2xl border border-slate-700 max-w-md w-full mx-4 p-6 relative">
        <button id="closeModal" class="absolute top-4 right-4 text-slate-400 hover:text-slate-100">
            <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h3 class="text-xl font-bold text-slate-100 mb-2">Role Insight</h3>
        <p id="modalContent" class="text-slate-400 leading-relaxed"></p>
    </div>
</div>
</body>
</html>