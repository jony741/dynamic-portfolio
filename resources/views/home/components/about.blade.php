<section id="about" class="w-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-32 pb-24 min-h-screen relative z-10 scroll-mt-32">
    <div class="w-full max-w-6xl">
        <div class="flex flex-col items-center mb-12 text-center">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 text-slate-100 tracking-tighter">Who Am I</h2>
            <p class="text-base md:text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto font-medium">A chronological journey through professional evolution and engineering milestones.</p>
        </div>

        <div class="grid lg:grid-cols-5 gap-12 items-start mb-12">
            <div class="lg:col-span-3">
                <p class="text-base md:text-xl lg:text-2xl text-slate-400 leading-relaxed font-medium">I'm Khurshid Alam, based in Dhaka, Bangladesh. With a Bachelor's degree in Computer Science and Engineering from <a href="#" class="text-slate-100 hover:text-cyan-500 underline decoration-cyan-500/30 transition-colors">University</a>, I bring over 10 years of experience in full-stack development. I specialize in AI integration, payment systems, and building scalable enterprise applications.</p>
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
            @php
                $timelineItems = [
                    ['year' => '2020 - Present', 'title' => 'Full Stack AI Developer at EasyPayDirect', 'insight' => 'Led development of AI-powered payment solutions, integrated multiple payment gateways, and implemented fraud detection systems using machine learning algorithms.'],
                    ['year' => '2019 - 2020', 'title' => 'Senior Developer at Pattern (Remote)', 'insight' => 'Developed scalable e-commerce solutions, optimized database queries reducing response time by 40%, and mentored junior developers.'],
                    ['year' => '2017 - 2019', 'title' => 'Principal Software Engineer at Fingerprint Technology Limited', 'insight' => 'Architected biometric authentication systems, led a team of 5 engineers, and implemented microservices architecture for scalability.'],
                    ['year' => '2015 - 2016', 'title' => 'Software Engineer at Aubretia Software (Canada)', 'insight' => 'Worked on CRM systems, integrated third-party APIs, and implemented reporting modules for business intelligence.'],
                    ['year' => '2014', 'title' => 'Trainee Software Engineer at Divine IT Limited', 'insight' => 'Started professional journey, learned software development lifecycle, and contributed to ERP modules.']
                ];
            @endphp

            @foreach($timelineItems as $item)
                <div class="mb-10 relative group last:mb-0">
                    <span class="absolute flex h-4 w-4 rounded-full bg-slate-900 border-2 border-cyan-500 -left-[41px] top-1.5 transition-all duration-500 group-hover:bg-cyan-500"></span>
                    <div class="flex flex-col gap-2">
                        <span class="text-xs font-black text-slate-500 uppercase tracking-widest">{{ $item['year'] }}</span>
                        <div class="p-4 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:bg-slate-800/70 hover:border-slate-600/50 transition-all duration-500">
                            <p class="text-lg md:text-xl font-bold text-slate-100 leading-relaxed">{{ $item['title'] }}</p>
                            <button class="insight-btn mt-4 flex items-center gap-2 text-xs font-black uppercase tracking-widest text-cyan-500 hover:text-cyan-400 transition-colors" data-insight="{{ $item['insight'] }}">
                                <i class="fa-solid fa-plus"></i> Read Insight
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>