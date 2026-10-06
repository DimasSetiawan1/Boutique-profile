@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['company_name'] ?? 'Boutique Design Indonesia' }} — Creative Design Agency</title>
    <!-- Open Graph / WhatsApp / Telegram Link Preview -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:title" content="{{ $settings['company_name'] ?? 'Boutique Design Indonesia' }} — Creative Design Agency">
    <meta property="og:description" content="{{ $settings['slogan_sub_en'] ?? 'Your trusted creative design partner in Indonesia.' }}">
    <meta property="og:image" content="{{ asset('uploads/logo.png') }}">
    <meta property="og:site_name" content="{{ $settings['company_name'] ?? 'Boutique Design Indonesia' }}">
    <meta property="og:locale" content="id_ID">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $settings['company_name'] ?? 'Boutique Design Indonesia' }} — Creative Design Agency">
    <meta name="twitter:description" content="{{ $settings['slogan_sub_en'] ?? 'Your trusted creative design partner in Indonesia.' }}">
    <meta name="twitter:image" content="{{ asset('uploads/logo.png') }}">
    <!-- SEO -->
    <meta name="description" content="{{ $settings['slogan_sub_en'] ?? 'Your trusted creative design partner in Indonesia.' }}">
    <meta name="author" content="{{ $settings['company_name'] ?? 'Boutique Design Indonesia' }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-color: #e0e6e9;
            --text-color: #2b353a;
            --primary-accent: #c62828; /* Premium Red */
            --secondary-accent: #f9a825; /* Lightbulb Yellow */
            --white: #ffffff;
            --shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --font-main: 'Outfit', sans-serif;
            --font-cursive: 'Great Vibes', cursive;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 85px;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-color);
            color: var(--text-color);
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-color);
        }
        ::-webkit-scrollbar-thumb {
            background: #b0bec5;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #90a4ae;
        }

        /* Navbar Style */
        .navbar {
            background: rgba(224, 230, 233, 0.85);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            transition: var(--transition);
        }
        .navbar-brand .logo-sig {
            font-family: var(--font-cursive);
            font-size: 2.2rem;
            color: var(--primary-accent);
            line-height: 1;
        }
        .navbar-brand .logo-sub {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--text-color);
            font-weight: 600;
            display: block;
            margin-top: -5px;
        }
        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            font-size: 0.95rem;
            margin: 0 10px;
            transition: var(--transition);
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: var(--primary-accent);
            transition: var(--transition);
            transform: translateX(-50%);
        }
        .nav-link:hover::after, .nav-link.active::after {
            width: 80%;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(235, 240, 243, 0.98);
                backdrop-filter: blur(18px);
                -webkit-backdrop-filter: blur(18px);
                border-radius: 18px;
                padding: 20px 16px;
                margin-top: 14px;
                box-shadow: 0 14px 35px rgba(0, 0, 0, 0.12);
                border: 1px solid rgba(255, 255, 255, 0.7);
            }
            .navbar-nav .nav-item {
                width: 100%;
                text-align: center;
                margin: 4px 0;
            }
            .navbar-nav .nav-link {
                display: inline-block;
                padding: 10px 18px;
                font-size: 1.05rem;
                font-weight: 600;
            }
            .navbar-nav .dropdown-menu {
                text-align: center;
                background: rgba(255, 255, 255, 0.95);
                border-radius: 12px;
                margin-top: 8px !important;
            }
        }

        /* Hero Section */
        .hero {
            padding: 160px 0 100px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            background-color: #f7f4ee;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            overflow: hidden;
        }
        .hero-video-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        .hero-bg-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            object-position: center center;
        }
        .hero-bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        .hero-bg-overlay.hero-overlay-light {
            background: linear-gradient(90deg, 
                rgba(247, 244, 238, calc(var(--overlay-op, 0.82) + 0.1)) 0%, 
                rgba(247, 244, 238, var(--overlay-op, 0.82)) 40%, 
                rgba(247, 244, 238, calc(var(--overlay-op, 0.82) * 0.42)) 70%, 
                rgba(247, 244, 238, calc(var(--overlay-op, 0.82) * 0.15)) 100%);
        }
        .hero-bg-overlay.hero-overlay-dark {
            background: linear-gradient(90deg, 
                rgba(15, 23, 42, calc(var(--overlay-op, 0.82) + 0.12)) 0%, 
                rgba(15, 23, 42, var(--overlay-op, 0.82)) 40%, 
                rgba(15, 23, 42, calc(var(--overlay-op, 0.82) * 0.45)) 70%, 
                rgba(15, 23, 42, calc(var(--overlay-op, 0.82) * 0.18)) 100%);
        }
        .hero.hero-theme-dark .hero-title-main {
            color: #ffffff;
        }
        .hero.hero-theme-dark .hero-slogan {
            color: #cbd5e1;
            border-left-color: var(--secondary-accent);
        }
        .hero.hero-theme-dark .btn-outline-dark {
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.75);
        }
        .hero.hero-theme-dark .btn-outline-dark:hover {
            background-color: #ffffff;
            color: #0f172a;
        }
        .hero > .container {
            position: relative;
            z-index: 2;
        }
        @media (max-width: 991.98px) {
            .hero-bg-overlay.hero-overlay-light {
                background: rgba(247, 244, 238, var(--overlay-op, 0.88));
            }
            .hero-bg-overlay.hero-overlay-dark {
                background: rgba(15, 23, 42, var(--overlay-op, 0.88));
            }
        }
        .hero-title-sig {
           font-family: var(--font-main);
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
            color: var(--primary-accent);
            margin-bottom: 10px;
                }
        .hero-title-main {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
            margin-bottom: 25px;
        }
        .hero-title-main span.highlight {
            color: var(--primary-accent);
            font-weight: 900;
        }
        .hero-slogan {
            font-size: 1.3rem;
            font-weight: 300;
            line-height: 1.6;
            margin-bottom: 40px;
            color: #4a5a63;
            border-left: 3px solid var(--primary-accent);
            padding-left: 20px;
        }
        
        /* Interactive SVG Lightbulb with Floating Animation & Breathing Light */
        .svg-bulb-container {
            position: relative;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bulb-ambient-aura {
            position: absolute;
            top: 40%;
            left: 50%;
            width: 320px;
            height: 320px;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(255, 235, 59, 0.55) 0%, rgba(255, 193, 7, 0.3) 40%, rgba(255, 152, 0, 0.1) 65%, transparent 75%);
            border-radius: 50%;
            filter: blur(30px);
            pointer-events: none;
            z-index: 0;
            animation: bulbAuraPulse 3.6s ease-in-out infinite;
        }

        .svg-bulb {
            width: 100%;
            max-width: 390px;
            height: auto;
            cursor: pointer;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 15px 35px rgba(0,0,0,0.1));
            animation: bulbFloatMotion 5s ease-in-out infinite;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform-origin: center center;
        }

        .svg-bulb:hover {
            transform: scale(1.06) rotate(2deg);
        }

        /* Inner glowing circle (terang & redup) */
        .bulb-glow {
            fill: #ffeb3b;
            transform-origin: 250px 220px;
            animation: bulbLightPulse 3.6s ease-in-out infinite;
        }

        /* Origami facets inside bulb */
        .bulb-facets {
            animation: bulbFacetsGlow 3.6s ease-in-out infinite;
        }

        /* Sparks / rays radiating from the bulb */
        .bulb-sparks path {
            animation: bulbSparksPulse 3.6s ease-in-out infinite;
        }

        /* Keyframes: Animasi Bergerak Melayang (Floating Motion) */
        @keyframes bulbFloatMotion {
            0% {
                transform: translateY(0px) rotate(0deg);
            }
            25% {
                transform: translateY(-14px) rotate(1.5deg);
            }
            50% {
                transform: translateY(-24px) rotate(0deg);
            }
            75% {
                transform: translateY(-10px) rotate(-1.5deg);
            }
            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        /* Keyframes: Efek Lampu Terang dan Redup (Bulb Light Pulse) */
        @keyframes bulbLightPulse {
            0%, 100% {
                opacity: 0.25;
                transform: scale(0.96);
                filter: drop-shadow(0 0 10px rgba(255, 235, 59, 0.3));
            }
            50% {
                opacity: 0.9;
                transform: scale(1.1);
                filter: drop-shadow(0 0 35px #ffeb3b) drop-shadow(0 0 65px rgba(255, 193, 7, 0.7));
            }
        }

        /* Keyframes: Aura Cahaya di Belakang Lampu */
        @keyframes bulbAuraPulse {
            0%, 100% {
                opacity: 0.25;
                transform: translate(-50%, -50%) scale(0.85);
            }
            50% {
                opacity: 0.95;
                transform: translate(-50%, -50%) scale(1.2);
            }
        }

        /* Keyframes: Kecerahan Kertas Origami di dalam Bohlam */
        @keyframes bulbFacetsGlow {
            0%, 100% {
                filter: brightness(0.92);
            }
            50% {
                filter: brightness(1.25) drop-shadow(0 0 12px rgba(255, 215, 0, 0.65));
            }
        }

        /* Keyframes: Pancaran Garis Ide di Sekitar Lampu */
        @keyframes bulbSparksPulse {
            0%, 100% {
                opacity: 0.45;
                stroke: #78909c;
                stroke-width: 4.5;
            }
            50% {
                opacity: 1;
                stroke: #f57f17;
                stroke-width: 6;
                filter: drop-shadow(0 0 6px #ffeb3b);
            }
        }

        /* Saat kursor diarahkan (hover), lampu menyala maksimal */
        .svg-bulb:hover .bulb-glow {
            animation-play-state: paused;
            opacity: 1;
            transform: scale(1.15);
            filter: drop-shadow(0 0 45px #ffeb3b) drop-shadow(0 0 85px rgba(255, 193, 7, 0.9));
        }
        .svg-bulb:hover .bulb-facets {
            animation-play-state: paused;
            filter: brightness(1.3) drop-shadow(0 0 16px rgba(255, 215, 0, 0.85));
        }
        .svg-bulb:hover .bulb-sparks path {
            animation-play-state: paused;
            opacity: 1;
            stroke: #e65100;
            stroke-width: 6.5;
            filter: drop-shadow(0 0 8px #ffc107);
        }

        /* Sections General */
        section {
            padding: 100px 0;
        }
        .section-title-wrapper {
            margin-bottom: 60px;
            text-align: center;
        }
        .section-title {
            font-size: 2.8rem;
            font-weight: 800;
            display: inline-block;
            position: relative;
            margin-bottom: 15px;
        }
        /* Section Title Wiggle & Glow Animations */
        @keyframes firstLetterWiggle {
            0%, 100% {
                transform: rotate(0deg) scale(1) translateY(0);
            }
            20% {
                transform: rotate(-12deg) scale(1.2) translateY(-4px);
            }
            40% {
                transform: rotate(12deg) scale(1.2) translateY(-2px);
            }
            60% {
                transform: rotate(-7deg) scale(1.1) translateY(-3px);
            }
            80% {
                transform: rotate(7deg) scale(1.1) translateY(-1px);
            }
        }

        @keyframes titleUnderlinePulse {
            0%, 100% {
                width: 60%;
                left: 20%;
                opacity: 0.8;
                box-shadow: 0 0 0px rgba(198, 40, 40, 0);
            }
            50% {
                width: 82%;
                left: 9%;
                opacity: 1;
                box-shadow: 0 2px 12px rgba(198, 40, 40, 0.5);
            }
        }

        @keyframes subtitleFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-4px);
            }
        }

        .section-title span.first-letter {
            color: var(--primary-accent);
            font-family: var(--font-main);
            font-weight: 900;
            font-style: italic;
            display: inline-block;
            transform-origin: center center;
            animation: firstLetterWiggle 3.2s cubic-bezier(0.25, 1.2, 0.4, 1) infinite;
            will-change: transform;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 20%;
            width: 60%;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-accent), transparent);
            animation: titleUnderlinePulse 2.8s ease-in-out infinite;
        }
        .section-subtitle {
            color: #5c6bc0;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-block;
            animation: subtitleFloat 4s ease-in-out infinite;
        }

        /* Glass Cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.45);
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        .glass-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        }

        /* About Section (What Are We / Tentang Kami) Background & Layout */
        .about-section {
            position: relative;
            background-color: #f8fafc;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            overflow: hidden;
            padding: 100px 0;
        }
        .about-video-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        .about-bg-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            object-position: center center;
        }
        .about-bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        .about-bg-overlay.about-overlay-light {
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, calc(var(--about-overlay-op, 0.88) + 0.04)) 0%, 
                rgba(248, 250, 252, var(--about-overlay-op, 0.88)) 50%, 
                rgba(255, 255, 255, calc(var(--about-overlay-op, 0.88) + 0.02)) 100%);
        }
        .about-bg-overlay.about-overlay-dark {
            background: linear-gradient(135deg, 
                rgba(15, 23, 42, calc(var(--about-overlay-op, 0.88) + 0.05)) 0%, 
                rgba(15, 23, 42, var(--about-overlay-op, 0.88)) 50%, 
                rgba(15, 23, 42, calc(var(--about-overlay-op, 0.88) + 0.08)) 100%);
        }
        .about-section.about-theme-dark .section-title {
            color: #ffffff;
        }
        .about-section.about-theme-dark .about-text {
            color: #cbd5e1;
        }
        .about-section.about-theme-dark .about-text .lead {
            color: #ffffff !important;
        }
        .about-section.about-theme-dark .text-secondary {
            color: #94a3b8 !important;
        }
        .about-glass-panel {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }
        .about-theme-dark .about-glass-panel {
            background: rgba(30, 41, 59, 0.82);
            border-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        .about-text {
            font-size: 1.15rem;
            line-height: 1.8;
            color: #3f4d54;
        }
        .svg-brainstorm-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Floating Up & Down Animation specifically for the 3 Circle Nodes (STRATEGI, IDE, INOVASI) */
        @keyframes circleFloatAnimation {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-12px);
            }
        }

        .brainstorm-circle-item {
            transition: transform 0.3s ease, filter 0.3s ease;
            will-change: transform;
            cursor: pointer;
        }

        .node-strategi .brainstorm-circle-item {
            transform-origin: 120px 150px;
            animation: circleFloatAnimation 3.2s ease-in-out infinite;
        }

        .node-ide .brainstorm-circle-item {
            transform-origin: 380px 150px;
            animation: circleFloatAnimation 3.2s ease-in-out 0.7s infinite;
        }

        .node-inovasi .brainstorm-circle-item {
            transform-origin: 250px 390px;
            animation: circleFloatAnimation 3.2s ease-in-out 1.4s infinite;
        }

        .brainstorm-circle-item:hover {
            filter: drop-shadow(0 6px 16px rgba(198, 40, 40, 0.4));
        }

        /* Philosophy Tag Cloud */
        .philosophy-word-cloud {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 10px;
            margin-top: 20px;
        }
        .philosophy-tag {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.08);
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 600;
            color: #455a64;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
            user-select: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .philosophy-tag:hover {
            background: #ffffff;
            color: var(--primary-accent);
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 6px 15px rgba(198, 40, 40, 0.15);
            border-color: rgba(198, 40, 40, 0.3);
        }
        .philosophy-tag.active {
            background: var(--primary-accent) !important;
            color: var(--white) !important;
            border-color: var(--primary-accent) !important;
            transform: translateY(-2px) scale(1.06);
            box-shadow: 0 6px 20px rgba(198, 40, 40, 0.35);
        }
        .philosophy-tag.highlighted {
            background: #2b353a;
            color: var(--white);
            border-color: #2b353a;
        }
        .philosophy-tag.highlighted:hover {
            background: #1e2528;
            color: var(--white);
            border-color: #1e2528;
        }
        .philosophy-insight-card {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(198, 40, 40, 0.15);
            border-left: 4px solid var(--primary-accent);
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }
        .philosophy-slider-viewport {
            width: 100%;
            overflow: hidden;
            position: relative;
        }
        .philosophy-slider-track {
            display: flex;
            width: 100%;
            transition: transform 0.65s cubic-bezier(0.25, 1, 0.5, 1);
            will-change: transform;
        }
        .philosophy-slide {
            min-width: 100%;
            width: 100%;
            flex-shrink: 0;
            box-sizing: border-box;
        }
        .philosophy-insight-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(198, 40, 40, 0.1);
            color: var(--primary-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }
        .philosophy-progress-track {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: rgba(0, 0, 0, 0.05);
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
            overflow: hidden;
        }
        .philosophy-progress-bar {
            height: 100%;
            width: 0%;
            background: var(--primary-accent);
            border-radius: 3px;
            transition: width 0.05s linear;
        }
        .philo-nav-btn {
            background: #ffffff;
            color: #64748b;
            border-color: #e2e8f0;
            transition: all 0.2s ease;
        }
        .philo-nav-btn:hover {
            background: var(--primary-accent);
            color: #ffffff;
            border-color: var(--primary-accent) !important;
            transform: scale(1.08);
        }
        .svg-mind-tag {
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .svg-mind-tag:hover {
            fill: #c62828 !important;
            font-weight: 800 !important;
            filter: drop-shadow(0 2px 5px rgba(198, 40, 40, 0.3));
        }

        /* Services Section (Layanan) */
        .services-section {
            position: relative;
            background-color: #f1f5f9;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            overflow: hidden;
            padding: 100px 0;
        }
        .services-video-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        .services-bg-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            object-position: center center;
        }
        .services-bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        .services-bg-overlay.services-overlay-light {
            background: linear-gradient(180deg, 
                rgba(248, 250, 252, calc(var(--services-overlay-op, 0.85) + 0.05)) 0%, 
                rgba(255, 255, 255, var(--services-overlay-op, 0.85)) 35%, 
                rgba(255, 255, 255, var(--services-overlay-op, 0.85)) 70%, 
                rgba(248, 250, 252, calc(var(--services-overlay-op, 0.85) + 0.07)) 100%);
        }
        .services-bg-overlay.services-overlay-dark {
            background: linear-gradient(180deg, 
                rgba(15, 23, 42, calc(var(--services-overlay-op, 0.85) + 0.08)) 0%, 
                rgba(15, 23, 42, var(--services-overlay-op, 0.85)) 35%, 
                rgba(15, 23, 42, var(--services-overlay-op, 0.85)) 70%, 
                rgba(15, 23, 42, calc(var(--services-overlay-op, 0.85) + 0.10)) 100%);
        }
        .services-section.services-theme-dark .section-title {
            color: #ffffff;
        }
        .services-section.services-theme-dark .section-subtitle {
            color: #f59e0b;
        }
        .services-section.services-theme-dark .glass-card {
            background: rgba(30, 41, 59, 0.82);
            border-color: rgba(255, 255, 255, 0.12);
            color: #f1f5f9;
        }
        .services-section.services-theme-dark .glass-card:hover {
            background: rgba(30, 41, 59, 0.95);
        }
        .services-section.services-theme-dark .service-title {
            color: #ffffff;
        }
        .services-section.services-theme-dark .service-description {
            color: #cbd5e1;
        }
        .services-section.services-theme-dark .service-diagram-card {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(255, 255, 255, 0.15);
            color: #f1f5f9;
        }
        .services-section.services-theme-dark .service-diagram-card h5 {
            color: #cbd5e1 !important;
        }
        .services-section.services-theme-dark .glass-card h4 {
            color: #ffffff !important;
        }
        .services-section.services-theme-dark .glass-card p {
            color: #cbd5e1 !important;
        }
        .services-section > .container {
            position: relative;
            z-index: 2;
        }
        .services-section .glass-card {
            background: rgba(255, 255, 255, 0.84);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.85);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }
        .services-section .glass-card:hover {
            background: rgba(255, 255, 255, 0.97);
            transform: translateY(-6px);
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.12);
        }
        .services-section .service-diagram-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.85);
        }

        /* Services Cards */
        .service-icon {
            font-size: 2.5rem;
            color: var(--primary-accent);
            margin-bottom: 20px;
            display: inline-block;
            transition: var(--transition);
        }
        .glass-card:hover .service-icon {
            transform: scale(1.15) rotate(5deg);
        }
        .service-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .service-description {
            font-size: 0.95rem;
            color: #546e7a;
            line-height: 1.6;
        }

        /* Portfolio Grid */
        .portfolio-filter-btn {
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 8px 20px;
            border-radius: 30px;
            color: var(--text-color);
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
            margin: 5px;
        }
        .portfolio-filter-btn.active, .portfolio-filter-btn:hover {
            background: var(--primary-accent);
            color: var(--white);
            border-color: var(--primary-accent);
            box-shadow: 0 5px 15px rgba(198, 40, 40, 0.15);
        }

        /* ================= PORTFOLIO ONE-BY-ONE STAGGERED ANIMATION (BOUTIQUE LOGO STYLE) ================= */
        .portfolio-animate-item {
            opacity: 0;
            transform: translateY(35px) scale(0.92);
            transition: opacity 0.65s cubic-bezier(0.25, 1.2, 0.4, 1), transform 0.65s cubic-bezier(0.25, 1.2, 0.4, 1);
            will-change: opacity, transform;
        }

        .portfolio-animate-item.animate-in,
        .portfolio-animate-item.revealed {
            opacity: 1 !important;
            transform: translateY(0) scale(1) !important;
        }

        /* Di device HP / layar mobile, pastikan portofolio selalu tampil 100% tanpa risiko tersangkut animasi */
        @media (max-width: 991.98px) {
            .portfolio-animate-item {
                opacity: 1 !important;
                transform: none !important;
            }
        }

        /* ================= PORTFOLIO IMAGE ANIMATIONS (BOUTIQUE LOGO STYLE) ================= */
        @keyframes portfolioImgFloatOdd {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-5px) scale(1.012);
            }
        }

        @keyframes portfolioImgFloatEven {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-7px) scale(1.018);
            }
        }

        @keyframes portfolioShineSweep {
            0% {
                transform: translateX(-150%) skewX(-25deg);
            }
            35%, 100% {
                transform: translateX(180%) skewX(-25deg);
            }
        }

        .portfolio-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.4s cubic-bezier(0.25, 1.2, 0.4, 1), box-shadow 0.4s ease, border-color 0.3s ease;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            will-change: transform, box-shadow;
        }

        .portfolio-card:hover {
            transform: translateY(-8px) scale(1.015);
            box-shadow: 0 22px 45px rgba(0, 0, 0, 0.14);
            border-color: rgba(198, 40, 40, 0.2);
        }

        .portfolio-img-wrapper {
            position: relative;
            overflow: hidden;
            background: #b0bec5;
            aspect-ratio: 4/3;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .portfolio-img-wrapper::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 60%;
            height: 100%;
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.35) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: translateX(-150%) skewX(-25deg);
            pointer-events: none;
            z-index: 3;
        }

        .portfolio-card:hover .portfolio-img-wrapper::after {
            animation: portfolioShineSweep 1.2s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .portfolio-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.2, 0.8, 0.2, 1), filter 0.3s ease;
            transform: translate3d(0, 0, 0);
        }

        .portfolio-card:hover .portfolio-img {
            transform: scale(1.07);
        }

        .portfolio-card.has-lightbox {
            cursor: pointer;
        }

        .portfolio-img-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(2px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 4;
        }

        .portfolio-card:hover .portfolio-img-overlay {
            opacity: 1;
        }
        .portfolio-zoom-btn {
            background: rgba(255, 255, 255, 0.95);
            color: #1e293b;
            padding: 9px 20px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            transform: translateY(12px) scale(0.95);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .portfolio-card:hover .portfolio-zoom-btn {
            transform: translateY(0) scale(1);
        }
        .portfolio-card-zoom-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(198, 40, 40, 0.08);
            color: var(--primary-accent);
            transition: all 0.25s ease;
            flex-shrink: 0;
        }
        .portfolio-card:hover .portfolio-card-zoom-icon {
            background: var(--primary-accent);
            color: #ffffff;
            transform: scale(1.1);
        }
        .portfolio-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #78909c;
            background: linear-gradient(135deg, #cfd8dc, #eceff1);
            text-align: center;
            padding: 20px;
        }
        .portfolio-placeholder i {
            font-size: 3rem;
            color: #b0bec5;
            margin-bottom: 10px;
        }
        .portfolio-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(43, 53, 58, 0.85);
            backdrop-filter: blur(5px);
            color: var(--white);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            z-index: 4;
        }
        .portfolio-badge-count {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(198, 40, 40, 0.85);
            backdrop-filter: blur(5px);
            color: #ffffff;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 4;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .portfolio-img-wrapper .carousel-indicators {
            z-index: 4;
            margin-bottom: 10px;
        }
        .portfolio-img-wrapper .carousel-indicators [data-bs-target] {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.6);
            border: none;
            margin: 0 4px;
            transition: all 0.3s ease;
        }
        .portfolio-img-wrapper .carousel-indicators .active {
            width: 20px;
            border-radius: 10px;
            background-color: var(--primary-accent);
        }
        .portfolio-info {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .portfolio-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0;
            color: var(--text-color);
        }
        .portfolio-desc {
            font-size: 0.9rem;
            color: #546e7a;
            line-height: 1.5;
            margin: 0;
        }

        /* Lightbox Modal Styles */
        .portfolio-lightbox {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.3s ease;
        }
        .portfolio-lightbox.active {
            opacity: 1;
            visibility: visible;
        }
        .portfolio-lightbox-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(10, 15, 26, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .portfolio-lightbox-container {
            position: relative;
            z-index: 10;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px 24px;
            box-sizing: border-box;
            user-select: none;
        }
        .portfolio-lightbox-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
            padding-bottom: 8px;
        }
        .portfolio-lightbox-counter {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.85rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.12);
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            letter-spacing: 0.5px;
        }
        .portfolio-lightbox-close {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .portfolio-lightbox-close:hover {
            background: var(--primary-accent);
            border-color: var(--primary-accent);
            transform: rotate(90deg) scale(1.08);
            color: #ffffff;
        }
        .portfolio-lightbox-body {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
            gap: 15px;
        }
        .portfolio-lightbox-img-wrapper {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: calc(100% - 130px);
            margin: auto;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.25s ease;
        }
        .portfolio-lightbox-img {
            max-width: 100%;
            max-height: 72vh;
            object-fit: contain;
            border-radius: 14px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: #0f172a;
            user-select: none;
            transition: opacity 0.25s ease, transform 0.25s ease;
        }
        .portfolio-lightbox-caption {
            margin-top: 14px;
            text-align: center;
            color: #ffffff;
            max-width: 750px;
            background: rgba(0, 0, 0, 0.45);
            padding: 10px 24px;
            border-radius: 20px;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .portfolio-lightbox-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 4px;
            color: #ffffff;
        }
        .portfolio-lightbox-desc {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0;
            line-height: 1.4;
        }
        .portfolio-lightbox-nav {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            cursor: pointer;
            transition: all 0.25s ease;
            flex-shrink: 0;
            z-index: 12;
        }
        .portfolio-lightbox-nav:hover {
            background: rgba(255, 255, 255, 0.28);
            transform: scale(1.1);
            color: #ffffff;
        }
        @media (max-width: 768px) {
            .portfolio-lightbox-container {
                padding: 12px 14px;
            }
            .portfolio-lightbox-nav {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 42px;
                height: 42px;
                font-size: 1.15rem;
                background: rgba(15, 23, 42, 0.7);
            }
            .portfolio-lightbox-prev {
                left: 6px;
            }
            .portfolio-lightbox-next {
                right: 6px;
            }
            .portfolio-lightbox-img-wrapper {
                max-width: 95vw;
            }
            .portfolio-lightbox-img {
                max-height: 64vh;
            }
        }
        .client-product-img {
            transition: transform 0.3s ease;
        }

        /* Team Cards (Who We Are) */
        .team-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            padding: 30px 25px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            height: 100%;
        }
        .team-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }
        .team-avatar-wrapper {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            margin: 0 auto 20px;
            overflow: hidden;
            background: #b0bec5;
            border: 4px solid var(--white);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .team-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .team-avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--white);
            background: linear-gradient(135deg, #78909c, #b0bec5);
        }
        .team-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text-color);
        }
        .team-role {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary-accent);
            margin-bottom: 12px;
        }
        .team-phone {
            font-size: 0.85rem;
            color: #78909c;
            margin-bottom: 15px;
            display: inline-block;
            text-decoration: none;
            transition: var(--transition);
        }
        .team-phone:hover {
            color: var(--primary-accent);
        }
        .team-quote {
            font-style: italic;
            font-size: 0.88rem;
            color: #546e7a;
            line-height: 1.5;
            margin-top: 10px;
            border-top: 1px dashed rgba(0,0,0,0.08);
            padding-top: 12px;
        }
        .team-desc {
            font-size: 0.84rem;
            color: #64748b;
            line-height: 1.6;
            margin-top: 10px;
            border-top: 1px solid rgba(0,0,0,0.06);
            padding-top: 10px;
        }
        .team-quote + .team-desc {
            border-top: none;
            margin-top: 8px;
            padding-top: 0;
            color: #78909c;
            font-size: 0.82rem;
        }

        /* Leader Spotlight (Director / Creative Director) */
        .leader-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            padding: 45px;
            box-shadow: var(--shadow);
            height: 100%;
            transition: var(--transition);
        }
        .leader-card:hover {
            transform: translateY(-5px);
            background: var(--white);
            box-shadow: 0 20px 45px rgba(0,0,0,0.08);
        }
        .leader-avatar-wrapper {
            width: 170px;
            height: 170px;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid var(--white);
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            margin-bottom: 25px;
            background: #b0bec5;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .leader-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .leader-quote {
            font-size: 1.2rem;
            font-style: italic;
            color: var(--text-color);
            line-height: 1.6;
            margin-bottom: 25px;
            position: relative;
            padding-left: 25px;
        }
        .leader-quote::before {
            content: '"';
            font-family: Georgia, serif;
            font-size: 3rem;
            color: rgba(198, 40, 40, 0.15);
            position: absolute;
            left: 0;
            top: -15px;
        }
        .leader-desc {
            font-size: 0.95rem;
            color: #546e7a;
            line-height: 1.7;
        }

        /* Team Staggered Entrance Animation (Hilang & Muncul 1 per 1) */
        #team.team-animation-ready .team-title-animate {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.65s cubic-bezier(0.16, 1, 0.3, 1), transform 0.65s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        #team.team-animation-ready .team-title-animate.animate-in {
            opacity: 1;
            transform: translateY(0);
        }

        #team.team-animation-ready .team-animate-item {
            opacity: 0;
            transform: translateY(35px) scale(0.96);
            transition: opacity 0.65s cubic-bezier(0.16, 1, 0.3, 1), transform 0.65s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        #team.team-animation-ready .team-animate-item.animate-in {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Contact Section */
        .contact-info-wrapper {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }
        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(198, 40, 40, 0.08);
            color: var(--primary-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
            transition: var(--transition);
        }
        .contact-item:hover .contact-icon {
            background: var(--primary-accent);
            color: var(--white);
            transform: scale(1.05);
        }
        .contact-details h5 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .contact-details p {
            font-size: 0.95rem;
            color: #546e7a;
            margin: 0;
            line-height: 1.5;
        }
        .contact-details a {
            color: #546e7a;
            text-decoration: none;
            transition: var(--transition);
        }
        .contact-details a:hover {
            color: var(--primary-accent);
        }

        .direct-contact-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .direct-contact-item {
            background: rgba(255, 255, 255, 0.75);
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 12px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .direct-contact-item:hover {
            background: #ffffff;
            border-color: rgba(37, 211, 102, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        }
        .direct-contact-info .contact-name {
            font-size: 0.92rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 2px;
        }
        .direct-contact-info .contact-num {
            font-size: 0.83rem;
            color: #78909c;
            font-weight: 500;
        }
        /* WhatsApp Button Wiggle & Pulse Glow Animation */
        @keyframes waShakeBounce {
            0%, 65%, 100% {
                transform: rotate(0deg) scale(1);
            }
            67% {
                transform: rotate(-8deg) scale(1.08);
            }
            71% {
                transform: rotate(8deg) scale(1.1);
            }
            75% {
                transform: rotate(-6deg) scale(1.08);
            }
            79% {
                transform: rotate(6deg) scale(1.1);
            }
            83% {
                transform: rotate(-4deg) scale(1.05);
            }
            87% {
                transform: rotate(4deg) scale(1.05);
            }
            91% {
                transform: rotate(0deg) scale(1.02);
            }
        }

        @keyframes waPulseGlow {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6), 0 4px 12px rgba(37, 211, 102, 0.3);
            }
            70% {
                box-shadow: 0 0 0 14px rgba(37, 211, 102, 0), 0 6px 18px rgba(37, 211, 102, 0.4);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0), 0 4px 12px rgba(37, 211, 102, 0.3);
            }
        }

        @keyframes waIconWiggle {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.25) rotate(15deg); }
        }

        .btn-wa-direct {
            background-color: #25D366;
            border: none;
            color: #ffffff !important;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 7px 16px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            flex-shrink: 0;
            transition: all 0.3s cubic-bezier(0.25, 1.2, 0.4, 1);
            animation: waShakeBounce 3s ease-in-out infinite, waPulseGlow 2s infinite;
            will-change: transform, box-shadow;
        }

        .btn-wa-direct:hover {
            background-color: #20ba59;
            transform: scale(1.12) rotate(0deg);
            box-shadow: 0 8px 22px rgba(37, 211, 102, 0.55);
            color: #ffffff !important;
            animation-play-state: paused;
        }

        .btn-wa-direct i {
            font-size: 1rem;
            display: inline-block;
            transition: transform 0.3s ease;
            animation: waIconWiggle 2.5s ease-in-out infinite;
        }

        .btn-wa-direct:hover i {
            transform: scale(1.3) rotate(12deg);
        }

        /* Google Maps Button Wiggle & Pulse Animation */
        @keyframes mapsShakeBounce {
            0%, 65%, 100% {
                transform: rotate(0deg) scale(1);
            }
            68% {
                transform: rotate(-6deg) scale(1.06);
            }
            72% {
                transform: rotate(6deg) scale(1.08);
            }
            76% {
                transform: rotate(-5deg) scale(1.06);
            }
            80% {
                transform: rotate(5deg) scale(1.08);
            }
            84% {
                transform: rotate(-3deg) scale(1.04);
            }
            88% {
                transform: rotate(3deg) scale(1.04);
            }
            92% {
                transform: rotate(0deg) scale(1.02);
            }
        }

        @keyframes mapsPulseGlow {
            0% {
                box-shadow: 0 0 0 0 rgba(211, 47, 47, 0.4), 0 2px 8px rgba(211, 47, 47, 0.2);
            }
            70% {
                box-shadow: 0 0 0 12px rgba(211, 47, 47, 0), 0 4px 14px rgba(211, 47, 47, 0.35);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(211, 47, 47, 0), 0 2px 8px rgba(211, 47, 47, 0.2);
            }
        }

        @keyframes mapsPinWiggle {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-3px) rotate(12deg) scale(1.2); }
        }

        .btn-maps-link {
            display: inline-flex;
            align-items: center;
            font-size: 0.8rem;
            font-weight: 600;
            color: #d32f2f !important;
            background: rgba(211, 47, 47, 0.08);
            border: 1px solid rgba(211, 47, 47, 0.25);
            padding: 5px 14px;
            border-radius: 20px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.25, 1.2, 0.4, 1);
            animation: mapsShakeBounce 3.2s ease-in-out infinite, mapsPulseGlow 2.2s infinite;
            will-change: transform, box-shadow;
        }

        .btn-maps-link:hover {
            background: #d32f2f;
            color: #ffffff !important;
            border-color: #d32f2f;
            box-shadow: 0 8px 20px rgba(211, 47, 47, 0.45);
            transform: scale(1.08) rotate(0deg);
            animation-play-state: paused;
        }

        .btn-maps-link i.bi-geo-alt-fill {
            display: inline-block;
            transition: transform 0.3s ease;
            animation: mapsPinWiggle 2.5s ease-in-out infinite;
        }

        .btn-maps-link:hover i.bi-geo-alt-fill {
            transform: scale(1.25) rotate(-10deg);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            padding: 14px 20px;
            font-size: 0.95rem;
            color: var(--text-color);
            transition: var(--transition);
        }
        .form-control:focus {
            background: var(--white);
            border-color: var(--primary-accent);
            box-shadow: 0 0 0 4px rgba(198, 40, 40, 0.1);
        }
        .btn-submit {
            background: var(--primary-accent);
            color: var(--white);
            padding: 14px 30px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
            width: 100%;
            box-shadow: 0 8px 25px rgba(198, 40, 40, 0.15);
        }
        .btn-submit:hover {
            background: #b71c1c;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(198, 40, 40, 0.25);
        }

        /* Kirim Pesan Letter-by-Letter Wave Animation */
        @keyframes textWaveAnimation {
            0%, 100% {
                transform: translateY(0);
            }
            30% {
                transform: translateY(-7px);
                color: #ffffff;
                text-shadow: 0 4px 10px rgba(255, 255, 255, 0.4);
            }
            60% {
                transform: translateY(0);
            }
        }

        @keyframes iconFlyWave {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-8px) rotate(-15deg);
            }
        }

        .btn-wave-text {
            display: inline-flex;
            align-items: center;
            white-space: pre;
        }

        .wave-char {
            display: inline-block;
            transition: transform 0.25s ease;
            animation: textWaveAnimation 1.8s cubic-bezier(0.25, 1.2, 0.4, 1) infinite;
            will-change: transform;
        }

        .btn-submit i.bi-send {
            display: inline-block;
            transition: transform 0.3s ease;
            animation: iconFlyWave 2s ease-in-out 0.3s infinite;
            will-change: transform;
        }

        .btn-submit:hover .wave-char {
            animation-duration: 1.2s;
        }

        .btn-submit:hover i.bi-send {
            transform: translateY(-5px) translateX(3px) rotate(-12deg);
        }

        /* Stat Numbers Wave Animation */
        @keyframes statWaveAnimation {
            0%, 100% {
                transform: translateY(0);
            }
            30% {
                transform: translateY(-8px);
                text-shadow: 0 4px 12px rgba(198, 40, 40, 0.35);
            }
            60% {
                transform: translateY(0);
            }
        }

        .stat-wave-text {
            display: inline-flex;
            align-items: center;
        }

        .stat-wave-char {
            display: inline-block;
            transition: transform 0.25s ease;
            animation: statWaveAnimation 1.8s cubic-bezier(0.25, 1.2, 0.4, 1) infinite;
            will-change: transform;
        }

        /* Footer */
        footer {
            background: #21282c;
            color: #cfd8dc;
            padding: 80px 0 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
        .footer-logo {
            font-family: var(--font-cursive);
            font-size: 2.8rem;
            color: var(--white);
            margin-bottom: 5px;
            line-height: 1;
        }
        .footer-logo-sub {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #90a4ae;
            font-weight: 600;
            display: block;
            margin-bottom: 20px;
        }
        .footer-text {
            font-size: 0.9rem;
            line-height: 1.7;
            color: #90a4ae;
        }
        .footer-heading {
            color: var(--white);
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }
        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--primary-accent);
        }
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-links li {
            margin-bottom: 12px;
        }
        .footer-links a {
            color: #90a4ae;
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }
        .footer-links a:hover {
            color: var(--white);
            padding-left: 5px;
        }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.05);
            margin-top: 50px;
            padding-top: 30px;
            font-size: 0.85rem;
            color: #78909c;
        }

        /* Instagram Wobble & Sway Animation (Animasi Bergoyang) */
        .footer-ig-btn {
            width: 46px;
            height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            color: #ffffff;
            border: 2px solid rgba(255, 255, 255, 0.28);
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(6px);
            transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            text-decoration: none;
            cursor: pointer;
            animation: igFloatWobble 2.8s ease-in-out infinite;
            transform-origin: center bottom;
            will-change: transform, box-shadow;
        }

        .footer-ig-btn i {
            display: inline-block;
            transition: transform 0.3s ease;
            animation: igIconWiggle 2.8s ease-in-out infinite;
            transform-origin: center center;
        }

        @keyframes igFloatWobble {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            15% {
                transform: translateY(-5px) rotate(-14deg);
            }
            30% {
                transform: translateY(-2px) rotate(14deg);
            }
            45% {
                transform: translateY(-4px) rotate(-10deg);
            }
            60% {
                transform: translateY(-1px) rotate(8deg);
            }
            75% {
                transform: translateY(-2px) rotate(-4deg);
            }
            88% {
                transform: translateY(0) rotate(2deg);
            }
        }

        @keyframes igIconWiggle {
            0%, 100% {
                transform: rotate(0deg) scale(1);
            }
            15% {
                transform: rotate(-12deg) scale(1.18);
            }
            30% {
                transform: rotate(12deg) scale(1.18);
            }
            45% {
                transform: rotate(-8deg) scale(1.12);
            }
            60% {
                transform: rotate(6deg) scale(1.08);
            }
            75% {
                transform: rotate(-3deg) scale(1.02);
            }
        }

        /* Hover: Instagram signature vibrant gradient glow + energetic sway */
        .footer-ig-btn:hover {
            color: #ffffff;
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
            border-color: rgba(255, 255, 255, 0.7);
            box-shadow: 0 0 20px rgba(225, 48, 108, 0.6), 0 8px 25px rgba(0, 0, 0, 0.4);
            animation: igHoverShake 0.5s ease-in-out infinite alternate;
        }

        .footer-ig-btn:hover i {
            animation: none;
            transform: scale(1.22);
        }

        @keyframes igHoverShake {
            0% {
                transform: scale(1.18) translateY(-4px) rotate(-12deg);
            }
            100% {
                transform: scale(1.18) translateY(-4px) rotate(12deg);
            }
        }

        /* ================= BOUTIQUE LOGO STAGE (ANIMASI HURUF SATU PERSATU) ================= */
        .boutique-logo-stage {
            position: relative;
            width: 100%;
            aspect-ratio: 2340 / 958;
            display: inline-block;
            vertical-align: middle;
            user-select: none;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .hero-logo-stage {
            max-width: 320px;
            max-height: 180px;
        }

        .boutique-logo-stage:hover {
            transform: scale(1.03);
        }

        .boutique-logo-stage .stage-letter {
            position: absolute;
            pointer-events: none;
            object-fit: contain;
            will-change: opacity, transform;
            opacity: 0;
            transform: translateY(22px) scale(0.92);
        }

        /* Exact coordinates */
        .boutique-logo-stage .let-B      { left: 0%; top: 0.2088%; width: 30.5556%; height: 76.096%; }
        .boutique-logo-stage .let-o      { left: 30.5556%; top: 9.1858%; width: 7.6923%; height: 42.5887%; }
        .boutique-logo-stage .let-u1     { left: 38.2479%; top: 30.8977%; width: 8.3333%; height: 20.5637%; }
        .boutique-logo-stage .let-t      { left: 37.3504%; top: 0%; width: 23.3761%; height: 51.6701%; }
        .boutique-logo-stage .let-i      { left: 55.1282%; top: 0.9395%; width: 5.9829%; height: 50.6263%; }
        .boutique-logo-stage .let-accent { left: 61.1538%; top: 8.7683%; width: 4.359%; height: 13.4656%; }
        .boutique-logo-stage .let-q      { left: 57.1795%; top: 1.4614%; width: 16.3248%; height: 98.5386%; }
        .boutique-logo-stage .let-u2     { left: 73.5043%; top: 31.2109%; width: 8.547%; height: 22.2338%; }
        .boutique-logo-stage .let-e1     { left: 82.0513%; top: 27.8706%; width: 17.9487%; height: 27.3486%; }

        .boutique-logo-stage .let-d      { left: 64.9573%; top: 57.0981%; width: 5.5983%; height: 15.4489%; }
        .boutique-logo-stage .let-e2     { left: 70.5556%; top: 57.0981%; width: 3.6325%; height: 15.4489%; }
        .boutique-logo-stage .let-s      { left: 74.188%; top: 63.3612%; width: 3.2906%; height: 9.1858%; }
        .boutique-logo-stage .let-di     { left: 77.4786%; top: 59.2902%; width: 2.906%; height: 17.7453%; }
        .boutique-logo-stage .let-g      { left: 80.3846%; top: 63.3612%; width: 3.8462%; height: 13.5699%; }
        .boutique-logo-stage .let-dn     { left: 84.2308%; top: 63.3612%; width: 4.1453%; height: 8.8727%; }

        /* Continuous infinite letter-by-letter animation - 100% automatic without requiring home page */
        @keyframes anim_let_B {
            0%, 1.67% { opacity: 0; transform: translateY(22px) scale(0.92); }
            7.5%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-B { animation: anim_let_B 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_o {
            0%, 5% { opacity: 0; transform: translateY(22px) scale(0.92); }
            10.83%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-o { animation: anim_let_o 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_u1 {
            0%, 8.33% { opacity: 0; transform: translateY(22px) scale(0.92); }
            14.17%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-u1 { animation: anim_let_u1 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_t {
            0%, 11.67% { opacity: 0; transform: translateY(22px) scale(0.92); }
            17.5%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-t { animation: anim_let_t 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_i {
            0%, 15% { opacity: 0; transform: translateY(22px) scale(0.92); }
            20.83%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-i { animation: anim_let_i 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_accent {
            0%, 18.33% { opacity: 0; transform: translateY(-35px) scale(0.5); }
            22.5% { opacity: 1; transform: translateY(4px) scale(1.2); }
            25%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-accent { animation: anim_let_accent 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_q {
            0%, 21.67% { opacity: 0; transform: translateY(22px) scale(0.92); }
            27.5%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-q { animation: anim_let_q 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_u2 {
            0%, 25% { opacity: 0; transform: translateY(22px) scale(0.92); }
            30.83%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-u2 { animation: anim_let_u2 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_e1 {
            0%, 28.33% { opacity: 0; transform: translateY(22px) scale(0.92); }
            34.17%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-e1 { animation: anim_let_e1 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_d {
            0%, 33.33% { opacity: 0; transform: translateY(22px) scale(0.92); }
            37.5%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-d { animation: anim_let_d 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_e2 {
            0%, 35.83% { opacity: 0; transform: translateY(22px) scale(0.92); }
            40%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-e2 { animation: anim_let_e2 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_s {
            0%, 38.33% { opacity: 0; transform: translateY(22px) scale(0.92); }
            42.5%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-s { animation: anim_let_s 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_di {
            0%, 40.83% { opacity: 0; transform: translateY(22px) scale(0.92); }
            45%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-di { animation: anim_let_di 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_g {
            0%, 43.33% { opacity: 0; transform: translateY(22px) scale(0.92); }
            47.5%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-g { animation: anim_let_g 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        @keyframes anim_let_dn {
            0%, 45.83% { opacity: 0; transform: translateY(22px) scale(0.92); }
            50%, 83.33% { opacity: 1; transform: translateY(0) scale(1); }
            90%, 100% { opacity: 0; transform: translateY(12px) scale(0.95); }
        }
        .boutique-logo-stage .let-dn { animation: anim_let_dn 6s cubic-bezier(0.25, 1.2, 0.4, 1) infinite; }

        /* SVG Graph Animation */
        .animated-path {
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation: drawLine 4s ease forwards infinite;
        }
        @keyframes drawLine {
            to {
                stroke-dashoffset: 0;
            }
        }
        
        .floating-anim {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* ================= SCROLL REVEAL ANIMATIONS (CINEMATIC LUXURY) ================= */
        /* State 1: Di luar layar (reset instan 0ms tanpa lag) */
        .reveal-init .reveal,
        .reveal-init .reveal-up,
        .reveal-init .reveal-down,
        .reveal-init .reveal-left,
        .reveal-init .reveal-right,
        .reveal-init .reveal-zoom,
        .reveal-init .reveal-fade {
            opacity: 0;
            transition: none !important;
            will-change: opacity, transform;
            transform: translate3d(0, 0, 0);
        }

        .reveal-init .reveal,
        .reveal-init .reveal-up {
            transform: translate3d(0, 48px, 0);
        }

        .reveal-init .reveal-down {
            transform: translate3d(0, -48px, 0);
        }

        .reveal-init .reveal-left {
            transform: translate3d(-52px, 0, 0);
        }

        .reveal-init .reveal-right {
            transform: translate3d(52px, 0, 0);
        }

        .reveal-init .reveal-zoom {
            transform: translate3d(0, 30px, 0) scale(0.90);
        }

        .reveal-init .reveal-fade {
            transform: translate3d(0, 0, 0);
        }

        /* State 2: Setiap masuk tampilan (animasi delay mewah selalu aktif berulang) */
        .reveal-init .reveal.revealed,
        .reveal-init .reveal-up.revealed,
        .reveal-init .reveal-down.revealed,
        .reveal-init .reveal-left.revealed,
        .reveal-init .reveal-right.revealed,
        .reveal-init .reveal-zoom.revealed,
        .reveal-init .reveal-fade.revealed {
            opacity: 1;
            transform: translate3d(0, 0, 0) scale(1) !important;
            transition-property: opacity, transform !important;
            transition-duration: 0.88s !important;
            transition-timing-function: cubic-bezier(0.19, 1, 0.22, 1) !important;
            transition-delay: 0.12s;
        }

        /* Cinematic Stagger Delay Classes */
        .reveal-init .reveal-delay-1.revealed { transition-delay: 0.22s !important; }
        .reveal-init .reveal-delay-2.revealed { transition-delay: 0.40s !important; }
        .reveal-init .reveal-delay-3.revealed { transition-delay: 0.58s !important; }
        .reveal-init .reveal-delay-4.revealed { transition-delay: 0.76s !important; }
        .reveal-init .reveal-delay-5.revealed { transition-delay: 0.94s !important; }
        .reveal-init .reveal-delay-6.revealed { transition-delay: 1.12s !important; }

        @media (prefers-reduced-motion: reduce) {
            /* Tetap berikan transisi lembut agar animasi tetap berjalan elegan di laptop */
            .reveal-init .reveal,
            .reveal-init .reveal-up,
            .reveal-init .reveal-down,
            .reveal-init .reveal-left,
            .reveal-init .reveal-right,
            .reveal-init .reveal-zoom,
            .reveal-init .reveal-fade {
                transition-duration: 0.55s !important;
            }
        }
    </style>
    <script>
        function closeMobileNavbar() {
            try {
                var navbarNav = document.getElementById('navbarNav');
                var toggler = document.querySelector('.navbar-toggler');
                if (!navbarNav || !toggler) return;

                // Hanya berlaku pada device HP / layar mobile di mana toggler aktif
                var isMobile = (window.innerWidth < 992) || (window.getComputedStyle(toggler).display !== 'none');
                if (!isMobile) return;

                // Cek apakah navbar menu sedang terbuka (memiliki class show/collapsing atau toggler aria-expanded="true")
                var isOpen = navbarNav.classList.contains('show') || 
                             navbarNav.classList.contains('collapsing') || 
                             (toggler.getAttribute('aria-expanded') === 'true') || 
                             (!toggler.classList.contains('collapsed'));

                if (isOpen) {
                    // Klik tombol toggler (3 garis) untuk menutup menu secara alami lewat sistem Bootstrap
                    toggler.click();
                }
            } catch (err) {
                console.warn('Navbar close error:', err);
            }
        }

        // Menutup menu jika user mengetuk area di luar navbar pada HP
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.navbar')) {
                closeMobileNavbar();
            }
        });
    </script>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#" onclick="closeMobileNavbar()">
                <img src="{{ asset('uploads/logo.png') }}" alt="Boutique Design" style="height: 52px; width: auto;">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="#home" onclick="closeMobileNavbar()">{{ __('messages.nav.home') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about" onclick="closeMobileNavbar()">{{ __('messages.nav.about') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#philosophy" onclick="closeMobileNavbar()">{{ __('messages.nav.philosophy') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services" onclick="closeMobileNavbar()">{{ __('messages.nav.services') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team" onclick="closeMobileNavbar()">{{ __('messages.nav.team') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio" onclick="closeMobileNavbar()">{{ __('messages.nav.work') }}</a></li>
                    @if(isset($clients) && count($clients) > 0)
                        <li class="nav-item"><a class="nav-link" href="#clients" onclick="closeMobileNavbar()">{{ __('messages.nav.clients') }}</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="#contact" onclick="closeMobileNavbar()">{{ __('messages.nav.contact') }}</a></li>
                    <li class="nav-item ms-lg-2">
                        <a href="#contact" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-2" onclick="closeMobileNavbar()" style="font-weight:600; font-size:0.85rem;">{{ __('messages.nav.get_ideas') }}</a>
                    </li>
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link dropdown-toggle btn btn-sm btn-light rounded-pill px-3 py-2 border d-flex align-items-center gap-1" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 0.8rem; font-weight:600; background:rgba(255,255,255,0.6);">
                            <i class="bi bi-translate"></i> {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2" aria-labelledby="langDropdown">
                            <li><a class="dropdown-item py-2 @if(app()->getLocale() === 'en') active @endif" href="{{ route('lang.switch', 'en') }}">EN - English</a></li>
                            <li><a class="dropdown-item py-2 @if(app()->getLocale() === 'id') active @endif" href="{{ route('lang.switch', 'id') }}">ID - Indonesia</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    @php
        $heroBgType = $settings['hero_bg_type'] ?? 'image';
        $heroBgImage = !empty($settings['hero_bg_image']) ? $settings['hero_bg_image'] : 'uploads/hero-bg.png';
        $heroBgVideo = !empty($settings['hero_bg_video']) ? asset($settings['hero_bg_video']) : (!empty($settings['hero_bg_video_url']) ? $settings['hero_bg_video_url'] : '');
        $heroOverlayOpacityVal = isset($settings['hero_overlay_opacity']) ? (int)$settings['hero_overlay_opacity'] : 82;
        $heroOverlayOpacity = $heroOverlayOpacityVal / 100;
        $heroOverlayColor = $settings['hero_overlay_color'] ?? 'light';
        $isVideoActive = ($heroBgType === 'video' && !empty($heroBgVideo));
    @endphp
    <header id="home" class="hero {{ $heroOverlayColor === 'dark' ? 'hero-theme-dark' : '' }}"
            style="@if(!$isVideoActive) background-image: url('{{ asset($heroBgImage) }}'); @else background-color: #0f172a; @endif">
        @if($isVideoActive)
            <div class="hero-video-wrapper">
                <video class="hero-bg-video" autoplay muted loop playsinline preload="auto" poster="{{ asset($heroBgImage) }}">
                    <source src="{{ $heroBgVideo }}">
                </video>
            </div>
        @endif
        <div class="hero-bg-overlay {{ $heroOverlayColor === 'dark' ? 'hero-overlay-dark' : 'hero-overlay-light' }}"
             style="--overlay-op: {{ $heroOverlayOpacity }};"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start reveal-left">
                    <h1 class="hero-title-sig mb-3">
                        <div class="boutique-logo-stage hero-logo-stage" id="boutiqueHeroLogo" title="{{ app()->getLocale() == 'id' ? 'Klik untuk memutar ulang animasi huruf' : 'Click to replay letter animation' }}">
                            <img src="{{ asset('uploads/logo_letters/b_B_crop.png') }}" class="stage-letter let-B" alt="B">
                            <img src="{{ asset('uploads/logo_letters/b_o_crop.png') }}" class="stage-letter let-o" alt="o">
                            <img src="{{ asset('uploads/logo_letters/b_u1_crop.png') }}" class="stage-letter let-u1" alt="u">
                            <img src="{{ asset('uploads/logo_letters/b_t_crop.png') }}" class="stage-letter let-t" alt="t">
                            <img src="{{ asset('uploads/logo_letters/b_i_crop.png') }}" class="stage-letter let-i" alt="i">
                            <img src="{{ asset('uploads/logo_letters/accent_crop.png') }}" class="stage-letter let-accent" alt="´">
                            <img src="{{ asset('uploads/logo_letters/b_q_crop.png') }}" class="stage-letter let-q" alt="q">
                            <img src="{{ asset('uploads/logo_letters/b_u2_crop.png') }}" class="stage-letter let-u2" alt="u">
                            <img src="{{ asset('uploads/logo_letters/b_e_crop.png') }}" class="stage-letter let-e1" alt="e">
                            <img src="{{ asset('uploads/logo_letters/d_d_crop.png') }}" class="stage-letter let-d" alt="d">
                            <img src="{{ asset('uploads/logo_letters/d_e_crop.png') }}" class="stage-letter let-e2" alt="e">
                            <img src="{{ asset('uploads/logo_letters/d_s_crop.png') }}" class="stage-letter let-s" alt="s">
                            <img src="{{ asset('uploads/logo_letters/d_i_crop.png') }}" class="stage-letter let-di" alt="i">
                            <img src="{{ asset('uploads/logo_letters/d_g_crop.png') }}" class="stage-letter let-g" alt="g">
                            <img src="{{ asset('uploads/logo_letters/d_n_crop.png') }}" class="stage-letter let-dn" alt="n">
                        </div>
                    </h1>
                    <h2 class="hero-title-main">
                        @if(app()->getLocale() === 'en')
                            grab <span class="highlight">e</span>ven <span class="highlight">b</span>igger <span class="highlight">i</span>deas <span class="highlight">w</span>ith us
                        @else
                            raih <span class="highlight">i</span>de yang <span class="highlight">l</span>ebih <span class="highlight">b</span>esar bersama kami
                        @endif
                    </h2>
                    

                    <p class="hero-slogan">
                        {{ $settings['slogan_main_' . app()->getLocale()] ?? $settings['slogan_main_en'] ?? (app()->getLocale() === 'en' ? 'When you are thirsty for ideas, when you need something makes you fresh, Boutique Design Indonesia' : 'Ketika Anda haus akan ide, ketika Anda butuh sesuatu yang membuat Anda segar, Boutique Design Indonesia') }}
                    </p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3">
                        <a href="#portfolio" class="btn btn-danger btn-lg rounded-pill px-5 py-3 shadow" style="background-color: var(--primary-accent); border-color: var(--primary-accent); font-weight: 600; font-size:0.95rem;">{{ app()->getLocale() === 'en' ? 'Explore Our Work' : 'Jelajahi Karya Kami' }}</a>
                        <a href="#about" class="btn btn-outline-dark btn-lg rounded-pill px-5 py-3" style="font-weight: 600; font-size:0.95rem;">{{ app()->getLocale() === 'en' ? 'Learn About Us' : 'Tentang Kami' }}</a>
                    </div>
                </div>
                <div class="col-lg-6 reveal-zoom reveal-delay-2">
                    <div class="svg-bulb-container">
                        <!-- Ambient pulsating glow aura behind the bulb -->
                        <div class="bulb-ambient-aura"></div>

                        <!-- Interactive SVG Lightbulb with Floating & Breathing Light Effect -->
                        <svg class="svg-bulb" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                            <!-- Glow effect -->
                            <circle class="bulb-glow" cx="250" cy="220" r="160" />
                            
                            <!-- Crumpled paper texture background inside bulb (Concept recreation) -->
                            <mask id="bulb-mask">
                                <circle cx="250" cy="220" r="130" fill="white" />
                            </mask>
                            <g class="bulb-facets" mask="url(#bulb-mask)">
                                <!-- Origami/crumpled paper polygonal folds -->
                                <polygon points="250,90 200,120 280,140" fill="#fbc02d" opacity="0.6" />
                                <polygon points="280,140 320,100 350,150" fill="#f9a825" opacity="0.75" />
                                <polygon points="350,150 370,220 300,210" fill="#ffb300" opacity="0.8" />
                                <polygon points="300,210 250,260 210,230" fill="#fbc02d" opacity="0.7" />
                                <polygon points="210,230 140,240 130,170" fill="#f57f17" opacity="0.8" />
                                <polygon points="130,170 170,120 250,90" fill="#ffc107" opacity="0.85" />
                                <polygon points="250,90 280,140 210,230" fill="#ffd54f" opacity="0.9" />
                                <polygon points="280,140 300,210 210,230" fill="#ffeb3b" opacity="0.95" />
                                <polygon points="350,150 300,210 320,290" fill="#f9a825" opacity="0.85" />
                                <polygon points="300,210 250,260 320,290" fill="#ffb300" opacity="0.9" />
                                <polygon points="210,230 250,260 170,300" fill="#fbc02d" opacity="0.85" />
                                <polygon points="170,300 140,240 210,230" fill="#f57f17" opacity="0.75" />
                                <polygon points="250,260 320,290 250,330" fill="#ffe082" opacity="0.95" />
                                <polygon points="250,260 170,300 250,330" fill="#ffd54f" opacity="0.9" />
                            </g>

                            <!-- Bulb Outline Drawing -->
                            <path d="M165,280 C140,240 120,200 120,160 C120,88 178,30 250,30 C322,30 380,88 380,160 C380,200 360,240 335,280 C325,296 318,315 315,330 L185,330 C182,315 175,296 165,280 Z" fill="none" stroke="#37474f" stroke-width="6" stroke-linecap="round" />
                            <!-- Metal Base -->
                            <path d="M185,330 L315,330 L305,360 L195,360 Z" fill="#b0bec5" stroke="#37474f" stroke-width="6" stroke-linejoin="round" />
                            <path d="M195,360 L305,360 L295,390 L205,390 Z" fill="#90a4ae" stroke="#37474f" stroke-width="6" stroke-linejoin="round" />
                            <path d="M205,390 L295,390 L280,415 L220,415 Z" fill="#78909c" stroke="#37474f" stroke-width="6" stroke-linejoin="round" />
                            <path d="M220,415 C220,430 280,430 280,415" fill="#37474f" stroke="#37474f" stroke-width="6" />

                            <!-- Idea sparkles with glowing animation -->
                            <g class="bulb-sparks">
                                <path d="M250,10 L250,0" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                                <path d="M370,60 L378,52" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                                <path d="M420,160 L430,160" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                                <path d="M380,270 L390,276" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                                <path d="M130,60 L122,52" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                                <path d="M80,160 L70,160" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                                <path d="M120,270 L110,276" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section (What Are We / Tentang Kami) -->
    @php
        $aboutBgType = $settings['about_bg_type'] ?? 'image';
        $aboutBgImage = !empty($settings['about_bg_image']) ? $settings['about_bg_image'] : 'uploads/about-bg.jpg';
        $aboutBgVideo = !empty($settings['about_bg_video']) ? asset($settings['about_bg_video']) : (!empty($settings['about_bg_video_url']) ? $settings['about_bg_video_url'] : '');
        $aboutOverlayOpacityVal = isset($settings['about_overlay_opacity']) ? (int)$settings['about_overlay_opacity'] : 88;
        $aboutOverlayOpacity = $aboutOverlayOpacityVal / 100;
        $aboutOverlayColor = $settings['about_overlay_color'] ?? 'light';
        $isAboutVideoActive = ($aboutBgType === 'video' && !empty($aboutBgVideo));
    @endphp
    <section id="about" class="about-section {{ $aboutOverlayColor === 'dark' ? 'about-theme-dark' : '' }}"
             style="@if(!$isAboutVideoActive) background-image: url('{{ asset($aboutBgImage) }}'); @else background-color: #0f172a; @endif">
        @if($isAboutVideoActive)
            <div class="about-video-wrapper">
                <video class="about-bg-video" autoplay muted loop playsinline preload="auto" poster="{{ asset($aboutBgImage) }}">
                    <source src="{{ $aboutBgVideo }}">
                </video>
            </div>
        @endif
        <div class="about-bg-overlay {{ $aboutOverlayColor === 'dark' ? 'about-overlay-dark' : 'about-overlay-light' }}"
             style="--about-overlay-op: {{ $aboutOverlayOpacity }};"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 reveal-left">
                    <div class="about-glass-panel">
                        <div class="section-title-wrapper text-start">
                            <span class="section-subtitle">{{ __('messages.sections.what_are_we') }}</span>
                            <h2 class="section-title"><span class="first-letter">{{ substr(__('messages.sections.what_are_we'), 0, 1) }}</span>{{ substr(__('messages.sections.what_are_we'), 1) }}</h2>
                        </div>
                        <div class="about-text mb-4">
                            <p class="lead fw-bold text-dark mb-4">
                                {{ __('messages.about.lead') }}
                            </p>
                            <p>
                                {{ __('messages.about.desc') }}
                            </p>
                        </div>
                        
                        <div class="row pt-2 text-center text-sm-start">
                            <div class="col-sm-6 mb-3">
                                <h3 class="h1 fw-bold text-danger mb-1" style="color: var(--primary-accent);">
                                    <span class="stat-wave-text">
                                        <span class="stat-wave-char" style="animation-delay: 0s;">2</span>
                                        <span class="stat-wave-char" style="animation-delay: 0.12s;">0</span>
                                        <span class="stat-wave-char" style="animation-delay: 0.24s;">1</span>
                                        <span class="stat-wave-char" style="animation-delay: 0.36s;">0</span>
                                    </span>
                                </h3>
                                <p class="text-secondary small uppercase tracking">{{ __('messages.about.year_established') }}</p>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <h3 class="h1 fw-bold text-danger mb-1" style="color: var(--primary-accent);">
                                    <span class="stat-wave-text">
                                        <span class="stat-wave-char" style="animation-delay: 0s;">1</span>
                                        <span class="stat-wave-char" style="animation-delay: 0.12s;">0</span>
                                        <span class="stat-wave-char" style="animation-delay: 0.24s;">0</span>
                                        <span class="stat-wave-char" style="animation-delay: 0.36s;">%</span>
                                    </span>
                                </h3>
                                <p class="text-secondary small uppercase tracking">{{ __('messages.about.independent_agency') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center reveal-right reveal-delay-2">
                    <div class="svg-brainstorm-container p-3 p-md-4 rounded-4" style="background: rgba(255, 255, 255, 0.72); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: 0 12px 32px rgba(0, 0, 0, 0.05);">
                        <!-- Hand drawn style layout recreating the concept: strategy, idea, innovation -->
                        <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: auto;">
                            <!-- Lightbulb inside brain node -->
                            <circle class="brainstorm-dashed-circle" cx="250" cy="250" r="80" fill="none" stroke="#78909c" stroke-width="4" stroke-dasharray="10 6" />
                            
                            <g class="brainstorm-lightbulb">
                                <path d="M250,210 C228,210 210,228 210,250 C210,265 220,278 228,284 C234,290 236,298 236,306 L264,306 C264,298 266,290 272,284 C280,278 290,265 290,250 C290,228 272,210 250,210 Z" fill="none" stroke="#c62828" stroke-width="5" />
                                <path d="M236,306 L264,306 L260,318 L240,318 Z" fill="#90a4ae" stroke="#37474f" stroke-width="3" />
                                <path d="M240,318 C240,326 260,326 260,318" fill="#37474f" stroke="#37474f" stroke-width="3" />
                            </g>

                            <!-- Spark lines -->
                            <g class="brainstorm-sparks">
                                <line x1="250" y1="195" x2="250" y2="185" stroke="#fbc02d" stroke-width="4" stroke-linecap="round" />
                                <line x1="290" y1="210" x2="300" y2="200" stroke="#fbc02d" stroke-width="4" stroke-linecap="round" />
                                <line x1="305" y1="250" x2="317" y2="250" stroke="#fbc02d" stroke-width="4" stroke-linecap="round" />
                                <line x1="210" y1="210" x2="200" y2="200" stroke="#fbc02d" stroke-width="4" stroke-linecap="round" />
                                <line x1="195" y1="250" x2="183" y2="250" stroke="#fbc02d" stroke-width="4" stroke-linecap="round" />
                            </g>
                            
                            <!-- Branching circles (Strategy, Idea, Innovation) -->
                            <!-- Strategy -->
                            <g class="brainstorm-node node-strategi">
                                <g class="brainstorm-circle-item">
                                    <path d="M210,220 L160,175" stroke="#78909c" stroke-width="3" stroke-dasharray="5 5" class="brainstorm-connector" />
                                    <circle cx="120" cy="150" r="45" fill="#eceff1" stroke="#37474f" stroke-width="3" />
                                    <text x="120" y="154" text-anchor="middle" font-size="13" font-weight="700" fill="#37474f">{{ app()->getLocale() === 'en' ? 'STRATEGY' : 'STRATEGI' }}</text>
                                </g>
                            </g>
                            
                            <!-- Idea -->
                            <g class="brainstorm-node node-ide">
                                <g class="brainstorm-circle-item">
                                    <path d="M290,220 L340,175" stroke="#78909c" stroke-width="3" stroke-dasharray="5 5" class="brainstorm-connector" />
                                    <circle cx="380" cy="150" r="45" fill="#eceff1" stroke="#37474f" stroke-width="3" />
                                    <text x="380" y="154" text-anchor="middle" font-size="13" font-weight="700" fill="#37474f">{{ app()->getLocale() === 'en' ? 'IDEA' : 'IDE' }}</text>
                                </g>
                            </g>

                            <!-- Innovation -->
                            <g class="brainstorm-node node-inovasi">
                                <g class="brainstorm-circle-item">
                                    <path d="M250,306 L250,345" stroke="#78909c" stroke-width="3" stroke-dasharray="5 5" class="brainstorm-connector" />
                                    <circle cx="250" cy="390" r="45" fill="#eceff1" stroke="#37474f" stroke-width="3" />
                                    <text x="250" y="394" text-anchor="middle" font-size="12" font-weight="700" fill="#37474f">{{ app()->getLocale() === 'en' ? 'INNOVATION' : 'INOVASI' }}</text>
                                </g>
                            </g>

                            <!-- Slogan title -->
                            <text x="250" y="475" class="brainstorm-slogan" text-anchor="middle" font-size="16" font-style="italic" font-weight="600" fill="#546e7a">{{ __('messages.sections.grab_bigger_ideas') }}</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Philosophy Section -->
    <section id="philosophy">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 order-lg-2 reveal-right">
                    <div class="section-title-wrapper text-start reveal-up">
                        <span class="section-subtitle">{{ __('messages.sections.mindset') }}</span>
                        <h2 class="section-title"><span class="first-letter">{{ substr(__('messages.sections.philosophy'), 0, 1) }}</span>{{ substr(__('messages.sections.philosophy'), 1) }}</h2>
                    </div>
                    <div class="about-text mb-4 reveal-up reveal-delay-1">
                        <p class="lead fw-bold text-dark mb-3">
                            {{ $settings['slogan_philosophy_' . app()->getLocale()] ?? $settings['slogan_philosophy_en'] ?? '' }}
                        </p>
                        <p>
                            {{ $settings['philosophy_desc_' . app()->getLocale()] ?? __('messages.philosophy.desc') }}
                        </p>
                    </div>
                    @php
                        $currLocale = app()->getLocale();
                        $firstPhilo = isset($philosophies) && $philosophies->count() > 0 ? $philosophies->first() : null;
                    @endphp

                    <div class="philosophy-word-cloud mb-3 reveal-up reveal-delay-2" id="philosophyWordCloud">
                        @if(isset($philosophies) && $philosophies->count() > 0)
                            @foreach($philosophies as $index => $philo)
                                @php
                                    $pTitle = $currLocale === 'en' ? ($philo->title_en ?: $philo->title_id) : ($philo->title_id ?: $philo->title_en);
                                    $pSub = $currLocale === 'en' ? ($philo->subtitle_en ?: $philo->subtitle_id) : ($philo->subtitle_id ?: $philo->subtitle_en);
                                    $pDesc = $currLocale === 'en' ? ($philo->description_en ?: $philo->description_id) : ($philo->description_id ?: $philo->description_en);
                                    $pImg = $philo->image_path ? asset($philo->image_path) : '';
                                    $pKey = $philo->key ?: 'p_' . $philo->id;
                                @endphp
                                <span class="philosophy-tag {{ $philo->is_highlighted ? 'highlighted' : '' }} {{ $index === 0 ? 'active' : '' }}" 
                                      data-key="{{ $pKey }}" 
                                      data-title="{{ $pTitle }}" 
                                      data-sub="{{ $pSub }}" 
                                      data-icon="{{ $philo->icon ?: 'bi-lightbulb-fill' }}" 
                                      data-image="{{ $pImg }}"
                                      data-desc="{{ $pDesc }}">
                                    {{ $pTitle }}
                                </span>
                            @endforeach
                        @endif
                    </div>

                    <!-- Dynamic Philosophy Insight Display Box with Real Horizontal Scroll Carousel -->
                    <div class="philosophy-insight-card mt-3 position-relative overflow-hidden reveal-up reveal-delay-3" id="philosophyInsightBox">
                        <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom" style="background: rgba(248, 250, 252, 0.85);">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-danger rounded-pill px-2.5 py-1 text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px; background-color: var(--primary-accent) !important;">
                                    <i class="bi bi-compass me-1"></i> {{ __('messages.sections.philosophy') }}
                                </span>
                                <span class="text-muted fw-semibold small" id="philoCounter" style="font-size: 0.8rem;">
                                    1 / {{ isset($philosophies) && $philosophies->count() > 0 ? $philosophies->count() : 1 }}
                                </span>
                            </div>
                            <!-- Mini Nav Buttons -->
                            <div class="d-flex align-items-center gap-1">
                                <button type="button" class="btn btn-sm btn-light border rounded-circle shadow-none philo-nav-btn" id="philoPrevBtn" title="Sebelumnya" style="width: 30px; height: 30px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-chevron-left" style="font-size: 0.8rem;"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-light border rounded-circle shadow-none philo-nav-btn" id="philoNextBtn" title="Berikutnya" style="width: 30px; height: 30px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-chevron-right" style="font-size: 0.8rem;"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Horizontal Sliding Track Viewport -->
                        <div class="philosophy-slider-viewport">
                            <div class="philosophy-slider-track" id="philosophySliderTrack">
                                @if(isset($philosophies) && $philosophies->count() > 0)
                                    @foreach($philosophies as $index => $philo)
                                        @php
                                            $pTitle = $currLocale === 'en' ? ($philo->title_en ?: $philo->title_id) : ($philo->title_id ?: $philo->title_en);
                                            $pSub = $currLocale === 'en' ? ($philo->subtitle_en ?: $philo->subtitle_id) : ($philo->subtitle_id ?: $philo->subtitle_en);
                                            $pDesc = $currLocale === 'en' ? ($philo->description_en ?: $philo->description_id) : ($philo->description_id ?: $philo->description_en);
                                            $pImg = $philo->image_path ? asset($philo->image_path) : '';
                                            $pKey = $philo->key ?: 'p_' . $philo->id;
                                        @endphp
                                        <div class="philosophy-slide p-3 p-md-4 d-flex flex-column justify-content-between" style="min-height: 290px;" data-slide-index="{{ $index }}" data-key="{{ $pKey }}">
                                            <div>
                                                <div class="d-flex align-items-center gap-3 mb-2">
                                                    <div class="philosophy-insight-icon">
                                                        <i class="bi {{ $philo->icon ?: 'bi-lightbulb-fill' }}"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fw-bold mb-0 text-dark">{{ $pTitle }}</h5>
                                                        <small class="text-danger fw-semibold">{{ $pSub }}</small>
                                                    </div>
                                                </div>
                                                @if(!empty($philo->image_path))
                                                    <div class="my-2 text-start">
                                                        <img src="{{ asset($philo->image_path) }}" alt="{{ $pTitle }}" class="img-fluid rounded-3 shadow-sm" style="max-height: 160px; width:auto; object-fit:contain;">
                                                    </div>
                                                @endif
                                                <p class="text-secondary mb-0 mt-2" style="font-size: 0.93rem; line-height: 1.6;">
                                                    {{ $pDesc }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="philosophy-slide p-3 p-md-4">
                                        <div class="d-flex align-items-center gap-3 mb-2">
                                            <div class="philosophy-insight-icon">
                                                <i class="bi bi-lightbulb-fill"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-0 text-dark">FILOSOFI</h5>
                                                <small class="text-danger fw-semibold">Fondasi Pemikiran Kreatif</small>
                                            </div>
                                        </div>
                                        <p class="text-secondary mb-0 mt-2" style="font-size: 0.93rem; line-height: 1.6;">
                                            Belum ada item filosofi.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Auto-cycle progress bar indicator -->
                        <div class="philosophy-progress-track">
                            <div class="philosophy-progress-bar" id="philoProgressBar"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 order-lg-1 text-center reveal-left">
                    @if(!empty($settings['philosophy_image']) && file_exists(public_path($settings['philosophy_image'])))
                        <div class="philosophy-custom-img-wrapper p-2">
                            <img src="{{ asset($settings['philosophy_image']) }}" 
                                 alt="Philosophy - {{ $settings['company_name'] ?? 'Boutique Design' }}" 
                                 class="img-fluid rounded-4 shadow-lg" 
                                 style="max-height: 440px; width: auto; object-fit: contain; transition: transform 0.3s ease;">
                        </div>
                    @else
                        <!-- Custom SVG representing Brain/Mind Cloud from Page 2 -->
                        <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" style="width:100%; max-width:420px; height:auto;">
                            <circle cx="250" cy="250" r="180" fill="none" stroke="#b0bec5" stroke-width="2" />
                            <circle cx="250" cy="250" r="130" fill="none" stroke="#b0bec5" stroke-width="2" stroke-dasharray="5 5" />
                            
                            <!-- Word cloud mapped inside circle (All Interactive) -->
                            <text class="svg-mind-tag" data-key="philosophy" x="250" y="240" font-size="28" font-weight="900" fill="#c62828" text-anchor="middle" letter-spacing="1">{{ app()->getLocale() === 'en' ? 'PHILOSOPHY' : 'FILOSOFI' }}</text>
                            <text class="svg-mind-tag" data-key="brain" x="250" y="270" font-size="18" font-weight="700" fill="#37474f" text-anchor="middle">{{ app()->getLocale() === 'en' ? 'MIND & BRAIN' : 'PIKIRAN & OTAK' }}</text>
                            
                            <text class="svg-mind-tag" data-key="collective" x="250" y="130" font-size="14" font-weight="600" fill="#78909c" text-anchor="middle">{{ app()->getLocale() === 'en' ? 'COLLECTIVE' : 'KOLEKTIF' }}</text>
                            <text class="svg-mind-tag" data-key="individual" x="250" y="380" font-size="14" font-weight="600" fill="#78909c" text-anchor="middle">{{ app()->getLocale() === 'en' ? 'INDIVIDUAL' : 'INDIVIDU' }}</text>
                            
                            <text class="svg-mind-tag" data-key="cognitive" x="140" y="200" font-size="13" font-weight="500" fill="#90a4ae" text-anchor="middle">{{ app()->getLocale() === 'en' ? 'COGNITIVE' : 'KOGNITIF' }}</text>
                            <text class="svg-mind-tag" data-key="neurons" x="360" y="200" font-size="13" font-weight="500" fill="#90a4ae" text-anchor="middle">{{ app()->getLocale() === 'en' ? 'NEURONS' : 'NEURON' }}</text>
                            
                            <text class="svg-mind-tag" data-key="psychology" x="140" y="300" font-size="13" font-weight="500" fill="#90a4ae" text-anchor="middle">{{ app()->getLocale() === 'en' ? 'PSYCHOLOGY' : 'PSIKOLOGI' }}</text>
                            <text class="svg-mind-tag" data-key="think" x="360" y="300" font-size="13" font-weight="500" fill="#90a4ae" text-anchor="middle">{{ app()->getLocale() === 'en' ? 'THINKING' : 'BERPIKIR' }}</text>
                            
                            <text class="svg-mind-tag" data-key="mental" x="250" y="175" font-size="12" font-weight="500" fill="#b0bec5" text-anchor="middle">{{ app()->getLocale() === 'en' ? 'MENTAL' : 'MENTAL' }}</text>
                            <text class="svg-mind-tag" data-key="body" x="250" y="330" font-size="12" font-weight="500" fill="#b0bec5" text-anchor="middle">{{ app()->getLocale() === 'en' ? 'BODY' : 'TUBUH' }}</text>
                            <text class="svg-mind-tag" data-key="ego" x="180" y="250" font-size="12" font-weight="500" fill="#b0bec5" text-anchor="middle">EGO</text>
                            <text class="svg-mind-tag" data-key="human" x="320" y="250" font-size="12" font-weight="500" fill="#b0bec5" text-anchor="middle">{{ app()->getLocale() === 'en' ? 'HUMAN' : 'MANUSIA' }}</text>

                            <!-- Brain outline in background -->
                            <path d="M250,90 C160,90 130,150 130,220 C130,280 160,330 210,340 C220,360 235,390 250,390 C265,390 280,360 290,340 C340,330 370,280 370,220 C370,150 340,90 250,90 Z" fill="none" stroke="#37474f" stroke-width="2" opacity="0.3" />
                        </svg>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section (What We Offer & What We Do) -->
    @php
        $servicesBgType = $settings['services_bg_type'] ?? 'image';
        $servicesBgImage = !empty($settings['services_bg_image']) ? $settings['services_bg_image'] : 'uploads/services-bg.jpg';
        $servicesBgVideo = !empty($settings['services_bg_video']) ? asset($settings['services_bg_video']) : (!empty($settings['services_bg_video_url']) ? $settings['services_bg_video_url'] : '');
        $servicesOverlayOpacityVal = isset($settings['services_overlay_opacity']) ? (int)$settings['services_overlay_opacity'] : 85;
        $servicesOverlayOpacity = $servicesOverlayOpacityVal / 100;
        $servicesOverlayColor = $settings['services_overlay_color'] ?? 'light';
        $isServicesVideoActive = ($servicesBgType === 'video' && !empty($servicesBgVideo));
    @endphp
    <section id="services" class="services-section {{ $servicesOverlayColor === 'dark' ? 'services-theme-dark' : '' }}"
             style="@if(!$isServicesVideoActive) background-image: url('{{ asset($servicesBgImage) }}'); @else background-color: #0f172a; @endif">
        @if($isServicesVideoActive)
            <div class="services-video-wrapper">
                <video class="services-bg-video" autoplay muted loop playsinline preload="auto" poster="{{ asset($servicesBgImage) }}">
                    <source src="{{ $servicesBgVideo }}">
                </video>
            </div>
        @endif
        <div class="services-bg-overlay {{ $servicesOverlayColor === 'dark' ? 'services-overlay-dark' : 'services-overlay-light' }}"
             style="--services-overlay-op: {{ $servicesOverlayOpacity }};"></div>
        <div class="container">
            <div class="section-title-wrapper reveal-up">
                <span class="section-subtitle">{{ __('messages.sections.services') }}</span>
                <h2 class="section-title"><span class="first-letter">{{ substr(__('messages.sections.what_offer'), 0, 1) }}</span>{{ substr(__('messages.sections.what_offer'), 1) }}</h2>
            </div>
            
            <div class="row g-4">
                @forelse($services as $service)
                    <div class="col-md-4 reveal-up" data-reveal-delay="{{ ($loop->index % 3 + 1) * 220 }}">
                        <div class="glass-card h-100">
                            @if(Str::contains(Str::lower($service->category), 'atl'))
                                <i class="bi bi-broadcast service-icon"></i>
                            @elseif(Str::contains(Str::lower($service->category), 'concept'))
                                <i class="bi bi-lightbulb service-icon"></i>
                            @else
                                <i class="bi bi-palette service-icon"></i>
                            @endif
                            <h3 class="service-title">{{ $service->title }}</h3>
                            <p class="service-description">{{ $service->description }}</p>
                            <span class="badge bg-secondary-subtle text-dark border px-3 py-2 rounded-pill mt-2" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:1px;">
                                @if($service->category === 'Concept')
                                    {{ app()->getLocale() === 'en' ? 'Creative / Media Concept' : 'Konsep Kreatif / Media' }}
                                @elseif($service->category === 'Graphic Design Concept')
                                    {{ app()->getLocale() === 'en' ? 'Graphic Design Concept' : 'Konsep Desain Grafis' }}
                                @else
                                    {{ $service->category }}
                                @endif
                            </span>
                        </div>
                    </div>
                @empty
                    <!-- Fallback default services -->
                    <div class="col-md-4 reveal-up reveal-delay-1">
                        <div class="glass-card h-100">
                            <i class="bi bi-broadcast service-icon"></i>
                            <h3 class="service-title">ATL & BTL Campaign</h3>
                            <p class="service-description">Full service campaign coordination targeting both Above The Line (broad reach) and Below The Line (niche activations) marketing channels.</p>
                            <span class="badge bg-secondary-subtle text-dark border px-3 py-2 rounded-pill mt-2" style="font-size:0.75rem;">ATL & BTL</span>
                        </div>
                    </div>
                    <div class="col-md-4 reveal-up reveal-delay-2">
                        <div class="glass-card h-100">
                            <i class="bi bi-lightbulb service-icon"></i>
                            <h3 class="service-title">Creative Concept</h3>
                            <p class="service-description">Development campaign of TVC commercials, print flyers, point of sale templates, radio programs, and corporate profile videos.</p>
                            <span class="badge bg-secondary-subtle text-dark border px-3 py-2 rounded-pill mt-2" style="font-size:0.75rem;">Concept</span>
                        </div>
                    </div>
                    <div class="col-md-4 reveal-up reveal-delay-3">
                        <div class="glass-card h-100">
                            <i class="bi bi-palette service-icon"></i>
                            <h3 class="service-title">Graphic Design</h3>
                            <p class="service-description">Logo and icon device campaign assets creation, storyboard rendering, and elegant designs for simple packaging models.</p>
                            <span class="badge bg-secondary-subtle text-dark border px-3 py-2 rounded-pill mt-2" style="font-size:0.75rem;">Graphic Design Concept</span>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Approach Detail (What We Do from Page 4 and 5) -->
            <div class="row mt-5 pt-5 align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 reveal-left">
                    <div class="glass-card">
                        <h4 class="h3 fw-bold text-dark mb-4"><span class="text-danger" style="font-style: italic; font-weight:900;">{{ substr(__('messages.approach.listener_title'), 0, 1) }}</span>{{ substr(__('messages.approach.listener_title'), 1) }}</h4>
                        <p class="text-secondary leading-relaxed">
                            {{ __('messages.approach.listener_desc') }}
                        </p>
                        
                        <hr class="my-4" style="border-color: rgba(0,0,0,0.1);">
                        
                        <h4 class="h3 fw-bold text-dark mb-4"><span class="text-danger" style="font-style: italic; font-weight:900;">{{ substr(__('messages.approach.balance_title'), 0, 1) }}</span>{{ substr(__('messages.approach.balance_title'), 1) }}</h4>
                        <p class="text-secondary leading-relaxed">
                            {{ __('messages.approach.balance_desc') }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 reveal-right">
                    <!-- Recreating Diagrams from page 4 & 5 (Marketing & Development charts) -->
                    <div class="row g-4 text-center">
                        <div class="col-md-6">
                            <div class="bg-light p-4 rounded-4 shadow-sm service-diagram-card">
                                <h5 class="fw-bold mb-3" style="font-size:0.95rem; text-transform:uppercase; letter-spacing:1px; color:#546e7a;">{{ __('messages.graphs.marketing_campaign') }}</h5>
                                <svg viewBox="0 0 200 150" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:auto;">
                                    <!-- Grid lines -->
                                    <line x1="20" y1="130" x2="180" y2="130" stroke="#b0bec5" stroke-width="2" />
                                    <line x1="20" y1="130" x2="20" y2="20" stroke="#b0bec5" stroke-width="2" />
                                    <!-- Animated Graph Line -->
                                    <path class="animated-path" d="M20,120 L60,95 L100,105 L140,55 L180,30" fill="none" stroke="#c62828" stroke-width="4" stroke-linecap="round" />
                                    <!-- Nodes -->
                                    <circle cx="20" cy="120" r="5" fill="#37474f" />
                                    <circle cx="60" cy="95" r="5" fill="#37474f" />
                                    <circle cx="100" cy="105" r="5" fill="#37474f" />
                                    <circle cx="140" cy="55" r="5" fill="#37474f" />
                                    <circle cx="180" cy="30" r="5" fill="#37474f" />
                                    <!-- Text -->
                                    <text x="180" y="20" font-size="10" font-weight="700" fill="#37474f" text-anchor="end">{{ __('messages.graphs.success') }}</text>
                                    <text x="100" y="145" font-size="11" font-weight="600" fill="#546e7a" text-anchor="middle">{{ __('messages.graphs.marketing') }}</text>
                                </svg>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-4 rounded-4 shadow-sm service-diagram-card">
                                <h5 class="fw-bold mb-3" style="font-size:0.95rem; text-transform:uppercase; letter-spacing:1px; color:#546e7a;">{{ __('messages.graphs.dev_motivation') }}</h5>
                                <svg viewBox="0 0 200 150" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:auto;">
                                    <!-- Divided Pie Concept from Page 5 -->
                                    <circle cx="100" cy="70" r="50" fill="none" stroke="#78909c" stroke-width="2" />
                                    <!-- Slices -->
                                    <line x1="100" y1="70" x2="100" y2="20" stroke="#78909c" stroke-width="2" />
                                    <line x1="100" y1="70" x2="148" y2="85" stroke="#78909c" stroke-width="2" />
                                    <line x1="100" y1="70" x2="52" y2="85" stroke="#78909c" stroke-width="2" />
                                    
                                    <!-- Slice shading representation -->
                                    <path d="M100,70 L100,20 A50,50 0 0,1 148,85 Z" fill="#c62828" opacity="0.1" />
                                    <path d="M100,70 L148,85 A50,50 0 0,1 52,85 Z" fill="#ffd54f" opacity="0.15" />
                                    
                                    <!-- Curving arrow -->
                                    <path d="M35,115 C55,135 145,135 165,115" fill="none" stroke="#37474f" stroke-width="3" stroke-dasharray="4 4" />
                                    <polygon points="165,115 155,112 162,122" fill="#37474f" />
                                    
                                    <text x="100" y="145" font-size="11" font-weight="600" fill="#546e7a" text-anchor="middle">{{ __('messages.graphs.development') }}</text>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section (Who We Are) -->
    <section id="team">
        <div class="container">
            <div class="section-title-wrapper team-title-animate reveal-up">
                <span class="section-subtitle">{{ app()->getLocale() === 'en' ? 'Meet Our Professionals' : 'Temui Profesional Kami' }}</span>
                <h2 class="section-title"><span class="first-letter">{{ app()->getLocale() === 'en' ? 'W' : 'S' }}</span>{{ app()->getLocale() === 'en' ? 'ho We Are' : 'iapa Kami' }}</h2>
            </div>

            @php
                $leaders = $team->filter(function($m) {
                    return in_array(strtolower(trim($m->role_en ?? '')), ['director', 'creative director']) 
                        || in_array(strtolower(trim($m->role_id ?? '')), ['direktur', 'direktur kreatif'])
                        || (int)$m->priority <= 2;
                });
                $leaderIds = $leaders->pluck('id')->toArray();
                $otherMembers = $team->reject(function($m) use ($leaderIds) {
                    return in_array($m->id, $leaderIds);
                });
            @endphp

            <!-- Founders Spotlight (Director & Creative Director) -->
            <div class="row g-4 mb-5 justify-content-center">
                @foreach($leaders as $leader)
                    <div class="col-lg-6 team-animate-item reveal-up reveal-delay-{{ $loop->iteration }}">
                        <div class="leader-card">
                            <div class="row align-items-center">
                                <div class="col-md-5 text-center text-md-start d-flex justify-content-center">
                                    <div class="leader-avatar-wrapper">
                                        @if($leader->photo_path)
                                            <img src="{{ asset($leader->photo_path) }}" class="leader-avatar" alt="{{ $leader->name }}">
                                        @else
                                            <div class="team-avatar-placeholder">
                                                {{ collect(explode(' ', $leader->name))->map(fn($n) => $n[0])->take(2)->implode('') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-7 mt-3 mt-md-0">
                                    <h4 class="team-name mb-1">{{ $leader->name }}</h4>
                                    <div class="team-role">{{ $leader->role }}</div>
                                    <a href="tel:{{ $leader->phone }}" class="team-phone"><i class="bi bi-telephone me-2"></i>{{ $leader->phone }}</a>
                                    <div class="leader-quote">
                                        {{ $leader->quote ?? 'Idea are everywhere.' }}
                                    </div>
                                    <p class="leader-desc mb-0">
                                        {{ $leader->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Team Grid -->
            <div class="row g-4 justify-content-center">
                @foreach($otherMembers as $member)
                    <div class="col-sm-6 col-md-4 col-lg-3 team-animate-item reveal-up reveal-delay-{{ ($loop->index % 4) + 1 }}">
                        <div class="team-card">
                            <div class="team-avatar-wrapper">
                                @if($member->photo_path)
                                    <img src="{{ asset($member->photo_path) }}" class="team-avatar" alt="{{ $member->name }}">
                                @else
                                    <div class="team-avatar-placeholder">
                                        {{ collect(explode(' ', $member->name))->map(fn($n) => $n[0])->take(2)->implode('') }}
                                    </div>
                                @endif
                            </div>
                            <h4 class="team-name">{{ $member->name }}</h4>
                            <div class="team-role">{{ $member->role }}</div>
                            @if($member->phone)
                                <a href="tel:{{ $member->phone }}" class="team-phone"><i class="bi bi-telephone me-2"></i>{{ $member->phone }}</a>
                            @endif
                            @if($member->quote)
                                <div class="team-quote">
                                    "{{ $member->quote }}"
                                </div>
                            @endif
                            @if($member->description)
                                <p class="team-desc mb-0">
                                    {{ $member->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Portfolio Section (What We Have Done) -->
    <section id="portfolio" class="bg-white">
        <div class="container">
            <div class="section-title-wrapper reveal-up">
                <span class="section-subtitle">{{ __('messages.sections.masterpieces') }}</span>
                <h2 class="section-title"><span class="first-letter">{{ substr(__('messages.sections.what_done'), 0, 1) }}</span>{{ substr(__('messages.sections.what_done'), 1) }}</h2>
            </div>

            <!-- Categories Filter -->
            <div class="text-center mb-5 reveal-up reveal-delay-1">
                <button class="portfolio-filter-btn active" data-filter="all">{{ __('messages.portfolio.all_work') }}</button>
                @foreach($portfolios->unique(fn($p) => $p->title) as $filterWork)
                    <button class="portfolio-filter-btn" data-filter="{{ \Illuminate\Support\Str::slug($filterWork->title_en ?: $filterWork->title_id) }}">{{ $filterWork->title }}</button>
                @endforeach
            </div>

            <!-- Work Grid -->
            <div class="row g-4">
                @forelse($portfolios as $work)
                    @php
                        $images = $work->images && $work->images->count() > 0 
                            ? $work->images 
                            : ($work->image_path ? collect([(object)['image_path' => $work->image_path]]) : collect());
                        $hasImages = $images->count() > 0;
                        $firstImage = $hasImages ? $images->first()->image_path : null;
                    @endphp
                    <div class="col-12 col-md-6 col-lg-4 portfolio-item-col portfolio-animate-item reveal-up reveal-delay-{{ ($loop->index % 3) + 1 }}" data-category="{{ \Illuminate\Support\Str::slug($work->title_en ?: $work->title_id) }}">
                        <div class="portfolio-card {{ $hasImages ? 'has-lightbox' : '' }}"
                             role="button"
                             tabindex="0"
                             title="{{ app()->getLocale() == 'id' ? 'Klik untuk membuka gambar' : 'Click to view image' }}">
                            <div class="portfolio-img-wrapper">
                                <span class="portfolio-badge">{{ $work->title }}</span>
                                @if($images->count() > 1)
                                    <span class="portfolio-badge-count">
                                        <i class="bi bi-images"></i> {{ $images->count() }}
                                    </span>
                                    <div id="portfolioCarousel-{{ $work->id }}" class="carousel slide carousel-fade w-100 h-100" data-bs-ride="carousel" data-bs-interval="3000">
                                        <div class="carousel-indicators">
                                            @foreach($images as $imgIdx => $img)
                                                <button type="button" data-bs-target="#portfolioCarousel-{{ $work->id }}" data-bs-slide-to="{{ $imgIdx }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $imgIdx + 1 }}"></button>
                                            @endforeach
                                        </div>
                                        <div class="carousel-inner w-100 h-100">
                                            @foreach($images as $imgIdx => $img)
                                                <div class="carousel-item w-100 h-100 {{ $loop->first ? 'active' : '' }}"
                                                     data-lightbox-src="{{ asset($img->image_path) }}"
                                                     data-lightbox-title="{{ $work->title }}"
                                                     data-lightbox-desc="{{ $work->description }}">
                                                    <img src="{{ asset($img->image_path) }}" class="portfolio-img w-100 h-100" style="object-fit: cover;" alt="{{ $work->title }}" loading="lazy">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="portfolio-img-overlay">
                                        <span class="portfolio-zoom-btn">
                                            <i class="bi bi-arrows-fullscreen"></i>
                                            <span>{{ app()->getLocale() == 'id' ? 'Buka Galeri' : 'View Gallery' }} ({{ $images->count() }})</span>
                                        </span>
                                    </div>
                                @elseif($hasImages)
                                    <div class="w-100 h-100" data-lightbox-src="{{ asset($firstImage) }}" data-lightbox-title="{{ $work->title }}" data-lightbox-desc="{{ $work->description }}">
                                        <img src="{{ asset($firstImage) }}" class="portfolio-img" alt="{{ $work->title }}" loading="lazy">
                                    </div>
                                    <div class="portfolio-img-overlay">
                                        <span class="portfolio-zoom-btn">
                                            <i class="bi bi-arrows-fullscreen"></i>
                                            <span>{{ app()->getLocale() == 'id' ? 'Buka Gambar' : 'View Image' }}</span>
                                        </span>
                                    </div>
                                @else
                                    <div class="portfolio-placeholder">
                                        @if(str_contains(strtolower($work->title_en ?? ''), 'neon'))
                                            <i class="bi bi-lightbulb-fill"></i>
                                        @elseif(str_contains(strtolower($work->title_en ?? ''), 'billboard') || str_contains(strtolower($work->title_id ?? ''), 'baliho'))
                                            <i class="bi bi-aspect-ratio"></i>
                                        @elseif(str_contains(strtolower($work->title_en ?? ''), 'sign') || str_contains(strtolower($work->title_id ?? ''), 'papan'))
                                            <i class="bi bi-signpost-split"></i>
                                        @elseif(str_contains(strtolower($work->title_en ?? ''), 'print') || str_contains(strtolower($work->title_id ?? ''), 'cetak'))
                                            <i class="bi bi-printer"></i>
                                        @elseif(str_contains(strtolower($work->title_en ?? ''), 'gimmick') || str_contains(strtolower($work->title_id ?? ''), 'merchandise'))
                                            <i class="bi bi-gift"></i>
                                        @else
                                            <i class="bi bi-image"></i>
                                        @endif
                                        <div class="fw-bold">{{ $work->title }}</div>
                                        <div class="small">Boutique Design Indonesia</div>
                                    </div>
                                @endif
                            </div>
                            <div class="portfolio-info">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="portfolio-title mb-0">{{ $work->title }}</h4>
                                    @if($hasImages)
                                        <span class="portfolio-card-zoom-icon" title="{{ app()->getLocale() == 'id' ? 'Buka Gambar' : 'View Image' }}">
                                            <i class="bi bi-zoom-in"></i>
                                        </span>
                                    @endif
                                </div>
                                <p class="portfolio-desc mt-2">{{ $work->description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-secondary py-5">
                        {{ __('messages.portfolio.no_records') }}
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Clients Section -->
    @if(isset($clients) && count($clients) > 0)
    <section id="clients" class="py-5 bg-light">
        <div class="container py-4">
            <div class="section-title-wrapper text-center mb-5 reveal-up">
                <span class="section-subtitle">Partners & Brands</span>
                <h2 class="section-title">
                    <span class="first-letter">O</span>ur Clients
                </h2>
            </div>
        @php
            $count = $clients->count();
            if ($count > 6) {
                $half = ceil($count / 2);
                $row1Clients = $clients->take($half);
                $row2Clients = $clients->skip($half);
            } else {
                $row1Clients = $clients;
                $row2Clients = collect();
            }
        @endphp

        <div class="client-marquee-wrapper reveal-zoom reveal-delay-1">
            <!-- Row 1: Marquee moving to the left -->
            <div class="client-marquee-container" title="{{ app()->getLocale() == 'id' ? 'Arahkan kursor untuk menjeda animasi' : 'Hover to pause animation' }}">
                <div class="client-marquee-track scroll-left">
                    {{-- 2 identical groups translating -50% for 100% seamless infinite loop --}}
                    @for($track = 0; $track < 2; $track++)
                        <div class="client-marquee-group" @if($track > 0) aria-hidden="true" @endif>
                            @for($rep = 0; $rep < 3; $rep++)
                                @foreach($row1Clients as $client)
                                    <div class="client-marquee-item text-center">
                                        <div class="client-logo-wrapper mb-2 d-flex align-items-center justify-content-center">
                                            @if($client->logo)
                                                <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}" class="img-fluid client-logo" style="{{ $client->logo_width ? 'max-width:'.$client->logo_width.'px;' : '' }}{{ $client->logo_height ? ' max-height:'.$client->logo_height.'px;' : '' }}">
                                            @else
                                                <div class="fw-bold text-muted client-name">{{ $client->name }}</div>
                                            @endif
                                        </div>
                                        @if($client->productImages->count() > 0)
                                            <div class="client-products-box mt-2 d-flex flex-wrap justify-content-center gap-2 pt-2">
                                                @foreach($client->productImages as $product)
                                                    <img src="{{ asset($product->image) }}" 
                                                         alt="Product {{ $client->name }}" 
                                                         class="img-fluid rounded shadow-sm client-product-img" 
                                                         style="{{ $product->width ? 'max-width:'.$product->width.'px;' : 'max-width: 120px;' }}{{ $product->height ? ' max-height:'.$product->height.'px;' : ' max-height: 100px;' }} object-fit: contain; transition: all 0.3s ease;">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endfor
                        </div>
                    @endfor
                </div>
            </div>

            @if($row2Clients->count() > 0)
                <div class="container my-3">
                    <hr class="client-divider">
                </div>

                <!-- Row 2: Marquee moving to the right -->
                <div class="client-marquee-container" title="{{ app()->getLocale() == 'id' ? 'Arahkan kursor untuk menjeda animasi' : 'Hover to pause animation' }}">
                    <div class="client-marquee-track scroll-right">
                        @for($track = 0; $track < 2; $track++)
                            <div class="client-marquee-group" @if($track > 0) aria-hidden="true" @endif>
                                @for($rep = 0; $rep < 3; $rep++)
                                    @foreach($row2Clients as $client)
                                        <div class="client-marquee-item text-center">
                                            <div class="client-logo-wrapper mb-2 d-flex align-items-center justify-content-center">
                                                @if($client->logo)
                                                    <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}" class="img-fluid client-logo" style="{{ $client->logo_width ? 'max-width:'.$client->logo_width.'px;' : '' }}{{ $client->logo_height ? ' max-height:'.$client->logo_height.'px;' : '' }}">
                                                @else
                                                    <div class="fw-bold text-muted client-name">{{ $client->name }}</div>
                                                @endif
                                            </div>
                                            @if($client->productImages->count() > 0)
                                                <div class="client-products-box mt-2 d-flex flex-wrap justify-content-center gap-2 pt-2">
                                                    @foreach($client->productImages as $product)
                                                        <img src="{{ asset($product->image) }}" 
                                                             alt="Product {{ $client->name }}" 
                                                             class="img-fluid rounded shadow-sm client-product-img" 
                                                             style="{{ $product->width ? 'max-width:'.$product->width.'px;' : 'max-width: 120px;' }}{{ $product->height ? ' max-height:'.$product->height.'px;' : ' max-height: 100px;' }} object-fit: contain; transition: all 0.3s ease;">
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            @endif

            <div class="container mt-3">
                <hr class="client-divider">
            </div>
        </div>
    </section>
    <style>
        .client-marquee-wrapper {
            position: relative;
            width: 100%;
        }
        .client-marquee-container {
            overflow: hidden;
            position: relative;
            width: 100%;
            padding: 10px 0;
            mask-image: linear-gradient(to right, transparent 0%, black 5%, black 95%, transparent 100%);
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 5%, black 95%, transparent 100%);
        }
        .client-marquee-track {
            display: flex;
            width: max-content;
            will-change: transform;
        }
        .client-marquee-track.scroll-left {
            animation: clientScrollLeft 48s linear infinite;
        }
        .client-marquee-track.scroll-right {
            animation: clientScrollRight 48s linear infinite;
        }
        .client-marquee-container:hover .client-marquee-track {
            animation-play-state: paused;
        }
        .client-marquee-group {
            display: flex;
            align-items: flex-start;
            flex-shrink: 0;
        }
        .client-marquee-item {
            width: 220px;
            margin: 0 25px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            user-select: none;
        }
        .client-logo-wrapper {
            min-height: 80px;
            height: 80px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .client-logo {
            max-height: 75px;
            max-width: 170px;
            object-fit: contain;
            transition: transform 0.4s ease;
        }
        .client-marquee-item:hover .client-logo {
            transform: scale(1.12);
        }
        .client-name {
            font-size: 1.1rem;
            font-weight: 700;
            opacity: 0.7;
            transition: all 0.4s ease;
        }
        .client-marquee-item:hover .client-name {
            opacity: 1;
            color: var(--accent-red, #dc3545) !important;
        }
        .client-products-box {
            border-top: 2px solid #000;
            width: 100%;
            padding-top: 8px;
            margin-top: 8px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 6px;
        }
        .client-product-img {
            transition: transform 0.3s ease;
            object-fit: contain;
        }
        .client-marquee-item:hover .client-product-img {
            transform: scale(1.06);
        }
        .client-divider {
            border: none;
            border-top: 2px solid #000;
            margin: 0;
            width: 100%;
            opacity: 1;
        }
        @keyframes clientScrollLeft {
            0% {
                transform: translate3d(0, 0, 0);
            }
            100% {
                transform: translate3d(-50%, 0, 0);
            }
        }
        @keyframes clientScrollRight {
            0% {
                transform: translate3d(-50%, 0, 0);
            }
            100% {
                transform: translate3d(0, 0, 0);
            }
        }
        @media (max-width: 768px) {
            .client-marquee-item {
                width: 160px;
                margin: 0 15px;
            }
            .client-logo-wrapper {
                min-height: 60px;
                height: 60px;
            }
            .client-logo {
                max-height: 55px;
                max-width: 130px;
            }
            .client-marquee-track.scroll-left,
            .client-marquee-track.scroll-right {
                animation-duration: 35s;
            }
        }
    </style>
    @endif

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="section-title-wrapper reveal-up">
                <span class="section-subtitle">{{ __('messages.sections.get_touch') }}</span>
                <h2 class="section-title">
                    <span class="first-letter">{{ substr($settings['slogan_sub_' . app()->getLocale()] ?? $settings['slogan_sub_en'] ?? 'g', 0, 1) }}</span>{{ substr($settings['slogan_sub_' . app()->getLocale()] ?? $settings['slogan_sub_en'] ?? 'rab even bigger ideas with us', 1) }}
                </h2>
            </div>

            <div class="row g-5">
                <!-- Contact Details -->
                <div class="col-lg-5 reveal-left">
                    <div class="glass-card h-100">
                        <h4 class="fw-bold mb-4" style="font-size: 1.5rem;">{{ app()->getLocale() === 'en' ? 'Office Info' : 'Info Kantor' }}</h4>
                        
                        <div class="contact-info-wrapper">
                            <div class="contact-item">
                                <div class="contact-icon"><i class="bi bi-geo-alt"></i></div>
                                <div class="contact-details">
                                    <h5>{{ __('messages.fields.office_address') }}</h5>
                                    <p class="mb-2">{{ $settings['address'] ?? 'Jl. Persatuan No.5C, RT.2/RW.4, Sukabumi Sel., Kec. Kebayoran Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 11560' }}</p>
                                    <a href="https://maps.google.com/?q={{ urlencode($settings['address'] ?? 'Jl. Persatuan No.5C, RT.2/RW.4, Sukabumi Sel., Kec. Kebayoran Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 11560') }}" target="_blank" rel="noopener noreferrer" class="btn-maps-link">
                                        <i class="bi bi-geo-alt-fill me-1"></i>
                                        <span>{{ __('messages.fields.view_on_maps') }}</span>
                                        <i class="bi bi-box-arrow-up-right ms-1" style="font-size:0.72rem;"></i>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon"><i class="bi bi-telephone"></i></div>
                                <div class="contact-details">
                                    <h5>{{ __('messages.fields.phone') }}</h5>
                                    <p><a href="tel:{{ $settings['phone'] ?? '021-53668592' }}">{{ $settings['phone'] ?? '021-53668592' }}</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon"><i class="bi bi-envelope"></i></div>
                                <div class="contact-details">
                                    <h5>{{ __('messages.fields.email') }}</h5>
                                    @php
                                        $rawEmailsJson = $settings['company_emails'] ?? null;
                                        $allCompanyEmails = !empty($rawEmailsJson) ? json_decode($rawEmailsJson, true) : null;
                                        if (!is_array($allCompanyEmails) || empty($allCompanyEmails)) {
                                            $allCompanyEmails = !empty($settings['email']) ? [$settings['email']] : ['info@boutiquedesign.com'];
                                        }
                                    @endphp
                                    @foreach($allCompanyEmails as $em)
                                        <p class="mb-1"><a href="mailto:{{ $em }}">{{ $em }}</a></p>
                                    @endforeach
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon"><i class="bi bi-shield-check"></i></div>
                                <div class="contact-details">
                                    <h5>{{ __('messages.fields.npwp') }}</h5>
                                    <p>{{ $settings['npwp'] ?? '70.007.006.3-035.000' }}</p>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        
                        <h5 class="fw-bold mb-3" style="font-size: 1.1rem;">{{ __('messages.sections.direct_contacts') }}</h5>
                        @php
                            $rawJson = $settings['direct_contacts'] ?? null;
                            $jsonContacts = ($rawJson !== null) ? json_decode($rawJson, true) : null;
                            if (is_array($jsonContacts)) {
                                $directContacts = $jsonContacts;
                            } else {
                                $directContacts = [];
                                for ($i = 1; $i <= 4; $i++) {
                                    $n = trim((string)($settings["contact_person_{$i}_name"] ?? ''));
                                    $p = trim((string)($settings["contact_person_{$i}_phone"] ?? ''));
                                    if (!empty($n) || !empty($p)) {
                                        $directContacts[] = ['name' => $n, 'phone' => $p];
                                    }
                                }
                            }
                        @endphp
                        <div class="direct-contact-list">
                            @foreach($directContacts as $cp)
                                @if(!empty(trim($cp['name'])) && !empty(trim($cp['phone'])))
                                    @php
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $cp['phone']);
                                        if (substr($cleanPhone, 0, 1) === '0') {
                                            $cleanPhone = '62' . substr($cleanPhone, 1);
                                        } elseif (substr($cleanPhone, 0, 2) !== '62') {
                                            $cleanPhone = '62' . $cleanPhone;
                                        }
                                        $waText = urlencode("Halo " . $cp['name'] . ", saya ingin berkonsultasi mengenai layanan Boutique Design.");
                                        $waUrl = "https://wa.me/" . $cleanPhone . "?text=" . $waText;
                                    @endphp
                                    <div class="direct-contact-item">
                                        <div class="direct-contact-info">
                                            <div class="contact-name">{{ $cp['name'] }}</div>
                                            <div class="contact-num">{{ $cp['phone'] }}</div>
                                        </div>
                                        <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="btn-wa-direct" title="Chat {{ $cp['name'] }} via WhatsApp">
                                            <i class="bi bi-whatsapp"></i>
                                            <span>{{ __('messages.fields.wa_now') ?? 'WA Sekarang' }}</span>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7 reveal-right">
                    <div class="glass-card">
                        <h4 class="fw-bold mb-4" style="font-size: 1.5rem;">{{ __('messages.sections.drop_message') }}</h4>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show border-0 rounded-4 p-4 mb-4" role="alert" style="background: rgba(76, 175, 80, 0.15); color: #2e7d32;">
                                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            {{-- Cyber Security: Anti-Bot Honeypot Trap (Invisible to humans, traps bots) --}}
                            <div style="display:none !important; position:absolute !important; left:-9999px !important;" aria-hidden="true">
                                <input type="text" name="b_security_verification_field" tabindex="-1" autocomplete="off" value="">
                                <input type="hidden" name="_sec_token_time" value="{{ time() }}">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label small fw-bold text-secondary">{{ __('messages.fields.your_name') }} *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label for="contact_email" class="form-label small fw-bold text-secondary mb-0">{{ __('messages.fields.your_email') }} *</label>
                                        <span id="contactEmailBadge" class="small fw-semibold" style="display: none; font-size: 0.82rem;"></span>
                                    </div>
                                    <div class="position-relative">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="contact_email" name="email" placeholder="Email harus valid!" value="{{ old('email') }}" required style="padding-right: 44px;">
                                        <span id="contactEmailSpinner" class="spinner-border spinner-border-sm text-secondary" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); display: none;" role="status"></span>
                                        <span id="contactEmailIcon" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); display: none;"></span>
                                    </div>
                                    <div id="contactEmailFeedback" class="small mt-1 fw-medium" style="display: none; font-size: 0.84rem;"></div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label for="phone" class="form-label small fw-bold text-secondary mb-0">{{ __('messages.fields.phone_number') }} *</label>
                                        <span id="contactPhoneBadge" class="small fw-semibold" style="display: none; font-size: 0.82rem;"></span>
                                    </div>
                                    <div class="position-relative">
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="contact_phone" name="phone" placeholder="No. Telepon harus valid" value="{{ old('phone') }}" required style="padding-right: 44px;">
                                        <span id="contactPhoneSpinner" class="spinner-border spinner-border-sm text-secondary" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); display: none;" role="status"></span>
                                        <span id="contactPhoneIcon" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); display: none;"></span>
                                    </div>
                                    <div id="contactPhoneFeedback" class="small mt-1 fw-medium" style="display: none; font-size: 0.84rem;"></div>
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="subject" class="form-label small fw-bold text-secondary">{{ __('messages.fields.subject') }}</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Project Inquiry" value="{{ old('subject') }}">
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label small fw-bold text-secondary">{{ __('messages.fields.your_message') }} *</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="{{ app()->getLocale() === 'en' ? 'How can we help you get fresh ideas?' : 'Bagaimana kami dapat membantu Anda mendapatkan ide-ide segar?' }}" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mt-4">
                                    @php
                                        $btnTextString = __('messages.fields.send_message');
                                        $btnChars = mb_str_split($btnTextString);
                                    @endphp
                                    <button type="submit" id="btnSubmitContact" class="btn-submit" disabled style="opacity: 0.6; cursor: not-allowed;">
                                        <span class="btn-wave-text">
                                            @foreach($btnChars as $charIdx => $char)
                                                <span class="wave-char" style="animation-delay: {{ $charIdx * 0.09 }}s;">{!! $char === ' ' ? '&nbsp;' : e($char) !!}</span>
                                            @endforeach
                                        </span>
                                        <i class="bi bi-send ms-2"></i>
                                    </button>
                                    <div id="contactFormWarning" class="small text-danger mt-2 fw-medium" style="display: none;">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Mohon pastikan alamat email dan nomor telepon telah diisi dengan benar & valid agar pesan dapat dikirim.
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-7 reveal-up">
                    <a class="d-inline-flex align-items-center text-decoration-none mb-3" href="#">
                        <img src="{{ asset('uploads/logo.png') }}" alt="Boutique Design" style="height: 52px; width: auto; filter: brightness(0) invert(1);">
                    </a>
                    <p class="footer-text mb-4">
                        {{ __('messages.footer.desc') }}
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ $settings['instagram_url'] ?? 'https://www.instagram.com/boutiquedesign_indonesia?stkn=a2RnMG51Z2FjZDg0' }}" target="_blank" rel="noopener noreferrer" class="footer-ig-btn" title="Instagram Boutique Design Indonesia" aria-label="Instagram Boutique Design Indonesia"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom text-center">
                <p class="mb-0">&copy; {{ date('Y') }} {{ $settings['company_name'] ?? 'Boutique Design Indonesia' }}. {{ __('messages.footer.rights') }}</p>
            </div>
        </div>
    </footer>

    <!-- Portfolio Image Lightbox Modal -->
    <div id="portfolioLightbox" class="portfolio-lightbox" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="portfolio-lightbox-backdrop"></div>
        <div class="portfolio-lightbox-container">
            <!-- Header bar with counter & close button -->
            <div class="portfolio-lightbox-header">
                <div class="portfolio-lightbox-counter" id="lightboxCounter">1 / 1</div>
                <button type="button" class="portfolio-lightbox-close" id="lightboxCloseBtn" aria-label="Tutup / Close (Esc)" title="Tutup (Esc)">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <!-- Body with Prev / Image / Next -->
            <div class="portfolio-lightbox-body">
                <button type="button" class="portfolio-lightbox-nav portfolio-lightbox-prev" id="lightboxPrevBtn" aria-label="Sebelumnya" title="Sebelumnya (←)">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="portfolio-lightbox-img-wrapper" id="lightboxImgWrapper">
                    <img id="lightboxImage" src="" alt="Portfolio Image" class="portfolio-lightbox-img">
                    <div class="portfolio-lightbox-caption" id="lightboxCaption">
                        <h4 id="lightboxTitle" class="portfolio-lightbox-title"></h4>
                        <p id="lightboxDesc" class="portfolio-lightbox-desc"></p>
                    </div>
                </div>

                <button type="button" class="portfolio-lightbox-nav portfolio-lightbox-next" id="lightboxNextBtn" aria-label="Selanjutnya" title="Selanjutnya (→)">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS (Filtering & Animations) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ================= PORTFOLIO STAGGERED ONE-BY-ONE ANIMATION (BOUTIQUE LOGO STYLE) =================
            const portfolioSection = document.getElementById('portfolio');
            let portfolioStaggerTimers = [];
            let portfolioHasEntered = false;

            function resetPortfolioAnimation() {
                portfolioStaggerTimers.forEach(t => clearTimeout(t));
                portfolioStaggerTimers = [];
                if (portfolioSection) {
                    const items = portfolioSection.querySelectorAll('.portfolio-animate-item');
                    items.forEach(item => item.classList.remove('animate-in'));
                }
            }

            // ================= ZERO-REFLOW ACTIVE NAV LINK TRACKER =================
            const navLinks = document.querySelectorAll('.nav-link');
            const navSections = document.querySelectorAll('header, section[id]');
            if ('IntersectionObserver' in window && navSections.length > 0) {
                const navSpyObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const id = entry.target.getAttribute('id');
                            if (id) {
                                navLinks.forEach(link => {
                                    if (link.getAttribute('href') === `#${id}`) {
                                        link.classList.add('active');
                                    } else {
                                        link.classList.remove('active');
                                    }
                                });
                            }
                        }
                    });
                }, {
                    root: null,
                    threshold: 0.15,
                    rootMargin: '-20% 0px -55% 0px'
                });
                navSections.forEach(s => navSpyObserver.observe(s));
            }

            // ================= PORTFOLIO FILTERING =================
            const filterBtns = document.querySelectorAll('.portfolio-filter-btn');
            const portfolioItems = document.querySelectorAll('.portfolio-item-col');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');

                    portfolioItems.forEach(item => {
                        if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                            item.style.display = 'block';
                            // Re-trigger reveal animation secara mulus
                            item.classList.remove('revealed');
                            setTimeout(() => {
                                item.classList.add('revealed');
                            }, 50);
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });

            // ================= GLOBAL SCROLL REVEAL CONTROLLER (60FPS HARDWARE ACCELERATED) =================
            const revealElements = document.querySelectorAll(
                '.reveal, .reveal-up, .reveal-down, .reveal-left, .reveal-right, .reveal-zoom, .reveal-fade'
            );

            if (revealElements.length > 0) {
                // Aktifkan CSS reveal state
                document.body.classList.add('reveal-init');

                if ('IntersectionObserver' in window) {
                    const scrollRevealObserver = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const delay = entry.target.getAttribute('data-reveal-delay');
                                if (delay) {
                                    entry.target.style.transitionDelay = `${delay}ms`;
                                }
                                entry.target.classList.add('revealed');
                                // Sekali elemen terlihat di layar, biarkan tetap tampil stabil di semua device (PC, Laptop, HP)
                                scrollRevealObserver.unobserve(entry.target);
                            }
                        });
                    }, {
                        root: null,
                        threshold: 0.02,
                        rootMargin: '30px 0px 30px 0px'
                    });

                    revealElements.forEach(el => scrollRevealObserver.observe(el));

                    // Langsung jalankan animasi untuk semua elemen yang sudah ada di viewport saat pertama kali halaman terbuka
                    requestAnimationFrame(() => {
                        revealElements.forEach(el => {
                            const rect = el.getBoundingClientRect();
                            if (rect.top < window.innerHeight && rect.bottom > 0) {
                                el.classList.add('revealed');
                            }
                        });
                    });

                    // Jaminan universal (Failsafe): Pastikan semua konten 100% muncul dan terbaca di semua device/browser tanpa terkecuali
                    setTimeout(() => {
                        revealElements.forEach(el => el.classList.add('revealed'));
                    }, 1000);
                } else {
                    revealElements.forEach(el => el.classList.add('revealed'));
                }

                // Smooth re-reveal saat user klik menu navigasi (misal: #about, #philosophy, #team, #portfolio)
                document.querySelectorAll('.navbar-nav a[href^="#"], a[href="#team"], a[href="#portfolio"]').forEach(navAnchor => {
                    navAnchor.addEventListener('click', function() {
                        const targetHash = this.getAttribute('href');
                        if (targetHash && targetHash !== '#') {
                            const targetSection = document.querySelector(targetHash);
                            if (targetSection) {
                                const sectionReveals = targetSection.querySelectorAll(
                                    '.reveal, .reveal-up, .reveal-down, .reveal-left, .reveal-right, .reveal-zoom, .reveal-fade'
                                );
                                if (sectionReveals.length > 0) {
                                    sectionReveals.forEach(el => el.classList.remove('revealed'));
                                    setTimeout(() => {
                                        sectionReveals.forEach(el => el.classList.add('revealed'));
                                    }, 200);
                                }
                            }
                        }
                    });
                });
            }

            // Boutique Logo Controller: Animasi huruf berjalan 100% otomatis tanpa perlu ke beranda dulu.
            // Fitur interaktif: klik logo untuk me-restart animasi jika diinginkan
            const logoStages = document.querySelectorAll('.boutique-logo-stage');
            logoStages.forEach(stage => {
                stage.addEventListener('click', function() {
                    const letters = stage.querySelectorAll('.stage-letter');
                    letters.forEach(el => {
                        el.style.animation = 'none';
                        void el.offsetHeight;
                        el.style.animation = '';
                    });
                });
            });

            // Philosophy Interactive Tag & Mind Cloud Real Scroll-Carousel Handler
            const philoTags = Array.from(document.querySelectorAll('.philosophy-tag'));
            const svgMindTags = document.querySelectorAll('.svg-mind-tag');
            const sliderTrack = document.getElementById('philosophySliderTrack');
            const insightBox = document.getElementById('philosophyInsightBox');
            const philoProgressBar = document.getElementById('philoProgressBar');
            const philoPrevBtn = document.getElementById('philoPrevBtn');
            const philoNextBtn = document.getElementById('philoNextBtn');
            const philoCounter = document.getElementById('philoCounter');
            const wordCloud = document.getElementById('philosophyWordCloud');

            let currentPhiloIndex = 0;
            const initialActiveIdx = philoTags.findIndex(t => t.classList.contains('active'));
            if (initialActiveIdx !== -1) currentPhiloIndex = initialActiveIdx;

            const CYCLE_DURATION = 3500; // 3.5 detik per rotasi scroll otomatis
            const TICK_INTERVAL = 50;
            let progressElapsed = 0;
            let autoCycleTimer = null;
            let isUserInteracting = false;

            function goToPhiloIndex(index, userInitiated = false) {
                if (!philoTags.length) return;
                currentPhiloIndex = (index + philoTags.length) % philoTags.length;
                const activeTag = philoTags[currentPhiloIndex];
                if (!activeTag) return;

                const activeKey = activeTag.getAttribute('data-key');

                // 1. ANIMASI SCROLL FISIK HORIZONTAL (Slider Track Transform)
                if (sliderTrack) {
                    sliderTrack.style.transform = `translateX(-${currentPhiloIndex * 100}%)`;
                }

                // 2. Update angka counter (misal 1 / 15)
                if (philoCounter) {
                    philoCounter.textContent = `${currentPhiloIndex + 1} / ${philoTags.length}`;
                }

                // 3. Sorot tombol tag aktif (Murni visual tanpa mengubah scroll halaman/viewport)
                philoTags.forEach((t, i) => {
                    if (i === currentPhiloIndex) {
                        t.classList.add('active');
                    } else {
                        t.classList.remove('active');
                    }
                });

                // 4. Update status teks pada mind cloud SVG
                svgMindTags.forEach(s => {
                    if (s.getAttribute('data-key') === activeKey) {
                        s.setAttribute('fill', '#c62828');
                        s.setAttribute('font-weight', '900');
                    } else {
                        s.setAttribute('fill', s.getAttribute('data-original-fill') || '#78909c');
                        s.setAttribute('font-weight', s.getAttribute('data-original-weight') || '500');
                    }
                });

                // Reset progress bar
                progressElapsed = 0;
                if (philoProgressBar) philoProgressBar.style.width = '0%';
            }

            // Sensor visibilitas: Carousel hanya berputar saat section #philosophy sedang dilihat pengunjung
            let isSectionInView = true;
            const philoSection = document.getElementById('philosophy');
            if (philoSection && 'IntersectionObserver' in window) {
                const sectionObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        isSectionInView = entry.isIntersecting;
                    });
                }, { threshold: 0.15 });
                sectionObserver.observe(philoSection);
            }

            function startAutoCycle() {
                if (autoCycleTimer) clearInterval(autoCycleTimer);
                autoCycleTimer = setInterval(() => {
                    if (isUserInteracting || !isSectionInView || philoTags.length <= 1) return;

                    progressElapsed += TICK_INTERVAL;
                    const pct = Math.min((progressElapsed / CYCLE_DURATION) * 100, 100);
                    if (philoProgressBar) philoProgressBar.style.width = pct + '%';

                    if (progressElapsed >= CYCLE_DURATION) {
                        goToPhiloIndex(currentPhiloIndex + 1);
                    }
                }, TICK_INTERVAL);
            }

            // Pause on hover agar pengunjung nyaman membaca
            const interactiveAreas = [insightBox, wordCloud].filter(Boolean);
            interactiveAreas.forEach(area => {
                area.addEventListener('mouseenter', () => { isUserInteracting = true; });
                area.addEventListener('mouseleave', () => { isUserInteracting = false; });
                area.addEventListener('touchstart', () => { isUserInteracting = true; }, { passive: true });
                area.addEventListener('touchend', () => { setTimeout(() => { isUserInteracting = false; }, 2000); }, { passive: true });
            });

            // Touch Swipe Gesture Support (Geser layar sentuh)
            let touchStartX = 0;
            let touchStartY = 0;
            let touchEndX = 0;
            let touchEndY = 0;
            if (sliderTrack) {
                sliderTrack.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].clientX;
                    touchStartY = e.changedTouches[0].clientY;
                }, { passive: true });

                sliderTrack.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].clientX;
                    touchEndY = e.changedTouches[0].clientY;
                    const diffX = touchStartX - touchEndX;
                    const diffY = touchStartY - touchEndY;
                    // Hanya geser kartu jika gerakan jari dominan horizontal (bukan sedang scroll vertikal halaman)
                    if (Math.abs(diffX) > 60 && Math.abs(diffX) > Math.abs(diffY) * 1.8) {
                        if (diffX > 0) {
                            goToPhiloIndex(currentPhiloIndex + 1, true); // Geser kiri -> next
                        } else {
                            goToPhiloIndex(currentPhiloIndex - 1, true); // Geser kanan -> prev
                        }
                    }
                }, { passive: true });
            }

            // Tombol Navigasi Manual
            if (philoPrevBtn) {
                philoPrevBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    goToPhiloIndex(currentPhiloIndex - 1, true);
                });
            }
            if (philoNextBtn) {
                philoNextBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    goToPhiloIndex(currentPhiloIndex + 1, true);
                });
            }

            // Klik pada tags
            philoTags.forEach((tag, idx) => {
                tag.addEventListener('click', function() {
                    goToPhiloIndex(idx, true);
                });
            });

            // Klik pada SVG mind tags
            svgMindTags.forEach(stag => {
                stag.setAttribute('data-original-fill', stag.getAttribute('fill'));
                stag.setAttribute('data-original-weight', stag.getAttribute('font-weight'));
                stag.addEventListener('click', function() {
                    const key = this.getAttribute('data-key');
                    const targetIdx = philoTags.findIndex(t => t.getAttribute('data-key') === key);
                    if (targetIdx !== -1) {
                        goToPhiloIndex(targetIdx, true);
                    }
                });
            });

            // Set posisi awal slider
            goToPhiloIndex(currentPhiloIndex);

            // Jalankan auto cycle jika item lebih dari 1
            if (philoTags.length > 1) {
                startAutoCycle();
            }

            // Pause saat tab browser tidak aktif
            document.addEventListener('visibilitychange', () => {
                isUserInteracting = document.hidden;
            });
            // Live Contact Form Email & Phone Validation
            const contactEmail = document.getElementById('contact_email');
            const contactBadge = document.getElementById('contactEmailBadge');
            const contactFeedback = document.getElementById('contactEmailFeedback');
            const contactIcon = document.getElementById('contactEmailIcon');
            const contactSpinner = document.getElementById('contactEmailSpinner');

            const contactPhone = document.getElementById('contact_phone');
            const contactPhoneBadge = document.getElementById('contactPhoneBadge');
            const contactPhoneFeedback = document.getElementById('contactPhoneFeedback');
            const contactPhoneIcon = document.getElementById('contactPhoneIcon');
            const contactPhoneSpinner = document.getElementById('contactPhoneSpinner');

            const contactBtn = document.getElementById('btnSubmitContact');
            const contactWarning = document.getElementById('contactFormWarning');
            const contactForm = contactBtn ? contactBtn.closest('form') : null;

            let contactEmailValid = false;
            let contactPhoneValid = false;
            let contactEmailTimeout = null;
            let contactPhoneTimeout = null;

            function updateContactBtnState() {
                if (contactBtn) {
                    if (contactEmailValid && contactPhoneValid) {
                        contactBtn.removeAttribute('disabled');
                        contactBtn.style.opacity = '1';
                        contactBtn.style.cursor = 'pointer';
                        if (contactWarning) contactWarning.style.display = 'none';
                    } else {
                        contactBtn.setAttribute('disabled', 'disabled');
                        contactBtn.style.opacity = '0.6';
                        contactBtn.style.cursor = 'not-allowed';
                    }
                }
            }

            // Email Validation
            function validateContactEmail() {
                const val = contactEmail.value.trim();
                if (!val) {
                    contactEmailValid = false;
                    resetContactEmailUI();
                    updateContactBtnState();
                    return;
                }

                contactSpinner.style.display = 'block';
                contactIcon.style.display = 'none';

                fetch("{{ route('contact.check_email') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({ email: val })
                })
                .then(res => res.json())
                .then(data => {
                    contactSpinner.style.display = 'none';
                    if (data.valid) {
                        contactEmailValid = true;
                        contactBadge.style.display = 'inline-block';
                        contactBadge.innerHTML = `<span class="text-success"><i class="bi bi-check-circle-fill me-1"></i>${data.badge}</span>`;
                        contactFeedback.style.display = 'block';
                        contactFeedback.innerHTML = `<span class="text-success"><i class="bi bi-check2-circle me-1"></i>${data.message}</span>`;
                        contactIcon.style.display = 'block';
                        contactIcon.innerHTML = `<i class="bi bi-check-circle-fill text-success" style="font-size: 1.15rem;"></i>`;
                        contactEmail.style.borderColor = '#198754';
                        contactEmail.style.boxShadow = '0 0 0 4px rgba(25, 135, 84, 0.15)';
                        contactEmail.style.background = '#ffffff';
                    } else {
                        contactEmailValid = false;
                        contactBadge.style.display = 'inline-block';
                        contactBadge.innerHTML = `<span class="text-danger"><i class="bi bi-x-circle-fill me-1"></i>${data.badge}</span>`;
                        contactFeedback.style.display = 'block';
                        contactFeedback.innerHTML = `<span class="text-danger"><i class="bi bi-exclamation-circle-fill me-1"></i>${data.message}</span>`;
                        contactIcon.style.display = 'block';
                        contactIcon.innerHTML = `<i class="bi bi-x-circle-fill text-danger" style="font-size: 1.15rem;"></i>`;
                        contactEmail.style.borderColor = '#dc3545';
                        contactEmail.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.15)';
                        contactEmail.style.background = '#ffffff';
                    }
                    updateContactBtnState();
                })
                .catch(() => {
                    contactSpinner.style.display = 'none';
                });
            }

            function resetContactEmailUI() {
                contactBadge.style.display = 'none';
                contactFeedback.style.display = 'none';
                contactIcon.style.display = 'none';
                contactSpinner.style.display = 'none';
                contactEmail.style.borderColor = '';
                contactEmail.style.boxShadow = '';
                contactEmail.style.background = '';
            }

            // Phone Validation
            function validateContactPhone() {
                const val = contactPhone.value.trim();
                if (!val) {
                    contactPhoneValid = false;
                    resetContactPhoneUI();
                    updateContactBtnState();
                    return;
                }

                contactPhoneSpinner.style.display = 'block';
                contactPhoneIcon.style.display = 'none';

                fetch("{{ route('contact.check_phone') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({ phone: val })
                })
                .then(res => res.json())
                .then(data => {
                    contactPhoneSpinner.style.display = 'none';
                    if (data.valid) {
                        contactPhoneValid = true;
                        contactPhoneBadge.style.display = 'inline-block';
                        contactPhoneBadge.innerHTML = `<span class="text-success"><i class="bi bi-check-circle-fill me-1"></i>${data.badge}</span>`;
                        contactPhoneFeedback.style.display = 'block';
                        contactPhoneFeedback.innerHTML = `<span class="text-success"><i class="bi bi-check2-circle me-1"></i>${data.message}</span>`;
                        contactPhoneIcon.style.display = 'block';
                        contactPhoneIcon.innerHTML = `<i class="bi bi-check-circle-fill text-success" style="font-size: 1.15rem;"></i>`;
                        contactPhone.style.borderColor = '#198754';
                        contactPhone.style.boxShadow = '0 0 0 4px rgba(25, 135, 84, 0.15)';
                        contactPhone.style.background = '#ffffff';
                    } else {
                        contactPhoneValid = false;
                        contactPhoneBadge.style.display = 'inline-block';
                        contactPhoneBadge.innerHTML = `<span class="text-danger"><i class="bi bi-x-circle-fill me-1"></i>${data.badge}</span>`;
                        contactPhoneFeedback.style.display = 'block';
                        contactPhoneFeedback.innerHTML = `<span class="text-danger"><i class="bi bi-exclamation-circle-fill me-1"></i>${data.message}</span>`;
                        contactPhoneIcon.style.display = 'block';
                        contactPhoneIcon.innerHTML = `<i class="bi bi-x-circle-fill text-danger" style="font-size: 1.15rem;"></i>`;
                        contactPhone.style.borderColor = '#dc3545';
                        contactPhone.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.15)';
                        contactPhone.style.background = '#ffffff';
                    }
                    updateContactBtnState();
                })
                .catch(() => {
                    contactPhoneSpinner.style.display = 'none';
                });
            }

            function resetContactPhoneUI() {
                contactPhoneBadge.style.display = 'none';
                contactPhoneFeedback.style.display = 'none';
                contactPhoneIcon.style.display = 'none';
                contactPhoneSpinner.style.display = 'none';
                contactPhone.style.borderColor = '';
                contactPhone.style.boxShadow = '';
                contactPhone.style.background = '';
            }

            // Event Listeners for Email
            if (contactEmail) {
                contactEmail.addEventListener('input', function () {
                    clearTimeout(contactEmailTimeout);
                    contactEmailTimeout = setTimeout(validateContactEmail, 400);
                });

                contactEmail.addEventListener('blur', function () {
                    clearTimeout(contactEmailTimeout);
                    validateContactEmail();
                });

                if (contactEmail.value.trim().length > 0) {
                    validateContactEmail();
                }
            }

            // Event Listeners for Phone
            if (contactPhone) {
                contactPhone.addEventListener('input', function () {
                    clearTimeout(contactPhoneTimeout);
                    contactPhoneTimeout = setTimeout(validateContactPhone, 300);
                });

                contactPhone.addEventListener('blur', function () {
                    clearTimeout(contactPhoneTimeout);
                    validateContactPhone();
                });

                if (contactPhone.value.trim().length > 0) {
                    validateContactPhone();
                }
            }

            // Form Submit Guard with Custom System Popup
            if (contactForm) {
                contactForm.addEventListener('submit', function (e) {
                    if (!contactEmailValid || !contactPhoneValid) {
                        e.preventDefault();
                        if (contactWarning) {
                            contactWarning.style.display = 'block';
                            contactWarning.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                        const errReason = !contactEmailValid 
                            ? 'Alamat email yang Anda masukkan belum valid. Harap periksa dan masukkan email yang benar.' 
                            : 'Nomor telepon / WhatsApp belum valid (minimal 9 digit angka).';
                        if (typeof window.showUserPopup === 'function') {
                            window.showUserPopup(errReason, 'Periksa Kembali Formulir', 'warning', 'Oke, Saya Lengkapi');
                        }
                        if (!contactEmailValid) {
                            contactEmail.focus();
                        } else {
                            contactPhone.focus();
                        }
                        return false;
                    }
                });
            }

            // Portfolio Image Lightbox Logic
            const lightbox = document.getElementById('portfolioLightbox');
            const lightboxImg = document.getElementById('lightboxImage');
            const lightboxTitle = document.getElementById('lightboxTitle');
            const lightboxDesc = document.getElementById('lightboxDesc');
            const lightboxCounter = document.getElementById('lightboxCounter');
            const lightboxCloseBtn = document.getElementById('lightboxCloseBtn');
            const lightboxPrevBtn = document.getElementById('lightboxPrevBtn');
            const lightboxNextBtn = document.getElementById('lightboxNextBtn');
            const lightboxBackdrop = document.querySelector('.portfolio-lightbox-backdrop');

            let currentLightboxIndex = 0;
            let activeLightboxItems = [];

            function getCardLightboxItems(targetCard) {
                if (!targetCard) return [];
                return Array.from(targetCard.querySelectorAll('[data-lightbox-src]'));
            }

            function openLightbox(targetCard, activeItem) {
                activeLightboxItems = getCardLightboxItems(targetCard);
                if (activeLightboxItems.length === 0) return;

                const index = activeLightboxItems.indexOf(activeItem);
                currentLightboxIndex = index >= 0 ? index : 0;

                updateLightboxContent();

                lightbox.classList.add('active');
                lightbox.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }

            function updateLightboxContent() {
                const item = activeLightboxItems[currentLightboxIndex];
                if (!item) return;

                const src = item.getAttribute('data-lightbox-src');
                const title = item.getAttribute('data-lightbox-title') || '';
                const desc = item.getAttribute('data-lightbox-desc') || '';

                lightboxImg.style.opacity = '0';
                lightboxImg.style.transform = 'scale(0.96)';

                setTimeout(() => {
                    lightboxImg.src = src;
                    lightboxImg.alt = title;
                    lightboxTitle.textContent = title;
                    lightboxTitle.style.display = title ? 'block' : 'none';
                    lightboxDesc.textContent = desc;
                    lightboxDesc.style.display = desc ? 'block' : 'none';

                    lightboxCounter.textContent = `${currentLightboxIndex + 1} / ${activeLightboxItems.length}`;
                    
                    if (activeLightboxItems.length <= 1) {
                        lightboxPrevBtn.style.display = 'none';
                        lightboxNextBtn.style.display = 'none';
                        lightboxCounter.style.display = 'none';
                    } else {
                        lightboxPrevBtn.style.display = 'inline-flex';
                        lightboxNextBtn.style.display = 'inline-flex';
                        lightboxCounter.style.display = 'inline-block';
                    }

                    lightboxImg.onload = function() {
                        lightboxImg.style.opacity = '1';
                        lightboxImg.style.transform = 'scale(1)';
                    };
                    // In case image is cached
                    lightboxImg.style.opacity = '1';
                    lightboxImg.style.transform = 'scale(1)';
                }, 120);
            }

            function closeLightbox() {
                lightbox.classList.remove('active');
                lightbox.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                setTimeout(() => {
                    lightboxImg.src = '';
                }, 250);
            }

            function nextLightboxItem() {
                if (activeLightboxItems.length <= 1) return;
                currentLightboxIndex = (currentLightboxIndex + 1) % activeLightboxItems.length;
                updateLightboxContent();
            }

            function prevLightboxItem() {
                if (activeLightboxItems.length <= 1) return;
                currentLightboxIndex = (currentLightboxIndex - 1 + activeLightboxItems.length) % activeLightboxItems.length;
                updateLightboxContent();
            }

            // Click listener for all lightbox triggers
            document.addEventListener('click', function(e) {
                // If clicked on carousel controls or indicators, do not trigger lightbox
                if (e.target.closest('.carousel-indicators, .carousel-control-prev, .carousel-control-next')) {
                    return;
                }

                const targetCard = e.target.closest('.has-lightbox');
                if (targetCard) {
                    e.preventDefault();
                    
                    // Find active carousel slide item or image element with data-lightbox-src inside targetCard
                    let activeItem = targetCard.querySelector('.carousel-item.active[data-lightbox-src]');
                    if (!activeItem) {
                        activeItem = targetCard.querySelector('[data-lightbox-src]') || targetCard;
                    }
                    
                    openLightbox(targetCard, activeItem);
                }
            });

            // Keyboard access for cards (Enter or Space)
            document.addEventListener('keydown', function(e) {
                if ((e.key === 'Enter' || e.key === ' ') && document.activeElement && document.activeElement.classList.contains('has-lightbox')) {
                    e.preventDefault();
                    document.activeElement.click();
                }
            });

            if (lightboxCloseBtn) lightboxCloseBtn.addEventListener('click', closeLightbox);
            if (lightboxBackdrop) lightboxBackdrop.addEventListener('click', closeLightbox);
            if (lightboxNextBtn) lightboxNextBtn.addEventListener('click', nextLightboxItem);
            if (lightboxPrevBtn) lightboxPrevBtn.addEventListener('click', prevLightboxItem);

            // Close when clicking outside image wrapper in the body
            const lightboxBody = document.querySelector('.portfolio-lightbox-body');
            if (lightboxBody) {
                lightboxBody.addEventListener('click', function(e) {
                    if (e.target === lightboxBody) {
                        closeLightbox();
                    }
                });
            }

            // Keyboard controls while lightbox is open
            document.addEventListener('keydown', function(e) {
                if (!lightbox.classList.contains('active')) return;

                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowRight') {
                    nextLightboxItem();
                } else if (e.key === 'ArrowLeft') {
                    prevLightboxItem();
                }
            });
            
        });
    </script>

    <!-- Modal System Popup Frontend ("Pop Up Oke") -->
    <div class="modal fade" id="userPopupModal" tabindex="-1" aria-labelledby="userPopupTitle" aria-hidden="true" style="z-index: 10999;">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 450px;">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-center p-4 position-relative" style="background: #ffffff;">
                <div class="d-flex justify-content-center mb-3">
                    <div id="userPopupIconBox" class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 82px; height: 82px; background: rgba(16, 185, 129, 0.12); border: 2px solid rgba(16, 185, 129, 0.25); transition: all 0.3s ease;">
                        <i id="userPopupIcon" class="bi bi-check2-circle text-success" style="font-size: 2.8rem;"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark mb-2" id="userPopupTitle">Pesan Berhasil Terkirim!</h4>
                <p class="text-secondary small mb-4 px-2" id="userPopupMessage" style="line-height: 1.6; font-size: 0.95rem;">
                    Terima kasih telah menghubungi Boutique Design. Tim kami akan segera meninjau pesan Anda dan merespons secepatnya.
                </p>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill px-5 py-2.5 fw-bold shadow-sm" id="userPopupBtn" data-bs-dismiss="modal" style="min-width: 170px; background-color: var(--primary-accent); border-color: var(--primary-accent); font-size: 0.95rem; letter-spacing: 0.3px;">
                        Oke, Terima Kasih
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Frontend Popup Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.showUserPopup = function(message, title = 'Pemberitahuan', type = 'success', btnText = 'Oke, Mengerti') {
                const modalEl = document.getElementById('userPopupModal');
                if (!modalEl || typeof bootstrap === 'undefined') return;

                const titleEl = document.getElementById('userPopupTitle');
                const msgEl = document.getElementById('userPopupMessage');
                const iconBox = document.getElementById('userPopupIconBox');
                const iconEl = document.getElementById('userPopupIcon');
                const btnEl = document.getElementById('userPopupBtn');

                if (titleEl) titleEl.textContent = title;
                if (msgEl) msgEl.innerHTML = message;
                if (btnEl) btnEl.textContent = btnText;

                if (iconBox && iconEl) {
                    if (type === 'success') {
                        iconBox.style.background = 'rgba(16, 185, 129, 0.12)';
                        iconBox.style.border = '2px solid rgba(16, 185, 129, 0.25)';
                        iconEl.className = 'bi bi-check2-circle text-success';
                        btnEl.className = 'btn btn-danger rounded-pill px-5 py-2.5 fw-bold shadow-sm';
                        btnEl.style.backgroundColor = 'var(--primary-accent)';
                        btnEl.style.borderColor = 'var(--primary-accent)';
                    } else if (type === 'warning') {
                        iconBox.style.background = 'rgba(245, 158, 11, 0.12)';
                        iconBox.style.border = '2px solid rgba(245, 158, 11, 0.25)';
                        iconEl.className = 'bi bi-exclamation-circle text-warning';
                        btnEl.className = 'btn btn-dark rounded-pill px-5 py-2.5 fw-bold shadow-sm';
                        btnEl.style.backgroundColor = '';
                        btnEl.style.borderColor = '';
                    } else {
                        iconBox.style.background = 'rgba(239, 68, 68, 0.12)';
                        iconBox.style.border = '2px solid rgba(239, 68, 68, 0.25)';
                        iconEl.className = 'bi bi-x-circle text-danger';
                        btnEl.className = 'btn btn-danger rounded-pill px-5 py-2.5 fw-bold shadow-sm';
                        btnEl.style.backgroundColor = 'var(--primary-accent)';
                        btnEl.style.borderColor = 'var(--primary-accent)';
                    }
                }

                const bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
                bsModal.show();
                setTimeout(() => { if (btnEl) btnEl.focus(); }, 250);
            };

            // Auto-trigger on Session Flash
            @if(session('success'))
                window.showUserPopup(@json(session('success')), 'Pesan Berhasil Terkirim!', 'success', 'Oke, Terima Kasih');
            @endif

            @if(session('error'))
                window.showUserPopup(@json(session('error')), 'Pemberitahuan', 'error', 'Oke, Mengerti');
            @endif
        });
    </script>
</body>
</html>
