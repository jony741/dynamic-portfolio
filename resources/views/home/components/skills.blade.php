@props(['stackItems'])

<section id="skills" class="w-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-32 pb-24 min-h-screen relative z-10 scroll-mt-32">
    <div class="w-full max-w-6xl">
        <div class="flex flex-col items-center mb-12 text-center">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 text-slate-100 tracking-tighter">My Stack</h2>
            <p class="text-base md:text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto font-medium">A curated selection of technologies I use to build high-performance products.</p>
        </div>

        @if($stackItems && $stackItems->count() > 0)
            @php
                // Normalize category names (capitalize first letter of each word)
                $normalizedItems = $stackItems->map(function($item) {
                    if ($item->technology && $item->technology->category) {
                        // Convert category to proper case (e.g., "backend" -> "Backend", "AI & TOOLS" -> "AI & Tools")
                        $category = ucwords(strtolower($item->technology->category));

                        // Special handling for "AI & Tools"
                        if (strtolower($category) == 'ai & tools') {
                            $category = 'AI & Tools';
                        }

                        $item->normalized_category = $category;
                    } else {
                        $item->normalized_category = 'Other';
                    }
                    return $item;
                });

                // Group by normalized category
                $groupedItems = $normalizedItems->groupBy('normalized_category');

                // Define order of categories (all in proper case)
                $categoryOrder = ['Frontend', 'Backend', 'Database', 'AI & Tools', 'DevOps', 'Other'];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($categoryOrder as $category)
                    @if(isset($groupedItems[$category]) && $groupedItems[$category]->count() > 0)
                        <div class="p-6 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:border-cyan-500/30 transition-all duration-500">
                            <div class="flex items-center gap-4 mb-6">
                                <h3 class="text-sm font-black text-cyan-500 uppercase tracking-widest pl-3 border-l-2 border-cyan-500">
                                    {{ $category }}
                                </h3>
                                <div class="flex-1 h-px bg-gradient-to-r from-cyan-500/30 to-transparent"></div>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                                @foreach($groupedItems[$category] as $item)
                                    <div class="group relative flex flex-col items-center gap-2 p-3 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300 hover:scale-105">
                                        <div class="relative">
                                            @if($item->technology && $item->technology->icon_class)
                                                <i class="{{ $item->technology->icon_class }} text-4xl transition-all duration-300 group-hover:scale-110"
                                                   style="color: {{ $item->technology->color_code ?? '#94a3b8' }}"></i>
                                            @else
                                                <i class="fa-solid fa-code text-4xl text-slate-400 group-hover:text-cyan-500 transition-all duration-300"></i>
                                            @endif

                                            <div class="absolute -top-1 -right-1 flex gap-0.5">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <div class="w-1 h-1 rounded-full {{ $i <= $item->proficiency_level ? 'bg-cyan-500' : 'bg-slate-600' }}"></div>
                                                @endfor
                                            </div>
                                        </div>

                                        <span class="text-xs sm:text-sm font-bold text-slate-300 group-hover:text-slate-100 transition-colors text-center">
                                            {{ $item->technology ? $item->technology->name : 'Unknown' }}
                                        </span>

                                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-slate-900 rounded text-[10px] font-bold text-cyan-400 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-10 border border-cyan-500/30">
                                            {{ $item->proficiency_level }}/5 -
                                            @switch($item->proficiency_level)
                                                @case(1) Beginner @break
                                                @case(2) Basic @break
                                                @case(3) Intermediate @break
                                                @case(4) Advanced @break
                                                @case(5) Expert @break
                                            @endswitch
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="text-center text-slate-500 py-16">
                <i class="fa-solid fa-layer-group text-6xl mb-4 opacity-30"></i>
                <p class="text-lg">No skills added yet.</p>
                <p class="text-sm mt-2">Check back soon for my tech stack!</p>
            </div>
        @endif
    </div>
</section>