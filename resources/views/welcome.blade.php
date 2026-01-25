<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YASAWI - Рухани мұра мен білім порталы</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:700" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #1B5E20;
            --primary-light: #2E7D32;
            --primary-dark: #0D3F12;
            --accent: #FFB300;
            --accent-light: #FFC947;
            --bg-light: #FAFAF9;
            --bg-white: #FFFFFF;
            --text-dark: #1A1A1A;
            --text-gray: #6B7280;
            --border: #E5E7EB;
            --gradient-1: linear-gradient(135deg, #1B5E20 0%, #2E7D32 100%);
            --gradient-2: linear-gradient(135deg, #FFB300 0%, #FFC947 100%);
        }

        [data-theme="dark"] {
            --primary: #4CAF50;
            --primary-light: #66BB6A;
            --primary-dark: #388E3C;
            --accent: #FFD54F;
            --accent-light: #FFE082;
            --bg-light: #0F0F0F;
            --bg-white: #1A1A1A;
            --text-dark: #F5F5F5;
            --text-gray: #9CA3AF;
            --border: #2D2D2D;
            --gradient-1: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
            --gradient-2: linear-gradient(135deg, #FFB300 0%, #FFD54F 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: var(--bg-white);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .header-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn {
            padding: 0.65rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--gradient-1);
            color: white;
            box-shadow: 0 4px 12px rgba(27, 94, 32, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(27, 94, 32, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* Hero Section */
        .hero {
            margin-top: 80px;
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-pattern {
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            opacity: 0.05;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0l30 30-30 30L0 30 30 0zm0 10L10 30l20 20 20-20-20-20z' fill='%231B5E20' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .hero-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 4rem 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-text .subtitle {
            font-size: 1.25rem;
            color: var(--text-gray);
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .hero-image {
            position: relative;
            height: 500px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(27, 94, 32, 0.2);
            border: 3px solid var(--accent);
        }

        .hero-image img {
            transition: transform 0.3s ease;
        }

        .hero-image:hover img {
            transform: scale(1.05);
        }





        /* Features Section */
        .features {
            padding: 6rem 2rem;
            background: var(--bg-white);
        }

        .features-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .section-title p {
            font-size: 1.1rem;
            color: var(--text-gray);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            padding: 2.5rem;
            background: var(--bg-light);
            border-radius: 16px;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 0;
            background: var(--gradient-1);
            transition: height 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-card:hover::before {
            height: 100%;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: var(--gradient-1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .feature-card p {
            color: var(--text-gray);
            line-height: 1.7;
        }

        /* Stats Section */
        .stats {
            padding: 4rem 2rem;
            background: var(--gradient-1);
            color: white;
        }

        .stats-container {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            text-align: center;
        }

        .stat-item h3 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-item p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Footer */
        .footer {
            padding: 3rem 2rem;
            background: var(--bg-white);
            border-top: 1px solid var(--border);
        }

        .footer-content {
            max-width: 1280px;
            margin: 0 auto;
            text-align: center;
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .footer-text {
            color: var(--text-gray);
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .footer-link {
            color: var(--text-gray);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: var(--primary);
        }

        .copyright {
            color: var(--text-gray);
            font-size: 0.9rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
        }

        /* Theme Toggle */
        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--bg-light);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .theme-toggle:hover {
            transform: rotate(15deg);
            background: var(--primary);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 2rem 1rem;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .hero-image {
                height: 300px;
            }

            .nav-links {
                display: none;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .hero-image {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">YASAWI</div>
            <nav class="nav-links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Басты бет</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Кіру</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Тіркелу</a>
                        @endif
                    @endauth
                @endif
                <button class="theme-toggle" onclick="toggleTheme()">🌙</button>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-pattern"></div>
        <div class="hero-content animate-fade-in">
            <div class="hero-text">
                <h1>Рухани мұра мен білім порталы</h1>
                <p class="subtitle">
                    Қожа Ахмет Ясауидің өмірі, рухани мұрасы және ілімі туралы жүйеленген
                    ғылыми-танымдық ақпаратты мобильді форматта зерттеңіз
                </p>
                <div class="hero-buttons">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">Платформаға өту</a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Бастау</a>
                            @endif
                            <a href="{{ route('login') }}" class="btn btn-outline">Кіру</a>
                        @endauth
                    @endif
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/yasawi-portrait.png') }}" alt="Қожа Ахмет Ясауи"
                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="features-container">
            <div class="section-title">
                <h2>Платформаның мүмкіндіктері</h2>
                <p>Ұлттық рухани құндылықтарды цифрлық ортада насихаттау</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📚</div>
                    <h3>Білім беру</h3>
                    <p>Қожа Ахмет Ясауидің өмірі мен шығармашылығы туралы толық ақпарат, тарихи деректер және ғылыми
                        зерттеулер</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🕌</div>
                    <h3>Рухани мұра</h3>
                    <p>Ясауи ілімінің негіздері, философиялық көзқарастары және қазіргі заманға әсері туралы терең
                        талдау</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎓</div>
                    <h3>Ясауитану</h3>
                    <p>Ясауитану бағыты бойынша жүйеленген ғылыми материалдар, зерттеулер және академиялық еңбектер</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Мобильді қолжетімділік</h3>
                    <p>Кез келген жерден, кез келген уақытта білім алуға мүмкіндік беретін заманауи мобильді платформа
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🌍</div>
                    <h3>Мәдени ағарту</h3>
                    <p>Қазақ халқының рухани мұрасын әлемге таныту және ұлттық құндылықтарды насихаттау</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💡</div>
                    <h3>Интерактивті оқыту</h3>
                    <p>Заманауи технологиялар арқылы білім алуды қызықты және тиімді ету</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item">
                <h3>800+</h3>
                <p>Жылдар тарихы</p>
            </div>
            <div class="stat-item">
                <h3>1000+</h3>
                <p>Материалдар</p>
            </div>
            <div class="stat-item">
                <h3>50+</h3>
                <p>Зерттеулер</p>
            </div>
            <div class="stat-item">
                <h3>24/7</h3>
                <p>Қолжетімділік</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">YASAWI</div>
            <p class="footer-text">
                Білім беру және мәдени-ағартушылық мобильді қосымша.
                Ұлттық рухани құндылықтарды цифрлық ортада насихаттау.
            </p>
            <div class="footer-links">
                <a href="#" class="footer-link">Біз туралы</a>
                <a href="#" class="footer-link">Байланыс</a>
                <a href="#" class="footer-link">Құпиялылық</a>
                <a href="#" class="footer-link">Қолдау</a>
            </div>
            <div class="copyright">
                &copy; {{ date('Y') }} YASAWI. Барлық құқықтар қорғалған.
            </div>
        </div>
    </footer>

    <script>
        // Theme Toggle
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            // Update icon
            const toggle = document.querySelector('.theme-toggle');
            toggle.textContent = newTheme === 'dark' ? '☀️' : '🌙';
        }

        // Load saved theme
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            const toggle = document.querySelector('.theme-toggle');
            toggle.textContent = savedTheme === 'dark' ? '☀️' : '🌙';
        });

        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .stat-item').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>