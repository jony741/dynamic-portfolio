@props(['projects'])

<section id="projects" class="w-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-32 pb-24 min-h-screen relative z-10 scroll-mt-32">
    <div class="w-full max-w-6xl">
        <div class="flex flex-col items-center mb-12 text-center">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 text-slate-100 tracking-tighter">Featured Projects</h2>
            <p class="text-base md:text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto font-medium">A collection of my most impactful work, from web applications to creative experiments.</p>
        </div>

        {{-- Category Filter Buttons --}}
        <div class="flex flex-wrap justify-center gap-2 mb-8" id="categoryFilters">
            <button class="filter-btn px-4 py-2 rounded-full text-sm font-black transition-all duration-300 uppercase tracking-widest border bg-slate-100 text-slate-900 border-slate-100" data-filter="all">
                All
            </button>

            @php
                // Get unique categories from projects
                $categories = $projects->pluck('category')->unique();
            @endphp

            @foreach($categories as $category)
                <button class="filter-btn px-6 py-2 rounded-full text-sm font-black transition-all duration-300 uppercase tracking-widest border text-slate-500 border-slate-700/50 hover:border-slate-500 hover:text-slate-100" data-filter="{{ strtolower($category) }}">
                    {{ ucfirst($category) }}
                </button>
            @endforeach
        </div>

        {{-- Projects Grid --}}
        <div class="grid gap-6 md:grid-cols-2 max-w-6xl mx-auto sm:px-0" id="projectsGrid">
            @forelse($projects as $project)
                <div class="project-card rounded-3xl p-5 border border-slate-700/50 bg-slate-800/50 hover:border-cyan-500/30 hover:bg-slate-800/70 transition-all duration-500 flex flex-col h-full group"
                     data-category="{{ strtolower($project->category) }}">

                    {{-- Project Header with Thumbnail (if exists) --}}
                    @if($project->thumbnail_url)
                        <div class="relative w-full h-48 mb-4 rounded-2xl overflow-hidden bg-slate-900">
                            <img src="{{ asset($project->thumbnail_url) }}"
                                 alt="{{ $project->name }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    @endif

                    {{-- Project Title --}}
                    <h3 class="text-2xl font-bold mb-3 text-slate-100 group-hover:text-cyan-500 transition-colors">
                        {{ $project->name }}
                    </h3>

                    {{-- Project Description --}}
                    <p class="text-base text-slate-400 mb-6 flex-grow leading-relaxed">
                        {{ $project->description }}
                    </p>

                    {{-- Technologies Used --}}
                    @if($project->technologies && $project->technologies->count() > 0)
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($project->technologies as $tech)
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1.5 rounded-lg text-slate-300 font-semibold text-xs transition-all hover:bg-cyan-500/20 hover:border-cyan-500/30 hover:text-cyan-300">
                        {{ $tech->name }}
                    </span>
                            @endforeach
                        </div>
                    @endif

                    {{-- Project Links --}}
                    <div class="flex items-center gap-3 mt-4 pt-4 border-t border-slate-700/50">
                        @if($project->live_url)
                            <a href="{{ $project->live_url }}" target="_blank"
                               class="flex items-center gap-2 px-4 py-2 rounded-lg bg-cyan-600/20 text-cyan-400 hover:bg-cyan-600 hover:text-white transition-all duration-300 text-sm font-bold">
                                <i class="fa-solid fa-external-link-alt text-xs"></i>
                                Live Demo
                            </a>
                        @endif

                        @if($project->repo_url)
                            <a href="{{ $project->repo_url }}" target="_blank"
                               class="flex items-center gap-2 px-4 py-2 rounded-lg bg-slate-700/50 text-slate-300 hover:bg-slate-700 hover:text-white transition-all duration-300 text-sm font-bold">
                                <i class="fa-brands fa-github text-sm"></i>
                                Source Code
                            </a>
                        @endif
                    </div>

                    {{-- Featured Badge --}}
                    @if($project->is_featured)
                        <div class="absolute top-5 right-5">
                    <span class="px-2 py-1 text-xs font-black uppercase tracking-wider bg-yellow-500/20 text-yellow-400 rounded-full border border-yellow-500/30 flex items-center gap-1">
                        <i class="fa-solid fa-star text-xs"></i>
                        Featured
                    </span>
                        </div>
                    @endif
                </div>
            @empty
                {{-- Empty State --}}
                <div class="col-span-2 text-center text-slate-500 py-16">
                    <i class="fa-solid fa-folder-open text-6xl mb-4 opacity-30"></i>
                    <p class="text-lg">No projects added yet.</p>
                    <p class="text-sm mt-2">Check back soon for amazing work!</p>
                </div>
            @endforelse
        </div>

        {{-- View More Button (Optional) --}}
        @if($projects->count() > 4)
            <div class="mt-16 flex justify-center">
                <a href="{{ url('/projects') }}" class="px-8 py-3.5 rounded-full border border-slate-700/50 text-slate-100 font-black text-base transition-all duration-300 hover:bg-slate-800/50 hover:border-slate-500 flex items-center gap-2 group">
                    View All Projects
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        @endif
    </div>
</section>

{{-- Filtering JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const projectCards = document.querySelectorAll('.project-card');

        if (filterBtns.length && projectCards.length) {
            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const filter = btn.getAttribute('data-filter');

                    // Update active button styling
                    filterBtns.forEach(b => {
                        b.classList.remove('bg-slate-100', 'text-slate-900');
                        b.classList.add('text-slate-500', 'border-slate-700/50');
                        if (b.getAttribute('data-filter') === filter) {
                            b.classList.add('bg-slate-100', 'text-slate-900');
                            b.classList.remove('text-slate-500');
                        }
                    });

                    // Filter projects with animation
                    projectCards.forEach((card, index) => {
                        if (filter === 'all' || card.getAttribute('data-category') === filter) {
                            card.style.display = 'flex';
                            setTimeout(() => {
                                card.style.opacity = '1';
                                card.style.transform = 'scale(1)';
                            }, index * 50);
                        } else {
                            card.style.opacity = '0';
                            card.style.transform = 'scale(0.95)';
                            setTimeout(() => {
                                card.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });
        }
    });
</script>