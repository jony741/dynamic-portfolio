@props(['profile', 'experiences'])

<section id="about" class="w-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-32 pb-24 min-h-screen relative z-10 scroll-mt-32">
    <div class="w-full max-w-6xl">
        <div class="flex flex-col items-center mb-12 text-center">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 text-slate-100 tracking-tighter">Who Am I</h2>
            <p class="text-base md:text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto font-medium">A chronological journey through professional evolution and engineering milestones.</p>
        </div>

        <div class="grid lg:grid-cols-5 gap-12 items-start mb-12">
            <div class="lg:col-span-3">
                <p class="text-base md:text-xl lg:text-2xl text-slate-400 leading-relaxed font-medium">
                    {!! $profile->experience_summary !!}
                </p>
            </div>
            <div class="lg:col-span-2 flex flex-wrap gap-2">
                @foreach(['10+ Years Experience', 'AI Integration Expert', 'Team Leader', 'Payment Systems', 'Enterprise Solutions'] as $tag)
                    <span class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest border border-slate-700/50 bg-slate-800/50 text-slate-500 hover:text-slate-100 hover:border-cyan-500/30 transition-all">{{ $tag }}</span>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col items-center mb-12 text-center">
            <h3 class="text-sm font-black text-cyan-500 uppercase tracking-[0.3em]">Timeline</h3>
            <div class="h-px w-24 bg-cyan-500/30 mt-2"></div>
        </div>

        <div class="max-w-3xl mx-auto text-left relative border-l border-slate-700/50 ml-4 md:mx-auto pl-8">
            @forelse($experiences as $index => $experience)
                <div class="mb-10 relative group last:mb-0">
                    <span class="absolute flex h-4 w-4 rounded-full bg-slate-900 border-2 border-cyan-500 -left-[41px] top-1.5 transition-all duration-500 group-hover:bg-cyan-500 shadow-[0_0_15px_rgba(6,182,212,0.3)]"></span>
                    <div class="flex flex-col gap-2">
                        {{-- Date Range --}}
                        <span class="text-xs font-black text-slate-500 uppercase tracking-widest">
                        {{ \Carbon\Carbon::parse($experience->start_date)->format('Y') }} -
                        @if($experience->is_current)
                                Present
                            @elseif($experience->end_date)
                                {{ \Carbon\Carbon::parse($experience->end_date)->format('Y') }}
                            @else
                                Present
                            @endif
                    </span>

                        {{-- Experience Card --}}
                        <div class="p-4 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:bg-slate-800/70 hover:border-slate-600/50 transition-all duration-500 relative overflow-hidden group/card">
                            {{-- Company & Position --}}
                            <p class="text-lg md:text-xl font-bold text-slate-100 leading-relaxed">
                                {{ $experience->position }} at {{ $experience->company_name }}
                            </p>

                            {{-- Location (if available) --}}
                            @if($experience->location)
                                <p class="text-sm text-slate-500 mt-1 flex items-center gap-1">
                                    <i class="fa-solid fa-location-dot text-cyan-500 text-xs"></i>
                                    {{ $experience->location }}
                                </p>
                            @endif

                            {{-- Expand/Collapse Button --}}
                            <button class="expand-btn mt-4 flex items-center gap-2 text-xs font-black uppercase tracking-widest text-cyan-500 hover:text-cyan-400 transition-colors"
                                    data-expand="false"
                                    data-target="insight-{{ $index }}">
                                <i class="fa-solid fa-plus expand-icon"></i>
                                Read Insight
                            </button>

                            {{-- Expandable Content (Hidden by default) --}}
                            <div id="insight-{{ $index }}"
                                 class="insight-content hidden mt-4 pt-4 border-t border-slate-600/50 transition-all duration-300">
                                <div class="flex gap-3">
                                    <div class="w-1 bg-gradient-to-b from-cyan-500 to-cyan-500/20 rounded-full"></div>
                                    <div class="flex-1">
                                        <p class="text-sm md:text-base text-slate-300 leading-relaxed">
                                            {{ $experience->responsibility }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Current Position Badge --}}
                            @if($experience->is_current)
                                <div class="absolute top-4 right-4">
                            <span class="px-2 py-1 text-xs font-black uppercase tracking-wider bg-green-500/20 text-green-400 rounded-full border border-green-500/30">
                                Current
                            </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-slate-500 py-8">
                    <i class="fa-solid fa-timeline text-4xl mb-3 opacity-50"></i>
                    <p>No work experience added yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- JavaScript for Expand/Collapse Functionality --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all expand buttons
        const expandButtons = document.querySelectorAll('.expand-btn');

        expandButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the target content ID
                const targetId = this.getAttribute('data-target');
                const targetContent = document.getElementById(targetId);
                const icon = this.querySelector('.expand-icon');
                const isExpanded = this.getAttribute('data-expand') === 'true';

                // Close all other expanded sections (optional - for accordion behavior)
                // Uncomment the following lines if you want only one section open at a time
                /*
                expandButtons.forEach(btn => {
                    if (btn !== this) {
                        const otherTargetId = btn.getAttribute('data-target');
                        const otherContent = document.getElementById(otherTargetId);
                        const otherIcon = btn.querySelector('.expand-icon');
                        btn.setAttribute('data-expand', 'false');
                        otherContent.classList.add('hidden');
                        otherIcon.classList.remove('fa-minus');
                        otherIcon.classList.add('fa-plus');
                    }
                });
                */

                // Toggle the current section
                if (isExpanded) {
                    // Collapse
                    targetContent.classList.add('hidden');
                    this.setAttribute('data-expand', 'false');
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');

                    // Optional: Change button text
                    // this.innerHTML = '<i class="fa-solid fa-plus expand-icon"></i> Read Insight';
                } else {
                    // Expand
                    targetContent.classList.remove('hidden');
                    this.setAttribute('data-expand', 'true');
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');

                    // Optional: Change button text
                    // this.innerHTML = '<i class="fa-solid fa-minus expand-icon"></i> Hide Insight';

                    // Smooth scroll to the expanded content (optional)
                    targetContent.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }
            });
        });
    });
</script>

{{-- Optional: Add CSS animations for smooth expand/collapse --}}
<style>
    .insight-content {
        animation: fadeInUp 0.3s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Smooth transition for the button icon */
    .expand-icon {
        transition: transform 0.2s ease;
    }

    .expand-btn:hover .expand-icon {
        transform: scale(1.1);
    }
</style>