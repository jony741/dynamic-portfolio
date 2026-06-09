{{-- resources/views/portfolio.blade.php --}}
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Khurshid Alam - Full Stack AI Developer Portfolio">
    <meta name="author" content="Khurshid Alam">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Khurshid Alam | Full Stack AI Developer">
    <meta property="og:description" content="Full Stack AI Developer with 10+ years of expertise in building innovative software solutions.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('assets/me.jpg') }}">

    <title>Khurshid Alam | Full Stack AI Developer</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome (alternative to Lucide icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Custom animations */
        @keyframes scan {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(100%);
            }
        }
        .animate-scan {
            animation: scan 3.5s linear infinite;
        }
        .text-glow {
            text-shadow: 0 0 20px rgba(6, 182, 212, 0.5);
        }
        .bg-noise {
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
            opacity: 0.02;
            mix-blend-mode: overlay;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-slate-100 antialiased" cz-shortcut-listen="true">

<div id="app">
    <div class="w-full min-h-screen bg-slate-900 text-slate-100 relative">

        {{-- Background Effects --}}
        <div class="fixed inset-0 z-0 bg-slate-900 pointer-events-none overflow-hidden">
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(to right, rgb(148, 163, 184) 1px, transparent 1px), linear-gradient(rgb(148, 163, 184) 1px, transparent 1px); background-size: 40px 40px;"></div>
            <div class="absolute top-1/2 left-1/2 w-[60%] h-[60%] bg-cyan-500/10 blur-[120px] rounded-full animate-pulse"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-transparent via-slate-900/40 to-slate-900 opacity-90"></div>
            <div class="absolute inset-0 bg-noise"></div>
        </div>

        {{-- Navigation --}}
        <nav class="fixed top-0 left-0 w-full z-50 transition-all duration-500 py-3">
            <div class="mx-auto transition-all duration-500 max-w-7xl px-2 sm:px-4 lg:px-6">
                <div class="relative flex items-center justify-between px-2 sm:px-4 transition-all duration-500 py-3 rounded-2xl border bg-slate-900/90 backdrop-blur-xl border-slate-700/50 shadow-2xl">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                        <div class="p-2 rounded-xl border transition-all duration-300 border-slate-700/50 bg-slate-800/50 group-hover:border-cyan-500/50">
                            <i class="fa-solid fa-code text-cyan-500 text-xl"></i>
                        </div>
                        <div class="relative">
                                <span class="font-black text-2xl tracking-tighter uppercase text-slate-100 flex items-baseline">
                                    Khurshid<span class="text-[17px] ml-0.5 transition-colors text-slate-500 group-hover:text-cyan-500">Alam</span>
                                </span>
                            <div class="absolute -bottom-0.5 left-0 h-1 rounded-full transition-all duration-300 w-0 group-hover:w-full bg-cyan-500 shadow-[0_0_10px_rgba(6,182,212,0.5)]"></div>
                        </div>
                    </a>
                    <div class="flex items-center gap-2">
                        <a href="https://github.com/jony741/khurshid.portfolio" target="_blank" class="flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-700/50 bg-slate-800/50 hover:bg-slate-700/50 transition-all group">
                            <i class="fa-brands fa-github text-slate-400 group-hover:text-slate-100 transition-colors text-xl"></i>
                            <span class="flex items-center text-base font-black text-slate-500 group-hover:text-slate-100 transition-colors">
                                    <i class="fa-solid fa-star text-yellow-500 mr-1 text-sm"></i>1
                                </span>
                        </a>
                        <button id="toggleTerminal" class="p-2 rounded-xl border transition-all duration-300 border-slate-700/50 bg-slate-800/50 text-slate-400 hover:text-slate-100 hover:border-slate-600" title="Toggle Terminal">
                            <i class="fa-solid fa-terminal text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <main class="w-full">
            {{-- Hero Section --}}
            <section id="home" class="min-h-[90vh] w-full max-w-6xl mx-auto flex flex-col lg:flex-row items-center justify-center px-4 sm:px-6 lg:px-8 gap-12 lg:gap-16 relative z-10 pt-24 pb-20 scroll-mt-20">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none z-0 opacity-70">
                    <span class="text-[18rem] md:text-[28rem] font-black text-white/[0.09] select-none tracking-[-0.07em]">KH</span>
                </div>
                <div class="flex-1 text-left max-w-2xl space-y-4 relative z-10">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-sm font-bold uppercase tracking-widest">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </span>
                            Available for work
                        </div>
                        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black leading-[0.9] tracking-tighter text-slate-100">
                            <span class="block">Khurshid Alam</span>
                            <span class="block text-slate-500 text-3xl sm:text-5xl lg:text-6xl">Full Stack AI Developer</span>
                        </h1>
                        <p class="text-lg md:text-xl text-slate-400 leading-relaxed max-w-lg">Full Stack AI Developer with 10+ years of expertise in building innovative software solutions. Specialized in AI integration, payment systems, and enterprise automation.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <a href="#projects" class="flex-1 sm:flex-none px-6 py-3.5 rounded-full bg-white text-black font-black text-base hover:bg-zinc-100 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2 group shadow-xl shadow-white/10">
                                Selected Works
                            </a>
                            <a href="#contact" class="flex-1 sm:flex-none px-6 py-3.5 rounded-full bg-cyan-600 hover:bg-cyan-700 text-white font-black text-base transition-all duration-300 flex items-center justify-center gap-2 group shadow-xl shadow-cyan-500/20">
                                Get in Touch
                                <i class="fa-solid fa-paper-plane group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                            </a>
                        </div>
                        <div class="flex items-center gap-6 sm:gap-5 pt-2 sm:pt-0">
                            <div class="h-5 w-px bg-white/10 hidden sm:block"></div>
                            <a href="https://github.com/jony741" target="_blank" rel="noopener noreferrer" class="text-slate-500 hover:text-slate-100 transition-all hover:scale-110 active:scale-95" title="GitHub">
                                <i class="fa-brands fa-github text-2xl"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/khurshid-alam-43b4131aa/" target="_blank" rel="noopener noreferrer" class="text-slate-500 hover:text-slate-100 transition-all hover:scale-110 active:scale-95" title="LinkedIn">
                                <i class="fa-brands fa-linkedin text-2xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative flex-shrink-0">
                    <div class="relative group">
                        <div class="absolute -top-3 -left-3 w-10 h-10 border-t-2 border-l-2 border-cyan-500/60 z-20 transition-transform group-hover:rotate-12"></div>
                        <div class="absolute -bottom-3 -right-3 w-10 h-10 border-b-2 border-r-2 border-cyan-500/60 z-20 transition-transform group-hover:-rotate-12"></div>
                        <div class="relative w-[300px] md:w-[340px] lg:w-[380px] aspect-square rounded-3xl overflow-hidden border border-slate-700/50 shadow-2xl bg-slate-950">
                            <img src="{{ asset('assets/me.jpeg') }}" alt="Khurshid Alam" class="w-full h-full object-cover scale-105 group-hover:scale-100 grayscale group-hover:grayscale-0 transition-all duration-700">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-cyan-500/5 to-slate-900/30 group-hover:via-transparent transition-all duration-700"></div>
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/10 to-transparent h-[3px] w-full -translate-y-full group-hover:animate-scan pointer-events-none"></div>
                        </div>
                        <div class="absolute -inset-12 bg-cyan-500/10 blur-[90px] rounded-full -z-10 opacity-0 group-hover:opacity-80 transition-opacity duration-700"></div>
                    </div>
                </div>
            </section>

            {{-- About Section --}}
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
                            <div class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest border border-slate-700/50 bg-slate-800/50 text-slate-500 hover:text-slate-100 hover:border-cyan-500/30 transition-all duration-300">10+ Years Experience</div>
                            <div class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest border border-slate-700/50 bg-slate-800/50 text-slate-500 hover:text-slate-100 hover:border-cyan-500/30 transition-all duration-300">AI Integration Expert</div>
                            <div class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest border border-slate-700/50 bg-slate-800/50 text-slate-500 hover:text-slate-100 hover:border-cyan-500/30 transition-all duration-300">Team Leader</div>
                            <div class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest border border-slate-700/50 bg-slate-800/50 text-slate-500 hover:text-slate-100 hover:border-cyan-500/30 transition-all duration-300">Payment Systems</div>
                            <div class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest border border-slate-700/50 bg-slate-800/50 text-slate-500 hover:text-slate-100 hover:border-cyan-500/30 transition-all duration-300">Enterprise Solutions</div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center mb-12 text-center">
                        <h3 class="text-sm font-black text-cyan-500 uppercase tracking-[0.3em]">Timeline</h3>
                        <div class="h-px w-24 bg-cyan-500/30"></div>
                    </div>
                    <div class="max-w-3xl mx-auto text-left relative border-l border-slate-700/50 ml-4 md:mx-auto pl-8">
                        <div class="mb-10 relative group last:mb-0">
                            <span class="absolute flex h-4 w-4 rounded-full bg-slate-900 border-2 border-cyan-500 -left-[41px] top-1.5 transition-all duration-500 group-hover:bg-cyan-500 shadow-[0_0_15px_rgba(6,182,212,0.3)]"></span>
                            <div class="flex flex-col gap-2">
                                <span class="text-xs font-black text-slate-500 uppercase tracking-widest">2020 - Present</span>
                                <div class="p-4 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:bg-slate-800/70 hover:border-slate-600/50 transition-all duration-500 relative overflow-hidden">
                                    <p class="text-lg md:text-xl font-bold text-slate-100 leading-relaxed">Full Stack AI Developer at EasyPayDirect</p>
                                    <button class="mt-4 flex items-center gap-2 text-xs font-black uppercase tracking-widest text-cyan-500 hover:text-cyan-400 transition-colors insight-btn" data-insight="Led development of AI-powered payment solutions, integrated multiple payment gateways, and implemented fraud detection systems using machine learning algorithms.">
                                        <i class="fa-solid fa-plus"></i> Read Insight
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10 relative group last:mb-0">
                            <span class="absolute flex h-4 w-4 rounded-full bg-slate-900 border-2 border-cyan-500 -left-[41px] top-1.5 transition-all duration-500 group-hover:bg-cyan-500 shadow-[0_0_15px_rgba(6,182,212,0.3)]"></span>
                            <div class="flex flex-col gap-2">
                                <span class="text-xs font-black text-slate-500 uppercase tracking-widest">2019 - 2020</span>
                                <div class="p-4 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:bg-slate-800/70 hover:border-slate-600/50 transition-all duration-500 relative overflow-hidden">
                                    <p class="text-lg md:text-xl font-bold text-slate-100 leading-relaxed">Senior Developer at Pattern (Remote)</p>
                                    <button class="mt-4 flex items-center gap-2 text-xs font-black uppercase tracking-widest text-cyan-500 hover:text-cyan-400 transition-colors insight-btn" data-insight="Developed scalable e-commerce solutions, optimized database queries reducing response time by 40%, and mentored junior developers.">
                                        <i class="fa-solid fa-plus"></i> Read Insight
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10 relative group last:mb-0">
                            <span class="absolute flex h-4 w-4 rounded-full bg-slate-900 border-2 border-cyan-500 -left-[41px] top-1.5 transition-all duration-500 group-hover:bg-cyan-500 shadow-[0_0_15px_rgba(6,182,212,0.3)]"></span>
                            <div class="flex flex-col gap-2">
                                <span class="text-xs font-black text-slate-500 uppercase tracking-widest">2017 - 2019</span>
                                <div class="p-4 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:bg-slate-800/70 hover:border-slate-600/50 transition-all duration-500 relative overflow-hidden">
                                    <p class="text-lg md:text-xl font-bold text-slate-100 leading-relaxed">Principal Software Engineer at Fingerprint Technology Limited</p>
                                    <button class="mt-4 flex items-center gap-2 text-xs font-black uppercase tracking-widest text-cyan-500 hover:text-cyan-400 transition-colors insight-btn" data-insight="Architected biometric authentication systems, led a team of 5 engineers, and implemented microservices architecture for scalability.">
                                        <i class="fa-solid fa-plus"></i> Read Insight
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10 relative group last:mb-0">
                            <span class="absolute flex h-4 w-4 rounded-full bg-slate-900 border-2 border-cyan-500 -left-[41px] top-1.5 transition-all duration-500 group-hover:bg-cyan-500 shadow-[0_0_15px_rgba(6,182,212,0.3)]"></span>
                            <div class="flex flex-col gap-2">
                                <span class="text-xs font-black text-slate-500 uppercase tracking-widest">2015 - 2016</span>
                                <div class="p-4 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:bg-slate-800/70 hover:border-slate-600/50 transition-all duration-500 relative overflow-hidden">
                                    <p class="text-lg md:text-xl font-bold text-slate-100 leading-relaxed">Software Engineer at Aubretia Software (Canada)</p>
                                    <button class="mt-4 flex items-center gap-2 text-xs font-black uppercase tracking-widest text-cyan-500 hover:text-cyan-400 transition-colors insight-btn" data-insight="Worked on CRM systems, integrated third-party APIs, and implemented reporting modules for business intelligence.">
                                        <i class="fa-solid fa-plus"></i> Read Insight
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10 relative group last:mb-0">
                            <span class="absolute flex h-4 w-4 rounded-full bg-slate-900 border-2 border-cyan-500 -left-[41px] top-1.5 transition-all duration-500 group-hover:bg-cyan-500 shadow-[0_0_15px_rgba(6,182,212,0.3)]"></span>
                            <div class="flex flex-col gap-2">
                                <span class="text-xs font-black text-slate-500 uppercase tracking-widest">2014</span>
                                <div class="p-4 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:bg-slate-800/70 hover:border-slate-600/50 transition-all duration-500 relative overflow-hidden">
                                    <p class="text-lg md:text-xl font-bold text-slate-100 leading-relaxed">Trainee Software Engineer at Divine IT Limited</p>
                                    <button class="mt-4 flex items-center gap-2 text-xs font-black uppercase tracking-widest text-cyan-500 hover:text-cyan-400 transition-colors insight-btn" data-insight="Started professional journey, learned software development lifecycle, and contributed to ERP modules.">
                                        <i class="fa-solid fa-plus"></i> Read Insight
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Projects Section --}}
            <section id="projects" class="w-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-32 pb-24 min-h-screen relative z-10 scroll-mt-32">
                <div class="w-full max-w-6xl">
                    <div class="flex flex-col items-center mb-12 text-center">
                        <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 text-slate-100 tracking-tighter">Featured Projects</h2>
                        <p class="text-base md:text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto font-medium">A collection of my most impactful work, from web applications to creative experiments.</p>
                    </div>
                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        <button class="filter-btn px-4 py-2 rounded-full text-sm font-black transition-all duration-300 uppercase tracking-widest border bg-slate-100 text-slate-900 border-slate-100" data-filter="all">All</button>
                        <button class="filter-btn px-6 py-2 rounded-full text-sm font-black transition-all duration-300 uppercase tracking-widest border text-slate-500 border-slate-700/50 hover:border-slate-500 hover:text-slate-100" data-filter="ai">AI</button>
                        <button class="filter-btn px-6 py-2 rounded-full text-sm font-black transition-all duration-300 uppercase tracking-widest border text-slate-500 border-slate-700/50 hover:border-slate-500 hover:text-slate-100" data-filter="fintech">Fintech</button>
                        <button class="filter-btn px-6 py-2 rounded-full text-sm font-black transition-all duration-300 uppercase tracking-widest border text-slate-500 border-slate-700/50 hover:border-slate-500 hover:text-slate-100" data-filter="healthcare">Healthcare</button>
                        <button class="filter-btn px-6 py-2 rounded-full text-sm font-black transition-all duration-300 uppercase tracking-widest border text-slate-500 border-slate-700/50 hover:border-slate-500 hover:text-slate-100" data-filter="enterprise">Enterprise</button>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2 max-w-6xl mx-auto sm:px-0" id="projectsGrid">
                        <div class="project-card rounded-3xl p-4 border border-slate-700/50 bg-slate-800/50 hover:border-cyan-500/30 hover:bg-slate-800/70 transition-all duration-500 text-left flex flex-col h-full group" data-category="ai">
                            <h3 class="text-2xl font-bold mb-3 text-slate-100 group-hover:text-cyan-500 transition-colors">AI Voice Call Automation</h3>
                            <p class="text-base text-slate-400 mb-6 flex-grow leading-relaxed">Automated voice call system with natural language processing using Twilio, ElevenLabs, and Claude AI.</p>
                            <div class="flex flex-wrap gap-1 text-xs mb-4">
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">Laravel</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">Vue.js</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">Twilio</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">ElevenLabs</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">Claude AI</span>
                            </div>
                        </div>
                        <div class="project-card rounded-3xl p-4 border border-slate-700/50 bg-slate-800/50 hover:border-cyan-500/30 hover:bg-slate-800/70 transition-all duration-500 text-left flex flex-col h-full group" data-category="fintech">
                            <h3 class="text-2xl font-bold mb-3 text-slate-100 group-hover:text-cyan-500 transition-colors">Payment Processing Platform</h3>
                            <p class="text-base text-slate-400 mb-6 flex-grow leading-relaxed">Multi-gateway payment integration with fraud detection and automated reconciliation.</p>
                            <div class="flex flex-wrap gap-1 text-xs mb-4">
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">Laravel</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">PostgreSQL</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">Stripe</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">Mercury API</span>
                            </div>
                        </div>
                        <div class="project-card rounded-3xl p-4 border border-slate-700/50 bg-slate-800/50 hover:border-cyan-500/30 hover:bg-slate-800/70 transition-all duration-500 text-left flex flex-col h-full group" data-category="ai">
                            <h3 class="text-2xl font-bold mb-3 text-slate-100 group-hover:text-cyan-500 transition-colors">AI Product Scraping Engine</h3>
                            <p class="text-base text-slate-400 mb-6 flex-grow leading-relaxed">Intelligent web scraping using Claude AI with automated data extraction and categorization.</p>
                            <div class="flex flex-wrap gap-1 text-xs mb-4">
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">Python</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">Node.js</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">Claude AI</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">Puppeteer</span>
                            </div>
                        </div>
                        <div class="project-card rounded-3xl p-4 border border-slate-700/50 bg-slate-800/50 hover:border-cyan-500/30 hover:bg-slate-800/70 transition-all duration-500 text-left flex flex-col h-full group" data-category="healthcare">
                            <h3 class="text-2xl font-bold mb-3 text-slate-100 group-hover:text-cyan-500 transition-colors">Hospital Management System</h3>
                            <p class="text-base text-slate-400 mb-6 flex-grow leading-relaxed">Complete hospital workflow automation with online appointment booking and electronic medical records.</p>
                            <div class="flex flex-wrap gap-1 text-xs mb-4">
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">PHP</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">MySQL</span>
                                <span class="bg-slate-700/50 border border-slate-600/50 px-3 py-1 rounded-lg text-slate-300 font-semibold tracking-tight">SMS API</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-16 flex justify-center">
                        <a href="{{ url('/projects') }}" class="px-8 py-3.5 rounded-full border border-slate-700/50 text-slate-100 font-black text-base transition-all duration-300 hover:bg-slate-800/50 hover:border-slate-500 flex items-center gap-2 group">
                            View More Projects
                            <i class="fa-solid fa-arrow-up-right group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </section>

            {{-- Skills Section --}}
            <section id="skills" class="w-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-32 pb-24 min-h-screen relative z-10 scroll-mt-32">
                <div class="w-full max-w-6xl">
                    <div class="flex flex-col items-center mb-12 text-center">
                        <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 text-slate-100 tracking-tighter">My Stack</h2>
                        <p class="text-base md:text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto font-medium">A curated selection of technologies I use to build high-performance products.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        {{-- Frontend --}}
                        <div class="p-4 rounded-3xl border border-slate-700/50 bg-slate-800/50">
                            <div class="flex items-center gap-4 mb-6">
                                <h3 class="text-sm font-black text-cyan-500 uppercase tracking-widest pl-3 border-l-2 border-cyan-500">Frontend</h3>
                            </div>
                            <div class="grid grid-cols-4 gap-2">
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-vuejs text-3xl text-[#42b883]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">Vue.js</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-react text-3xl text-[#61dafb]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">React</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-js text-3xl text-[#f7df1e]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">TypeScript</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-tailwind text-3xl text-[#06b6d4]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">TailwindCSS</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-solid fa-bolt text-3xl text-[#646cff]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">Vite</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-bootstrap text-3xl text-[#7952b3]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">Bootstrap</span>
                                </div>
                            </div>
                        </div>
                        {{-- Backend --}}
                        <div class="p-4 rounded-3xl border border-slate-700/50 bg-slate-800/50">
                            <div class="flex items-center gap-4 mb-6">
                                <h3 class="text-sm font-black text-cyan-500 uppercase tracking-widest pl-3 border-l-2 border-cyan-500">Backend</h3>
                            </div>
                            <div class="grid grid-cols-4 gap-2">
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-laravel text-3xl text-[#ff2d20]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">Laravel</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-node text-3xl text-[#339933]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">Node.js</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-solid fa-code text-3xl text-[#000000]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">Express</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-php text-3xl text-[#777bb4]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">PHP</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-python text-3xl text-[#3776ab]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">Python</span>
                                </div>
                            </div>
                        </div>
                        {{-- Database --}}
                        <div class="p-4 rounded-3xl border border-slate-700/50 bg-slate-800/50">
                            <div class="flex items-center gap-4 mb-6">
                                <h3 class="text-sm font-black text-cyan-500 uppercase tracking-widest pl-3 border-l-2 border-cyan-500">Database</h3>
                            </div>
                            <div class="grid grid-cols-4 gap-2">
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-solid fa-database text-3xl text-[#4479a1]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">MySQL</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-solid fa-database text-3xl text-[#336791]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">PostgreSQL</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-solid fa-leaf text-3xl text-[#47a248]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">MongoDB</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-solid fa-bolt text-3xl text-[#dc382d]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">Redis</span>
                                </div>
                            </div>
                        </div>
                        {{-- AI & Tools --}}
                        <div class="p-4 rounded-3xl border border-slate-700/50 bg-slate-800/50">
                            <div class="flex items-center gap-4 mb-6">
                                <h3 class="text-sm font-black text-cyan-500 uppercase tracking-widest pl-3 border-l-2 border-cyan-500">AI &amp; Tools</h3>
                            </div>
                            <div class="grid grid-cols-4 gap-2">
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-solid fa-brain text-3xl text-[#7c3aed]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">Claude AI</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-solid fa-microchip text-3xl text-[#10a37f]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">OpenAI</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-docker text-3xl text-[#2496ed]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">Docker</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-aws text-3xl text-[#ff9900]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">AWS</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-brands fa-git-alt text-3xl text-[#f05032]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">Git</span>
                                </div>
                                <div class="group flex flex-col items-center gap-2 p-2 rounded-2xl border border-slate-700/50 bg-slate-800/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <i class="fa-solid fa-diagram-project text-3xl text-[#ff6d00]"></i>
                                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 group-hover:text-slate-100 transition-colors text-center uppercase tracking-tighter">n8n</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Contact Section --}}
            <section id="contact" class="w-full flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 pt-32 pb-48 min-h-screen relative z-10 scroll-mt-32">
                <div class="w-full max-w-6xl">
                    <div class="flex flex-col items-center mb-12 text-center">
                        <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 text-slate-100 tracking-tighter">Get In Touch</h2>
                        <p class="text-base md:text-lg lg:text-xl text-slate-500 max-w-2xl mx-auto font-medium">Let's build something great together. I'm always open to new opportunities and collaborations.</p>
                    </div>
                    <div class="grid lg:grid-cols-2 gap-8 items-start">
                        <div class="text-left space-y-4">
                            <h3 class="text-3xl md:text-5xl font-black leading-tight text-slate-100 tracking-tighter">Let's build <span class="text-cyan-500 text-glow">better</span> products.</h3>
                            <p class="text-lg md:text-2xl text-slate-400 font-medium max-w-md leading-relaxed">Open for interesting opportunities or just a meaningful chat.</p>
                            <div class="flex flex-wrap gap-2">
                                <a href="mailto:khurshidalam741@gmail.com" class="px-6 py-3.5 rounded-full bg-slate-100 text-slate-900 font-black text-base transition-all duration-300 hover:bg-slate-200 hover:-translate-y-1 flex items-center gap-2 group">
                                    Start a Conversation
                                </a>
                                <a href="{{ asset('resume.pdf') }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3.5 text-slate-100 border border-slate-700/50 rounded-full font-black text-base hover:bg-slate-800/50 hover:-translate-y-1 transition-all duration-300">
                                    Resume <i class="fa-solid fa-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 w-full">
                            <a href="https://github.com/jony741" target="_blank" rel="noopener noreferrer" class="group p-5 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:border-cyan-500/30 hover:bg-slate-800/70 transition-all duration-500 flex items-center gap-5 w-full">
                                <div class="p-3 rounded-2xl bg-slate-700/50 border border-slate-600/50 group-hover:scale-110 transition-transform duration-500">
                                    <i class="fa-brands fa-github text-slate-400 group-hover:text-cyan-500 transition-colors text-xl"></i>
                                </div>
                                <div class="flex-1 flex flex-col items-start text-left">
                                    <p class="font-black text-slate-500 uppercase tracking-widest text-[10px] mb-1">GitHub</p>
                                    <p class="text-base font-bold text-slate-100 group-hover:text-cyan-500 transition-colors truncate w-full">github.com/jony741</p>
                                </div>
                                <div class="text-slate-600 group-hover:text-slate-100 transition-all duration-300">
                                    <i class="fa-solid fa-arrow-up-right opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                </div>
                            </a>
                            <a href="https://www.linkedin.com/in/khurshid-alam-43b4131aa/" target="_blank" rel="noopener noreferrer" class="group p-5 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:border-cyan-500/30 hover:bg-slate-800/70 transition-all duration-500 flex items-center gap-5 w-full">
                                <div class="p-3 rounded-2xl bg-slate-700/50 border border-slate-600/50 group-hover:scale-110 transition-transform duration-500">
                                    <i class="fa-brands fa-linkedin text-slate-400 group-hover:text-cyan-500 transition-colors text-xl"></i>
                                </div>
                                <div class="flex-1 flex flex-col items-start text-left">
                                    <p class="font-black text-slate-500 uppercase tracking-widest text-[10px] mb-1">LinkedIn</p>
                                    <p class="text-base font-bold text-slate-100 group-hover:text-cyan-500 transition-colors truncate w-full">linkedin.com/in/khurshid-alam-43b4131aa</p>
                                </div>
                                <div class="text-slate-600 group-hover:text-slate-100 transition-all duration-300">
                                    <i class="fa-solid fa-arrow-up-right opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                </div>
                            </a>
                            <a href="mailto:khurshidalam741@gmail.com" class="group p-5 rounded-3xl border border-slate-700/50 bg-slate-800/50 hover:border-cyan-500/30 hover:bg-slate-800/70 transition-all duration-500 flex items-center gap-5 w-full">
                                <div class="p-3 rounded-2xl bg-slate-700/50 border border-slate-600/50 group-hover:scale-110 transition-transform duration-500">
                                    <i class="fa-regular fa-envelope text-slate-400 group-hover:text-cyan-500 transition-colors text-xl"></i>
                                </div>
                                <div class="flex-1 flex flex-col items-start text-left">
                                    <p class="font-black text-slate-500 uppercase tracking-widest text-[10px] mb-1">Email</p>
                                    <p class="text-base font-bold text-slate-100 group-hover:text-cyan-500 transition-colors truncate w-full">khurshidalam741@gmail.com</p>
                                </div>
                                <div class="text-slate-600 group-hover:text-slate-100 transition-all duration-300">
                                    <i class="fa-solid fa-arrow-up-right opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Bottom Navigation --}}
            <div class="fixed bottom-4 left-0 right-0 z-50 flex justify-center px-4 pointer-events-none">
                <nav class="bg-slate-900/80 backdrop-blur-xl border border-slate-700/50 rounded-2xl px-2 py-2 shadow-2xl pointer-events-auto">
                    <div class="flex items-center gap-1 sm:gap-2 px-1">
                        <a href="#home" class="nav-link relative flex items-center justify-center p-3 sm:p-4 rounded-2xl transition-all duration-300 group text-slate-500 hover:text-slate-300 hover:bg-slate-800/30" data-section="home">
                            <i class="fa-solid fa-house text-xl"></i>
                            <span class="absolute -top-12 left-1/2 -translate-x-1/2 px-3 py-1 bg-slate-800 text-slate-100 text-xs font-bold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none border border-slate-700/50 whitespace-nowrap">Home</span>
                        </a>
                        <a href="#about" class="nav-link relative flex items-center justify-center p-3 sm:p-4 rounded-2xl transition-all duration-300 group" data-section="about">
                            <i class="fa-solid fa-info-circle text-xl"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest ml-1 text-cyan-500">About</span>
                        </a>
                        <a href="#projects" class="nav-link relative flex items-center justify-center p-3 sm:p-4 rounded-2xl transition-all duration-300 group text-slate-500 hover:text-slate-300 hover:bg-slate-800/30" data-section="projects">
                            <i class="fa-solid fa-folder-open text-xl"></i>
                            <span class="absolute -top-12 left-1/2 -translate-x-1/2 px-3 py-1 bg-slate-800 text-slate-100 text-xs font-bold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none border border-slate-700/50 whitespace-nowrap">Projects</span>
                        </a>
                        <a href="#skills" class="nav-link relative flex items-center justify-center p-3 sm:p-4 rounded-2xl transition-all duration-300 group text-slate-500 hover:text-slate-300 hover:bg-slate-800/30" data-section="skills">
                            <i class="fa-solid fa-bullseye text-xl"></i>
                            <span class="absolute -top-12 left-1/2 -translate-x-1/2 px-3 py-1 bg-slate-800 text-slate-100 text-xs font-bold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none border border-slate-700/50 whitespace-nowrap">Skills</span>
                        </a>
                        <a href="#contact" class="nav-link relative flex items-center justify-center p-3 sm:p-4 rounded-2xl transition-all duration-300 group text-slate-500 hover:text-slate-300 hover:bg-slate-800/30" data-section="contact">
                            <i class="fa-regular fa-address-card text-xl"></i>
                            <span class="absolute -top-12 left-1/2 -translate-x-1/2 px-3 py-1 bg-slate-800 text-slate-100 text-xs font-bold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none border border-slate-700/50 whitespace-nowrap">Contact</span>
                        </a>
                    </div>
                </nav>
            </div>
        </main>
    </div>
</div>

{{-- Insight Modal (optional) --}}
<div id="insightModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm">
    <div class="bg-slate-800 rounded-2xl border border-slate-700 max-w-md w-full mx-4 p-6 relative">
        <button id="closeModal" class="absolute top-4 right-4 text-slate-400 hover:text-slate-100">
            <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h3 class="text-xl font-bold text-slate-100 mb-2">Role Insight</h3>
        <p id="modalContent" class="text-slate-400 leading-relaxed"></p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                const target = document.querySelector(targetId);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Active navigation highlight
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

        // Project filtering
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
                        card.style.opacity = '1';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Insight modal functionality
        const modal = document.getElementById('insightModal');
        const modalContent = document.getElementById('modalContent');
        const closeModal = document.getElementById('closeModal');

        document.querySelectorAll('.insight-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const insight = btn.getAttribute('data-insight');
                modalContent.textContent = insight;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        });

        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });

        // Terminal button (mock)
        const toggleTerminal = document.getElementById('toggleTerminal');
        if (toggleTerminal) {
            toggleTerminal.addEventListener('click', () => {
                alert('Terminal feature coming soon! This would open an interactive terminal in a real implementation.');
            });
        }
    });
</script>
</body>
</html>