<section id="skills" class="w-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-32 pb-24 min-h-screen relative z-10 scroll-mt-32">
    <div class="w-full max-w-6xl">
        <div class="flex flex-col items-center mb-12 text-center">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 text-slate-100 tracking-tighter">My Stack</h2>
            <p class="text-base md:text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto font-medium">A curated selection of technologies I use to build high-performance products.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $skillCategories = [
                    'Frontend' => [
                        ['icon' => 'fa-brands fa-vuejs', 'color' => '#42b883', 'name' => 'Vue.js'],
                        ['icon' => 'fa-brands fa-react', 'color' => '#61dafb', 'name' => 'React'],
                        ['icon' => 'fa-brands fa-js', 'color' => '#f7df1e', 'name' => 'JavaScript'],
                        ['icon' => 'fa-brands fa-tailwind', 'color' => '#06b6d4', 'name' => 'Tailwind'],
                    ],
                    'Backend' => [
                        ['icon' => 'fa-brands fa-laravel', 'color' => '#ff2d20', 'name' => 'Laravel'],
                        ['icon' => 'fa-brands fa-node', 'color' => '#339933', 'name' => 'Node.js'],
                        ['icon' => 'fa-brands fa-python', 'color' => '#3776ab', 'name' => 'Python'],
                        ['icon' => 'fa-brands fa-php', 'color' => '#777bb4', 'name' => 'PHP'],
                    ],
                    'Database' => [
                        ['icon' => 'fa-solid fa-database', 'color' => '#4479a1', 'name' => 'MySQL'],
                        ['icon' => 'fa-solid fa-database', 'color' => '#336791', 'name' => 'PostgreSQL'],
                        ['icon' => 'fa-solid fa-leaf', 'color' => '#47a248', 'name' => 'MongoDB'],
                        ['icon' => 'fa-solid fa-bolt', 'color' => '#dc382d', 'name' => 'Redis'],
                    ],
                    'AI & Tools' => [
                        ['icon' => 'fa-solid fa-brain', 'color' => '#7c3aed', 'name' => 'Claude AI'],
                        ['icon' => 'fa-solid fa-microchip', 'color' => '#10a37f', 'name' => 'OpenAI'],
                        ['icon' => 'fa-brands fa-docker', 'color' => '#2496ed', 'name' => 'Docker'],
                        ['icon' => 'fa-brands fa-aws', 'color' => '#ff9900', 'name' => 'AWS'],
                    ],
                ];
            @endphp

            @foreach($skillCategories as $category => $skills)
                <div class="p-6 rounded-3xl border border-slate-700/50 bg-slate-800/50">
                    <h3 class="text-sm font-black text-cyan-500 uppercase tracking-widest pl-3 border-l-2 border-cyan-500 mb-6">{{ $category }}</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach($skills as $skill)
                            <div class="flex flex-col items-center gap-2 p-3 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all">
                                <i class="{{ $skill['icon'] }} text-4xl" style="color: {{ $skill['color'] }}"></i>
                                <span class="text-xs font-bold text-slate-500">{{ $skill['name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>