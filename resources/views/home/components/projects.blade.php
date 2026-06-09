<section id="projects" class="w-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-32 pb-24 min-h-screen relative z-10 scroll-mt-32">
    <div class="w-full max-w-6xl">
        <div class="flex flex-col items-center mb-12 text-center">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 text-slate-100 tracking-tighter">Featured Projects</h2>
            <p class="text-base md:text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto font-medium">A collection of my most impactful work, from web applications to creative experiments.</p>
        </div>

        <div class="flex flex-wrap justify-center gap-2 mb-8">
            @foreach(['all' => 'All', 'ai' => 'AI', 'fintech' => 'Fintech', 'healthcare' => 'Healthcare', 'enterprise' => 'Enterprise'] as $key => $label)
                <button class="filter-btn px-4 py-2 rounded-full text-sm font-black transition-all duration-300 uppercase tracking-widest border {{ $key == 'all' ? 'bg-slate-100 text-slate-900 border-slate-100' : 'text-slate-500 border-slate-700/50 hover:border-slate-500 hover:text-slate-100' }}" data-filter="{{ $key }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <div class="grid gap-6 md:grid-cols-2 max-w-6xl mx-auto sm:px-0" id="projectsGrid">
            @php
                $projects = [
                    ['title' => 'AI Voice Call Automation', 'desc' => 'Automated voice call system with natural language processing using Twilio, ElevenLabs, and Claude AI.', 'category' => 'ai', 'tags' => ['Laravel', 'Vue.js', 'Twilio', 'ElevenLabs', 'Claude AI']],
                    ['title' => 'Payment Processing Platform', 'desc' => 'Multi-gateway payment integration with fraud detection and automated reconciliation.', 'category' => 'fintech', 'tags' => ['Laravel', 'PostgreSQL', 'Stripe', 'Mercury API']],
                    ['title' => 'AI Product Scraping Engine', 'desc' => 'Intelligent web scraping using Claude AI with automated data extraction and categorization.', 'category' => 'ai', 'tags' => ['Python', 'Node.js', 'Claude AI', 'Puppeteer']],
                    ['title' => 'Hospital Management System', 'desc' => 'Complete hospital workflow automation with online appointment booking and electronic medical records.', 'category' => 'healthcare', 'tags' => ['PHP', 'MySQL', 'SMS API']],
                ];
            @endphp

            @foreach($projects as $project)
                <div class="project-card rounded-3xl p-5 border border-slate-700/50 bg-slate-800/50 hover:border-cyan-500/30 hover:bg-slate-800/70 transition-all duration-500 flex flex-col h-full group" data-category="{{ $project['category'] }}">
                    <h3 class="text-2xl font-bold mb-3 text-slate-100 group-hover:text-cyan-500 transition-colors">{{ $project['title'] }}</h3>
                    <p class="text-base text-slate-400 mb-6 flex-grow leading-relaxed">{{ $project['desc'] }}</p>
                    <div class="flex flex-wrap gap-2 text-xs">
                        @foreach($project['tags'] as $tag)
                            <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1.5 rounded-lg text-slate-300 font-semibold">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-16 flex justify-center">
            <a href="{{ url('/projects') }}" class="px-8 py-3.5 rounded-full border border-slate-700/50 text-slate-100 font-black text-base transition-all duration-300 hover:bg-slate-800/50 hover:border-slate-500 flex items-center gap-2 group">
                View More Projects
                <i class="fa-solid fa-arrow-up-right group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const projectCards = document.querySelectorAll('.project-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.getAttribute('data-filter');

                filterBtns.forEach(b => {
                    b.classList.remove('bg-slate-100', 'text-slate-900');
                    b.classList.add('text-slate-500', 'border-slate-700/50');
                    if (b.getAttribute('data-filter') === filter) {
                        b.classList.add('bg-slate-100', 'text-slate-900');
                        b.classList.remove('text-slate-500');
                    }
                });

                projectCards.forEach(card => {
                    if (filter === 'all' || card.getAttribute('data-category') === filter) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>