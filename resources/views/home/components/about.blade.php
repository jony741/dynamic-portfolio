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
            @forelse($experiences as $experience)
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

                            {{-- Responsibility / Insight Button --}}
                            <button class="insight-btn mt-4 flex items-center gap-2 text-xs font-black uppercase tracking-widest text-cyan-500 hover:text-cyan-400 transition-colors"
                                    data-insight="{{ $experience->responsibility }}">
                                <i class="fa-solid fa-plus"></i> Read Insight
                            </button>

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