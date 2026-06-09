@props(['profile'])

<section id="home" class="min-h-[90vh] w-full max-w-6xl mx-auto flex flex-col lg:flex-row items-center justify-center px-4 sm:px-6 lg:px-8 gap-12 lg:gap-16 relative z-10 pt-24 pb-20 scroll-mt-20">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none z-0 opacity-70">
        <span class="text-[18rem] md:text-[28rem] font-black text-white/5 select-none tracking-[-0.07em]">{{ strtoupper(substr($profile->full_name, 0, 2)) }}</span>
    </div>

    <div class="flex-1 text-left max-w-2xl space-y-4 relative z-10">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-sm font-bold uppercase tracking-widest">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
            </span>
            Available for work
        </div>

        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black leading-[0.9] tracking-tighter text-slate-100">
            <span class="block">{{ $profile->full_name }}</span>
            <span class="block text-slate-500 text-3xl sm:text-5xl lg:text-6xl">{{ $profile->designation }}</span>
        </h1>

        <p class="text-lg md:text-xl text-slate-400 leading-relaxed max-w-lg">{{ $profile->short_description }}</p>

        <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
            <div class="flex items-center gap-4 w-full sm:w-auto">
                <a href="#projects" class="flex-1 sm:flex-none px-6 py-3.5 rounded-full bg-white text-black font-black text-base hover:bg-zinc-100 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2 shadow-xl shadow-white/10">
                    Selected Works
                </a>
                <a href="#contact" class="flex-1 sm:flex-none px-6 py-3.5 rounded-full bg-cyan-600 hover:bg-cyan-700 text-white font-black text-base transition-all duration-300 flex items-center justify-center gap-2 shadow-xl shadow-cyan-500/20">
                    Get in Touch
                    <i class="fa-solid fa-paper-plane group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                </a>
            </div>

            <div class="flex items-center gap-6 sm:gap-5 pt-2 sm:pt-0">
                <div class="h-5 w-px bg-white/10 hidden sm:block"></div>
                <a href="{{ $profile->portfolio_github_folder_link ?? '#' }}" target="_blank" class="text-slate-500 hover:text-slate-100 transition-all hover:scale-110">
                    <i class="fa-brands fa-github text-2xl"></i>
                </a>
                <a href="{{ $profile->linked_link ?? '#' }}" target="_blank" class="text-slate-500 hover:text-slate-100 transition-all hover:scale-110">
                    <i class="fa-brands fa-linkedin text-2xl"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="relative flex-shrink-0">
        <div class="relative group">
            <div class="absolute -top-3 -left-3 w-10 h-10 border-t-2 border-l-2 border-cyan-500/60 z-20 transition-transform group-hover:rotate-12"></div>
            <div class="absolute -bottom-3 -right-3 w-10 h-10 border-b-2 border-r-2 border-cyan-500/60 z-20 transition-transform group-hover:-rotate-12"></div>
            <div class="relative w-[300px] md:w-[340px] lg:w-[380px] aspect-square rounded-3xl overflow-hidden border border-slate-700/50 shadow-2xl bg-slate-950">
                <img src="{{ asset('storage/' . $profile->avatar_url) }}" alt="{{ $profile->full_name }}" class="w-full h-full object-cover scale-105 group-hover:scale-100 grayscale group-hover:grayscale-0 transition-all duration-700" onerror="this.src='https://via.placeholder.com/400?text={{ urlencode($profile->full_name) }}'">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-cyan-500/5 to-slate-900/30 group-hover:via-transparent transition-all duration-700"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/10 to-transparent h-[3px] w-full -translate-y-full group-hover:animate-scan pointer-events-none"></div>
            </div>
        </div>
    </div>
</section>