@props(['profile'])

<section id="contact" class="w-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-32 pb-48 min-h-screen relative z-10 scroll-mt-32">
    <div class="w-full max-w-6xl">
        <div class="flex flex-col items-center mb-12 text-center">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 text-slate-100 tracking-tighter">Get In Touch</h2>
            <p class="text-base md:text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto font-medium">Let's build something great together. I'm always open to new opportunities and collaborations.</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 items-start">
            <div class="text-left space-y-4">
                <h3 class="text-3xl md:text-5xl font-black leading-tight text-slate-100 tracking-tighter">
                    Let's build <span class="text-cyan-500">better</span> products.
                </h3>
                <p class="text-lg md:text-2xl text-slate-400 font-medium max-w-md leading-relaxed">
                    Open for interesting opportunities or just a meaningful chat.
                </p>
                <div class="flex flex-wrap gap-3 pt-4">
                    <a href="mailto:{{ $profile->email ?? 'khurshidalam741@gmail.com' }}"
                       class="px-6 py-3.5 rounded-full bg-slate-100 text-slate-900 font-black text-base transition-all duration-300 hover:bg-slate-200 hover:-translate-y-1 flex items-center gap-2 group">
                        Start a Conversation
                        <i class="fa-solid fa-paper-plane transition-transform group-hover:translate-x-1 group-hover:-translate-y-1"></i>
                    </a>
                </div>
            </div>

            <div class="flex flex-col gap-4">
                @php
                    $contactLinks = [
                        'github' => [
                            'url' => $profile->portfolio_github_folder_link ?? null,
                            'icon' => 'fa-brands fa-github',
                            'label' => 'GitHub',
                            'color' => 'text-slate-400'
                        ],
                        'linkedin' => [
                            'url' => $profile->linked_link ?? null,
                            'icon' => 'fa-brands fa-linkedin',
                            'label' => 'LinkedIn',
                            'color' => 'text-slate-400'
                        ],
                        'twitter' => [
                            'url' => $profile->twitter_link ?? null,
                            'icon' => 'fa-brands fa-twitter',
                            'label' => 'Twitter/X',
                            'color' => 'text-slate-400'
                        ],
                        'email' => [
                            'url' => $profile->email ? 'mailto:' . $profile->email : null,
                            'icon' => 'fa-regular fa-envelope',
                            'label' => 'Email',
                            'color' => 'text-slate-400',
                            'display_value' => $profile->email ?? null
                        ],
                    ];
                @endphp

                @foreach($contactLinks as $key => $link)
                    @if($link['url'])
                        <a href="{{ $link['url'] }}"
                           target="{{ $key !== 'email' ? '_blank' : '_self' }}"
                           rel="noopener noreferrer"
                           class="group p-5 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:border-cyan-500/30 hover:bg-slate-800/70 transition-all duration-500 flex items-center gap-5 w-full">
                            <div class="p-3 rounded-2xl bg-slate-700/50 border border-slate-600/50 group-hover:scale-110 transition-transform duration-500">
                                <i class="{{ $link['icon'] }} {{ $link['color'] }} group-hover:text-cyan-500 transition-colors text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-black text-slate-500 uppercase tracking-widest text-[10px] mb-1">{{ $link['label'] }}</p>
                                <p class="text-base font-bold text-slate-100 group-hover:text-cyan-500 transition-colors truncate">
                                    {{ $link['display_value'] ?? (parse_url($link['url'], PHP_URL_HOST) ?? str_replace(['mailto:', 'https://', 'http://'], '', $link['url'])) }}
                                </p>
                            </div>
                            <div class="text-slate-600 group-hover:text-slate-100 transition-all duration-300">
                                <i class="fa-solid fa-arrow-up-right opacity-0 group-hover:opacity-100 transition-all duration-300 transform group-hover:translate-x-1 group-hover:-translate-y-1"></i>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>