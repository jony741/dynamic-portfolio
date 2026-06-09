<div class="fixed bottom-4 left-0 right-0 z-50 flex justify-center px-4 pointer-events-none">
    <nav class="bg-slate-900/80 backdrop-blur-xl border border-slate-700/50 rounded-2xl px-2 py-2 shadow-2xl pointer-events-auto">
        <div class="flex items-center gap-1 sm:gap-2 px-1">
            @php
                $navItems = [
                    ['id' => 'home', 'icon' => 'fa-solid fa-house', 'label' => 'Home', 'showText' => false],
                    ['id' => 'about', 'icon' => 'fa-solid fa-info-circle', 'label' => 'About', 'showText' => false],
                    ['id' => 'projects', 'icon' => 'fa-solid fa-folder-open', 'label' => 'Projects', 'showText' => false],
                    ['id' => 'skills', 'icon' => 'fa-solid fa-bullseye', 'label' => 'Skills', 'showText' => false],
                    ['id' => 'contact', 'icon' => 'fa-regular fa-address-card', 'label' => 'Contact', 'showText' => false],
                ];
            @endphp

            @foreach($navItems as $item)
                <a href="#{{ $item['id'] }}" class="nav-link relative flex items-center justify-center p-3 sm:p-4 rounded-2xl transition-all duration-300 group {{ $loop->index == 1 ? 'text-cyan-500 bg-slate-800/50' : 'text-slate-500 hover:text-slate-300 hover:bg-slate-800/30' }}" data-section="{{ $item['id'] }}">
                    <i class="{{ $item['icon'] }} text-xl"></i>
                    @if($item['showText'])
                        <span class="text-[10px] font-black uppercase tracking-widest ml-1 text-cyan-500">{{ $item['label'] }}</span>
                    @else
                        <span class="absolute -top-12 left-1/2 -translate-x-1/2 px-3 py-1 bg-slate-800 text-slate-100 text-xs font-bold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none border border-slate-700/50 whitespace-nowrap">{{ $item['label'] }}</span>
                    @endif
                </a>
            @endforeach
        </div>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        function updateActiveNav() {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 150;
                const sectionBottom = sectionTop + section.offsetHeight;
                if (window.scrollY >= sectionTop && window.scrollY < sectionBottom) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('text-cyan-500', 'bg-slate-800/50');
                link.classList.add('text-slate-500');
                const linkSection = link.getAttribute('data-section');
                if (linkSection === current) {
                    link.classList.add('text-cyan-500', 'bg-slate-800/50');
                    link.classList.remove('text-slate-500');
                }
            });
        }

        window.addEventListener('scroll', updateActiveNav);
        updateActiveNav();
    });
</script>