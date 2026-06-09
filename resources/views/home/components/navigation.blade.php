<nav class="fixed top-0 left-0 w-full z-50 transition-all duration-500 py-3">
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-6">
        <div class="relative flex items-center justify-between px-2 sm:px-4 py-3 rounded-2xl border bg-slate-900/90 backdrop-blur-xl border-slate-700/50 shadow-2xl">
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <div class="p-2 rounded-xl border border-slate-700/50 bg-slate-800/50 group-hover:border-cyan-500/50 transition-all">
                    <i class="fa-solid fa-code text-cyan-500 text-xl"></i>
                </div>
                <div class="relative">
                    <span class="font-black text-2xl tracking-tighter uppercase text-slate-100 flex items-baseline">
                        Khurshid<span class="text-[17px] ml-0.5 transition-colors text-slate-500 group-hover:text-cyan-500">Alam</span>
                    </span>
                    <div class="absolute -bottom-0.5 left-0 h-1 rounded-full transition-all duration-300 w-0 group-hover:w-full bg-cyan-500"></div>
                </div>
            </a>
            <div class="flex items-center gap-2">
                <a href="https://github.com/jony741/khurshid.portfolio" target="_blank" class="flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-700/50 bg-slate-800/50 hover:bg-slate-700/50 transition-all group">
                    <i class="fa-brands fa-github text-slate-400 group-hover:text-slate-100 text-xl"></i>
                    <span class="flex items-center text-base font-black text-slate-500 group-hover:text-slate-100">
                        <i class="fa-solid fa-star text-yellow-500 mr-1 text-sm"></i>1
                    </span>
                </a>
                <button id="toggleTerminal" class="p-2 rounded-xl border border-slate-700/50 bg-slate-800/50 text-slate-400 hover:text-slate-100 hover:border-slate-600 transition-all">
                    <i class="fa-solid fa-terminal text-xl"></i>
                </button>
            </div>
        </div>
    </div>
</nav>