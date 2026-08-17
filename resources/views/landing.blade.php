<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-image: url('{{ asset('images/lgn.png') }}');
        }
        
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            background-image: var(--bg-image);
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
            background-attachment: fixed;
            overflow-x: hidden;
        }
        .hero {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #fff;
            padding: 5rem 0 4rem;
            text-align: center;
            animation: fadeInDown 1s ease-out;
        }
        .hero-logo {
            max-height: 140px;
            width: auto;
            margin-bottom: 1.25rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.95);
            padding: 0.75rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            animation: zoomIn 0.8s ease-out 0.2s both;
        }
        .hero h1 {
            font-weight: 700;
            margin-bottom: 0.75rem;
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }
        .hero p {
            opacity: 0.9;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 1.5rem;
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }
        .hero .btn-cta, .hero .btn-cta-outline {
            animation: fadeInUp 0.8s ease-out 0.8s both;
        }
        .features {
            padding: 3rem 0;
        }
        .feature-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            height: 100%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: none;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            transform: translateY(30px);
        }
        .feature-card.visible {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.12);
        }
        .feature-card i {
            font-size: 2.5rem;
            color: #2a5298;
            margin-bottom: 0.75rem;
            transition: transform 0.3s ease;
        }
        .feature-card:hover i {
            transform: scale(1.15);
        }
        .feature-card h5 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .feature-card p {
            color: #666;
            margin: 0;
            font-size: 0.95rem;
        }
        .cta-section {
            background: #fff;
            padding: 3rem 0;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .cta-section.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .btn-cta {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
            display: inline-block;
            margin: 0.25rem;
            transition: transform 0.2s ease, opacity 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 12px rgba(30, 60, 114, 0.3);
        }
        .btn-cta:hover {
            opacity: 0.95;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 60, 114, 0.4);
        }
        .btn-cta-outline {
            background: transparent;
            border: 2px solid #fff;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
            display: inline-block;
            margin: 0.25rem;
            transition: transform 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-cta-outline:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255,255,255,0.15);
        }
        footer {
            background: #1e3c72;
            color: rgba(255,255,255,0.8);
            text-align: center;
            padding: 1rem 0;
            font-size: 0.9rem;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.85); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="container">
            <img src="{{ asset('images/uc-library-logo.png') }}" alt="UC Banilad Library" class="hero-logo">
            <h1>UCB-Library Management System</h1>
            <p>Your gateway to organized knowledge. Browse books, manage borrowals, and explore academic resources with ease.</p>
            <div>
                @if(Auth::check())
                    <a href="{{ route('dashboard') }}" class="btn btn-cta">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-cta">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-cta-outline">Create Account</a>
                @endif
            </div>
        </div>
    </div>

    <div class="features">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card" data-animate>
                        <i class="bi bi-journal-arrow-down"></i>
                        <h5>Easy Borrowing</h5>
                        <p>Reserve and borrow books online with just a few clicks.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card" data-animate>
                        <i class="bi bi-search"></i>
                        <h5>Smart Search</h5>
                        <p>Find books by title, author, or category instantly.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card" data-animate>
                        <i class="bi bi-calendar-check"></i>
                        <h5>Reservations</h5>
                        <p>Reserve unavailable books and get notified when ready.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card" data-animate>
                        <i class="bi bi-people"></i>
                        <h5>Member Access</h5>
                        <p>Members can track borrowals, fines, and reservations.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card" data-animate>
                        <i class="bi bi-file-earmark-bar-graph"></i>
                        <h5>Reports</h5>
                        <p>Admins can generate insightful library reports.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cta-section" id="cta-section">
        <div class="container">
            <h3 class="mb-3">Ready to get started?</h3>
            <p class="text-muted mb-3">Join our library community today.</p>
            @if(Auth::check())
                <a href="{{ route('dashboard') }}" class="btn btn-cta">Go to Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-cta">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-cta" style="background:#fff;color:#2a5298;border:2px solid #2a5298;">Register</a>
            @endif
        </div>
    </div>

    <footer>
        <div class="container">
            Library Management System
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('[data-animate]');
            const ctaSection = document.getElementById('cta-section');

            function revealOnScroll() {
                const windowHeight = window.innerHeight;
                const elementVisible = 120;

                animatedElements.forEach((el, index) => {
                    const elementTop = el.getBoundingClientRect().top;
                    if (elementTop < windowHeight - elementVisible) {
                        setTimeout(() => {
                            el.classList.add('visible');
                        }, index * 100);
                    }
                });

                if (ctaSection) {
                    const ctaTop = ctaSection.getBoundingClientRect().top;
                    if (ctaTop < windowHeight - elementVisible) {
                        ctaSection.classList.add('visible');
                    }
                }
            }

            window.addEventListener('scroll', revealOnScroll);
            revealOnScroll();
        });
    </script>
</body>
</html>
