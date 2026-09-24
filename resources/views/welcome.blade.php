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

        /* Hero Section */
        .hero {
            padding: 160px 0 100px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
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
        
        /* Interactive SVG Lightbulb */
        .svg-bulb-container {
            position: relative;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            text-align: center;
        }
        .svg-bulb {
            width: 100%;
            max-width: 380px;
            height: auto;
            cursor: pointer;
            filter: drop-shadow(0 15px 30px rgba(0,0,0,0.08));
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .svg-bulb:hover {
            transform: scale(1.05) rotate(3deg);
        }
        .bulb-glow {
            fill: #ffeb3b;
            opacity: 0.15;
            transition: opacity 0.5s ease, fill 0.5s ease;
        }
        .svg-bulb:hover .bulb-glow {
            opacity: 0.95;
            filter: drop-shadow(0 0 25px #ffeb3b);
        }
        .bulb-filament {
            stroke: #37474f;
            transition: stroke 0.5s ease;
        }
        .svg-bulb:hover .bulb-filament {
            stroke: #e65100;
            stroke-width: 3.5;
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
        .section-title span.first-letter {
            color: var(--primary-accent);
            font-family: var(--font-main);
            font-weight: 900;
            font-style: italic;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 20%;
            width: 60%;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-accent), transparent);
        }
        .section-subtitle {
            color: #5c6bc0;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.85rem;
            font-weight: 700;
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

        /* About Section (What Are We) */
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
        .brainstorm-node {
            cursor: pointer;
            transition: var(--transition);
        }
        .brainstorm-node:hover {
            transform: scale(1.08);
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));
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
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(198, 40, 40, 0.15);
            border-left: 4px solid var(--primary-accent);
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        .philosophy-insight-card.animating {
            transform: translateY(4px);
            opacity: 0.6;
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
        .svg-mind-tag {
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .svg-mind-tag:hover {
            fill: #c62828 !important;
            font-weight: 800 !important;
            filter: drop-shadow(0 2px 5px rgba(198, 40, 40, 0.3));
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

        .portfolio-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
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
        .portfolio-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        .portfolio-card:hover .portfolio-img {
            transform: scale(1.08);
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
            z-index: 3;
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
            z-index: 2;
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
        .client-product-img.has-lightbox {
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .client-product-img.has-lightbox:hover {
            transform: scale(1.08);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.18) !important;
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
        .btn-wa-direct {
            background-color: #25D366;
            border: none;
            color: #ffffff !important;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            flex-shrink: 0;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(37, 211, 102, 0.25);
        }
        .btn-wa-direct:hover {
            background-color: #20ba59;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            color: #ffffff !important;
        }
        .btn-wa-direct i {
            font-size: 0.95rem;
        }

        .btn-maps-link {
            display: inline-flex;
            align-items: center;
            font-size: 0.8rem;
            font-weight: 600;
            color: #d32f2f !important;
            background: rgba(211, 47, 47, 0.08);
            border: 1px solid rgba(211, 47, 47, 0.2);
            padding: 4px 12px;
            border-radius: 20px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-maps-link:hover {
            background: #d32f2f;
            color: #ffffff !important;
            border-color: #d32f2f;
            box-shadow: 0 4px 12px rgba(211, 47, 47, 0.25);
            transform: translateY(-1px);
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
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('uploads/logo.png') }}" alt="Boutique Design" style="height: 52px; width: auto;">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="#home">{{ __('messages.nav.home') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">{{ __('messages.nav.about') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#philosophy">{{ __('messages.nav.philosophy') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">{{ __('messages.nav.services') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">{{ __('messages.nav.team') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">{{ __('messages.nav.work') }}</a></li>
                    @if(isset($clients) && count($clients) > 0)
                        <li class="nav-item"><a class="nav-link" href="#clients">{{ __('messages.nav.clients') }}</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="#contact">{{ __('messages.nav.contact') }}</a></li>
                    <li class="nav-item ms-lg-2">
                        <a href="#contact" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-2" style="font-weight:600; font-size:0.85rem;">{{ __('messages.nav.get_ideas') }}</a>
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
    <header id="home" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                                        <h1 class="hero-title-sig"><img src="{{ asset('uploads/logo.png') }}" alt="Boutique" class="img-fluid" style="max-height:180px; max-width:300px;"> </h1>
                    <h2 class="hero-title-main">
                        @if(app()->getLocale() === 'en')
                            grab <span class="highlight">e</span>ven <span class="highlight">b</span>igger <span class="highlight">i</span>deas <span class="highlight">w</span>ith us
                        @else
                            raih <span class="highlight">i</span>de yang <span class="highlight">l</span>ebih <span class="highlight">b</span>esar bersama kami
                        @endif
                    </h2>
                    

                    <p class="hero-slogan">
                        {{ $settings['slogan_main_' . app()->getLocale()] ?? $settings['slogan_main_en'] ?? '' }}
                    </p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3">
                        <a href="#portfolio" class="btn btn-danger btn-lg rounded-pill px-5 py-3 shadow" style="background-color: var(--primary-accent); border-color: var(--primary-accent); font-weight: 600; font-size:0.95rem;">{{ app()->getLocale() === 'en' ? 'Explore Our Work' : 'Jelajahi Karya Kami' }}</a>
                        <a href="#about" class="btn btn-outline-dark btn-lg rounded-pill px-5 py-3" style="font-weight: 600; font-size:0.95rem;">{{ app()->getLocale() === 'en' ? 'Learn About Us' : 'Tentang Kami' }}</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="svg-bulb-container floating-anim">
                        <!-- Interactive SVG Lightbulb recreating the concept of Yellow Crumpled Paper Bulb -->
                        <svg class="svg-bulb" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                            <!-- Glow effect -->
                            <circle class="bulb-glow" cx="250" cy="220" r="160" />
                            
                            <!-- Crumpled paper texture background inside bulb (Concept recreation) -->
                            <mask id="bulb-mask">
                                <circle cx="250" cy="220" r="130" fill="white" />
                            </mask>
                            <g mask="url(#bulb-mask)">
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

                            <!-- Idea sparkles -->
                            <path d="M250,10 L250,0" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                            <path d="M370,60 L378,52" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                            <path d="M420,160 L430,160" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                            <path d="M380,270 L390,276" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                            <path d="M130,60 L122,52" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                            <path d="M80,160 L70,160" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                            <path d="M120,270 L110,276" stroke="#37474f" stroke-width="5" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section (What Are We) -->
    <section id="about" class="bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
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
                            <h3 class="h1 fw-bold text-danger mb-1" style="color: var(--primary-accent);">2010</h3>
                            <p class="text-secondary small uppercase tracking">{{ __('messages.about.year_established') }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <h3 class="h1 fw-bold text-danger mb-1" style="color: var(--primary-accent);">100%</h3>
                            <p class="text-secondary small uppercase tracking">{{ __('messages.about.independent_agency') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="svg-brainstorm-container">
                        <!-- Hand drawn style layout recreating the concept: strategy, idea, innovation -->
                        <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: auto;">
                            <!-- Lightbulb inside brain node -->
                            <circle cx="250" cy="250" r="80" fill="none" stroke="#78909c" stroke-width="4" stroke-dasharray="10 6" />
                            <path d="M250,210 C228,210 210,228 210,250 C210,265 220,278 228,284 C234,290 236,298 236,306 L264,306 C264,298 266,290 272,284 C280,278 290,265 290,250 C290,228 272,210 250,210 Z" fill="none" stroke="#c62828" stroke-width="5" />
                            <path d="M236,306 L264,306 L260,318 L240,318 Z" fill="#90a4ae" stroke="#37474f" stroke-width="3" />
                            <path d="M240,318 C240,326 260,326 260,318" fill="#37474f" stroke="#37474f" stroke-width="3" />

                            <!-- Spark lines -->
                            <line x1="250" y1="195" x2="250" y2="185" stroke="#fbc02d" stroke-width="4" stroke-linecap="round" />
                            <line x1="290" y1="210" x2="300" y2="200" stroke="#fbc02d" stroke-width="4" stroke-linecap="round" />
                            <line x1="305" y1="250" x2="317" y2="250" stroke="#fbc02d" stroke-width="4" stroke-linecap="round" />
                            <line x1="210" y1="210" x2="200" y2="200" stroke="#fbc02d" stroke-width="4" stroke-linecap="round" />
                            <line x1="195" y1="250" x2="183" y2="250" stroke="#fbc02d" stroke-width="4" stroke-linecap="round" />
                            
                            <!-- Branching circles (Strategy, Idea, Innovation) -->
                            <!-- Strategy -->
                            <g class="brainstorm-node">
                                <circle cx="120" cy="150" r="45" fill="#eceff1" stroke="#37474f" stroke-width="3" />
                                <text x="120" y="154" text-anchor="middle" font-size="13" font-weight="700" fill="#37474f">{{ app()->getLocale() === 'en' ? 'STRATEGY' : 'STRATEGI' }}</text>
                                <path d="M210,220 L160,175" stroke="#78909c" stroke-width="3" stroke-dasharray="5 5" />
                            </g>
                            
                            <!-- Idea -->
                            <g class="brainstorm-node">
                                <circle cx="380" cy="150" r="45" fill="#eceff1" stroke="#37474f" stroke-width="3" />
                                <text x="380" y="154" text-anchor="middle" font-size="13" font-weight="700" fill="#37474f">{{ app()->getLocale() === 'en' ? 'IDEA' : 'IDE' }}</text>
                                <path d="M290,220 L340,175" stroke="#78909c" stroke-width="3" stroke-dasharray="5 5" />
                            </g>

                            <!-- Innovation -->
                            <g class="brainstorm-node">
                                <circle cx="250" cy="390" r="45" fill="#eceff1" stroke="#37474f" stroke-width="3" />
                                <text x="250" y="394" text-anchor="middle" font-size="12" font-weight="700" fill="#37474f">{{ app()->getLocale() === 'en' ? 'INNOVATION' : 'INOVASI' }}</text>
                                <path d="M250,306 L250,345" stroke="#78909c" stroke-width="3" stroke-dasharray="5 5" />
                            </g>

                            <!-- Slogan title -->
                            <text x="250" y="475" text-anchor="middle" font-size="16" font-style="italic" font-weight="600" fill="#546e7a">{{ __('messages.sections.grab_bigger_ideas') }}</text>
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
                <div class="col-lg-6 mb-5 mb-lg-0 order-lg-2">
                    <div class="section-title-wrapper text-start">
                        <span class="section-subtitle">{{ __('messages.sections.mindset') }}</span>
                        <h2 class="section-title"><span class="first-letter">{{ substr(__('messages.sections.philosophy'), 0, 1) }}</span>{{ substr(__('messages.sections.philosophy'), 1) }}</h2>
                    </div>
                    <div class="about-text mb-4">
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

                    <div class="philosophy-word-cloud mb-3" id="philosophyWordCloud">
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

                    <!-- Dynamic Philosophy Insight Display Box -->
                    <div class="philosophy-insight-card p-3 p-md-4 mt-3" id="philosophyInsightBox">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="philosophy-insight-icon" id="insightIcon">
                                <i class="bi {{ $firstPhilo ? ($firstPhilo->icon ?: 'bi-lightbulb-fill') : 'bi-lightbulb-fill' }}"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0 text-dark" id="insightTitle">
                                    {{ $firstPhilo ? ($currLocale === 'en' ? ($firstPhilo->title_en ?: $firstPhilo->title_id) : ($firstPhilo->title_id ?: $firstPhilo->title_en)) : 'FILOSOFI' }}
                                </h5>
                                <small class="text-danger fw-semibold" id="insightSubtitle">
                                    {{ $firstPhilo ? ($currLocale === 'en' ? ($firstPhilo->subtitle_en ?: $firstPhilo->subtitle_id) : ($firstPhilo->subtitle_id ?: $firstPhilo->subtitle_en)) : 'Fondasi Pemikiran Kreatif' }}
                                </small>
                            </div>
                        </div>
                        <div id="insightImgWrapper" class="my-2 {{ ($firstPhilo && $firstPhilo->image_path) ? '' : 'd-none' }}">
                            <img id="insightImg" src="{{ ($firstPhilo && $firstPhilo->image_path) ? asset($firstPhilo->image_path) : '#' }}" alt="Insight Image" class="img-fluid rounded-3 shadow-sm" style="max-height: 180px; width:auto; object-fit:contain;">
                        </div>
                        <p class="text-secondary mb-0 mt-2" style="font-size: 0.93rem; line-height: 1.6;" id="insightDesc">
                            {{ $firstPhilo ? ($currLocale === 'en' ? ($firstPhilo->description_en ?: $firstPhilo->description_id) : ($firstPhilo->description_id ?: $firstPhilo->description_en)) : '' }}
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-6 order-lg-1 text-center">
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
    <section id="services" class="bg-white">
        <div class="container">
            <div class="section-title-wrapper">
                <span class="section-subtitle">{{ __('messages.sections.services') }}</span>
                <h2 class="section-title"><span class="first-letter">{{ substr(__('messages.sections.what_offer'), 0, 1) }}</span>{{ substr(__('messages.sections.what_offer'), 1) }}</h2>
            </div>
            
            <div class="row g-4">
                @forelse($services as $service)
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <div class="glass-card h-100">
                            <i class="bi bi-broadcast service-icon"></i>
                            <h3 class="service-title">ATL & BTL Campaign</h3>
                            <p class="service-description">Full service campaign coordination targeting both Above The Line (broad reach) and Below The Line (niche activations) marketing channels.</p>
                            <span class="badge bg-secondary-subtle text-dark border px-3 py-2 rounded-pill mt-2" style="font-size:0.75rem;">ATL & BTL</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="glass-card h-100">
                            <i class="bi bi-lightbulb service-icon"></i>
                            <h3 class="service-title">Creative Concept</h3>
                            <p class="service-description">Development campaign of TVC commercials, print flyers, point of sale templates, radio programs, and corporate profile videos.</p>
                            <span class="badge bg-secondary-subtle text-dark border px-3 py-2 rounded-pill mt-2" style="font-size:0.75rem;">Concept</span>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                <div class="col-lg-6 mb-4 mb-lg-0">
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
                <div class="col-lg-6">
                    <!-- Recreating Diagrams from page 4 & 5 (Marketing & Development charts) -->
                    <div class="row g-4 text-center">
                        <div class="col-md-6">
                            <div class="bg-light p-4 rounded-4 shadow-sm">
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
                            <div class="bg-light p-4 rounded-4 shadow-sm">
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
            <div class="section-title-wrapper">
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
                    <div class="col-lg-6">
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
                    <div class="col-sm-6 col-md-4 col-lg-3">
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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Portfolio Section (What We Have Done) -->
    <section id="portfolio" class="bg-white">
        <div class="container">
            <div class="section-title-wrapper">
                <span class="section-subtitle">{{ __('messages.sections.masterpieces') }}</span>
                <h2 class="section-title"><span class="first-letter">{{ substr(__('messages.sections.what_done'), 0, 1) }}</span>{{ substr(__('messages.sections.what_done'), 1) }}</h2>
            </div>

            <!-- Categories Filter -->
            <div class="text-center mb-5">
                <button class="portfolio-filter-btn active" data-filter="all">{{ __('messages.portfolio.all_work') }}</button>
                @foreach($portfolios->unique(fn($p) => $p->title) as $filterWork)
                    <button class="portfolio-filter-btn" data-filter="{{ \Illuminate\Support\Str::slug($filterWork->title_en ?: $filterWork->title_id) }}">{{ $filterWork->title }}</button>
                @endforeach
            </div>

            <!-- Work Grid -->
            <div class="row g-4">
                @forelse($portfolios as $work)
                    <div class="col-md-6 col-lg-4 portfolio-item-col" data-category="{{ \Illuminate\Support\Str::slug($work->title_en ?: $work->title_id) }}">
                        <div class="portfolio-card {{ $work->image_path ? 'has-lightbox' : '' }}"
                             @if($work->image_path)
                                 data-lightbox-src="{{ asset($work->image_path) }}"
                                 data-lightbox-title="{{ $work->title }}"
                                 data-lightbox-desc="{{ $work->description }}"
                                 role="button"
                                 tabindex="0"
                                 title="{{ app()->getLocale() == 'id' ? 'Klik untuk membuka gambar' : 'Click to view image' }}"
                             @endif>
                            <div class="portfolio-img-wrapper">
                                <span class="portfolio-badge">{{ $work->title }}</span>
                                @if($work->image_path)
                                    <img src="{{ asset($work->image_path) }}" class="portfolio-img" alt="{{ $work->title }}" loading="lazy">
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
                                    @if($work->image_path)
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
            <div class="section-title-wrapper text-center mb-5">
                <span class="section-subtitle">Partners & Brands</span>
                <h2 class="section-title">
                    <span class="first-letter">O</span>ur Clients
                </h2>
            </div>
            <div class="row align-items-start justify-content-center g-4">
                @foreach($clients as $client)
                    @if($loop->index > 0 && $loop->index % 6 == 0)
                        <div class="col-12 my-3">
                            <hr class="client-divider" style="border: none; border-top: 2px solid #000; margin: 0; width: 100%; opacity: 1;">
                        </div>
                    @endif
                    <div class="col-6 col-md-4 col-lg-2 text-center">
                        <div class="client-logo-wrapper mb-3 d-flex align-items-center justify-content-center" style="min-height: 80px; height: auto;">
                            @if($client->logo)
                                <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}" class="img-fluid client-logo" style="{{ $client->logo_width ? 'max-width:'.$client->logo_width.'px;' : '' }}{{ $client->logo_height ? ' max-height:'.$client->logo_height.'px;' : '' }}">
                            @else
                                <div class="fw-bold text-muted client-name">{{ $client->name }}</div>
                            @endif
                        </div>
                        @if($client->productImages->count() > 0)
                            <div class="mt-2 d-flex flex-wrap justify-content-center gap-2 pt-2" style="border-top:2px solid #000;">
                                @foreach($client->productImages as $product)
                                    <img src="{{ asset($product->image) }}" 
                                         alt="Product {{ $client->name }}" 
                                         class="img-fluid rounded shadow-sm client-product-img has-lightbox" 
                                         data-lightbox-src="{{ asset($product->image) }}"
                                         data-lightbox-title="{{ $client->name }}"
                                         data-lightbox-desc="Product Showcase"
                                         style="{{ $product->width ? 'max-width:'.$product->width.'px;' : 'max-width: 120px;' }}{{ $product->height ? ' max-height:'.$product->height.'px;' : ' max-height: 100px;' }} object-fit: contain; transition: all 0.3s ease; cursor: pointer;" 
                                         title="{{ app()->getLocale() == 'id' ? 'Klik untuk membuka gambar' : 'Click to view image' }}">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
                <div class="col-12 mt-3">
                    <hr class="client-divider" style="border: none; border-top: 2px solid #000; margin: 0; width: 100%; opacity: 1;">
                </div>
            </div>
        </div>
    </section>
    <style>
                .client-logo {
            max-height: 150px; /* larger for clearer display */
            transition: all 0.4s ease;
        }
        .client-logo:hover {
            transform: scale(1.12); /* slightly larger hover effect */
        }
        .client-name {
            opacity: 0.6;
            transition: all 0.4s ease;
            font-size: 1.1rem;
        }
        .client-name:hover {
            opacity: 1;
            color: var(--accent-red) !important;
        }
    </style>
    @endif

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="section-title-wrapper">
                <span class="section-subtitle">{{ __('messages.sections.get_touch') }}</span>
                <h2 class="section-title">
                    <span class="first-letter">{{ substr($settings['slogan_sub_' . app()->getLocale()] ?? $settings['slogan_sub_en'] ?? 'g', 0, 1) }}</span>{{ substr($settings['slogan_sub_' . app()->getLocale()] ?? $settings['slogan_sub_en'] ?? 'rab even bigger ideas with us', 1) }}
                </h2>
            </div>

            <div class="row g-5">
                <!-- Contact Details -->
                <div class="col-lg-5">
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
                                    <p><a href="mailto:{{ $settings['email'] ?? 'boutique.design@yahoo.co.id' }}">{{ $settings['email'] ?? 'boutique.design@yahoo.co.id' }}</a></p>
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
                <div class="col-lg-7">
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
                                    <button type="submit" id="btnSubmitContact" class="btn-submit" disabled style="opacity: 0.6; cursor: not-allowed;">
                                        {{ __('messages.fields.send_message') }} <i class="bi bi-send ms-2"></i>
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
                <div class="col-lg-7">
                    <a class="d-inline-flex align-items-center text-decoration-none mb-3" href="#">
                        <img src="{{ asset('uploads/logo.png') }}" alt="Boutique Design" style="height: 52px; width: auto; filter: brightness(0) invert(1);">
                    </a>
                    <p class="footer-text mb-4">
                        {{ __('messages.footer.desc') }}
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ $settings['instagram_url'] ?? 'https://www.instagram.com/boutiquedesign_indonesia?stkn=a2RnMG51Z2FjZDg0' }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light rounded-circle" style="width:40px; height:40px; display:flex; align-items:center; justify-content:center; font-size: 1.15rem; transition: all 0.3s ease;" title="Instagram Boutique Design Indonesia"><i class="bi bi-instagram"></i></a>
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
            // Portfolio Filtering
            const filterBtns = document.querySelectorAll('.portfolio-filter-btn');
            const portfolioItems = document.querySelectorAll('.portfolio-item-col');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Toggle active class
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');

                    portfolioItems.forEach(item => {
                        if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                            item.style.display = 'block';
                            // Subtle fade-in animation
                            item.style.opacity = '0';
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transition = 'opacity 0.4s ease';
                            }, 50);
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });

            // Smooth Scroll active link updates
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('section, header');

            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= (sectionTop - 200)) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('active');
                    }
                });
            });

            // Philosophy Interactive Tag & Mind Cloud Handler
            const philoTags = document.querySelectorAll('.philosophy-tag');
            const svgMindTags = document.querySelectorAll('.svg-mind-tag');
            const insightBox = document.getElementById('philosophyInsightBox');
            const insightIcon = document.getElementById('insightIcon');
            const insightTitle = document.getElementById('insightTitle');
            const insightSubtitle = document.getElementById('insightSubtitle');
            const insightDesc = document.getElementById('insightDesc');

            function activatePhilosophyTag(key, title, sub, icon, desc, image) {
                // Update tag active classes
                philoTags.forEach(t => {
                    if (t.getAttribute('data-key') === key) {
                        t.classList.add('active');
                    } else {
                        t.classList.remove('active');
                    }
                });

                // Update SVG mind tag active state
                svgMindTags.forEach(s => {
                    if (s.getAttribute('data-key') === key) {
                        s.setAttribute('fill', '#c62828');
                        s.setAttribute('font-weight', '900');
                    } else {
                        s.setAttribute('fill', s.getAttribute('data-original-fill') || '#78909c');
                        s.setAttribute('font-weight', s.getAttribute('data-original-weight') || '500');
                    }
                });

                // Animate and update insight card
                if (insightBox) {
                    insightBox.classList.add('animating');
                    setTimeout(() => {
                        if (insightIcon) insightIcon.innerHTML = `<i class="bi ${icon}"></i>`;
                        if (insightTitle) insightTitle.textContent = title;
                        if (insightSubtitle) insightSubtitle.textContent = sub;
                        if (insightDesc) insightDesc.textContent = desc;

                        const imgWrapper = document.getElementById('insightImgWrapper');
                        const imgEl = document.getElementById('insightImg');
                        if (imgWrapper && imgEl) {
                            if (image && image.trim() !== '') {
                                imgEl.src = image;
                                imgWrapper.classList.remove('d-none');
                            } else {
                                imgWrapper.classList.add('d-none');
                            }
                        }

                        insightBox.classList.remove('animating');
                    }, 150);
                }
            }

            // Bind click to philosophy tags
            philoTags.forEach(tag => {
                tag.addEventListener('click', function() {
                    const key = this.getAttribute('data-key');
                    const title = this.getAttribute('data-title');
                    const sub = this.getAttribute('data-sub');
                    const icon = this.getAttribute('data-icon');
                    const desc = this.getAttribute('data-desc');
                    const image = this.getAttribute('data-image');
                    activatePhilosophyTag(key, title, sub, icon, desc, image);
                });
            });

            // Bind click to SVG mind tags
            svgMindTags.forEach(stag => {
                stag.setAttribute('data-original-fill', stag.getAttribute('fill'));
                stag.setAttribute('data-original-weight', stag.getAttribute('font-weight'));
                stag.addEventListener('click', function() {
                    const key = this.getAttribute('data-key');
                    const matchingTag = document.querySelector(`.philosophy-tag[data-key="${key}"]`);
                    if (matchingTag) {
                        matchingTag.click();
                    }
                });
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

            function getVisibleLightboxItems() {
                const allItems = Array.from(document.querySelectorAll('.has-lightbox[data-lightbox-src]'));
                return allItems.filter(el => {
                    const col = el.closest('.portfolio-item-col');
                    if (col) {
                        return window.getComputedStyle(col).display !== 'none';
                    }
                    return window.getComputedStyle(el).display !== 'none';
                });
            }

            function openLightbox(index) {
                activeLightboxItems = getVisibleLightboxItems();
                if (activeLightboxItems.length === 0) return;

                if (index < 0) index = 0;
                if (index >= activeLightboxItems.length) index = activeLightboxItems.length - 1;
                currentLightboxIndex = index;

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
                const targetTrigger = e.target.closest('.has-lightbox[data-lightbox-src]');
                if (targetTrigger) {
                    e.preventDefault();
                    activeLightboxItems = getVisibleLightboxItems();
                    const idx = activeLightboxItems.indexOf(targetTrigger);
                    openLightbox(idx >= 0 ? idx : 0);
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
