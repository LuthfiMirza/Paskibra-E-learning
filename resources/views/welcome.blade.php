<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Paskibra E-Learning - Beranda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Reset & font */
        * {
            margin: 0; 
            padding: 0; 
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, rgb(15, 2, 2) 0%, rgb(203, 17, 17) 100%);
            min-height: 100vh;
            color: #fff;
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar */
        nav {
            background: rgba(0, 0, 0, 0.3);
            padding: 1rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }
        
        nav .logo {
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: 2px;
            color: rgb(244, 243, 239);
            cursor: default;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }
        
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 5px;
        }
        
        nav ul li a:hover,
        nav ul li a.active {
            color: rgb(248, 247, 243);
            background: rgba(255, 255, 255, 0.1);
        }

        /* Slider */
        .slider {
            width: 90%;
            max-width: 500px;
            margin: 1rem auto 2rem auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 10px 10px 25px rgba(37, 117, 252, 0.3);
            position: relative;
        }
        
        .slides {
            display: flex;
            width: 500%;
            animation: slideAnimation 20s infinite;
        }
        
        .slides img {
            width: 20%;
            height: 300px;
            object-fit: cover;
        }
        
        @keyframes slideAnimation {
            0%, 18% { transform: translateX(0%); }
            20%, 38% { transform: translateX(-20%); }
            40%, 58% { transform: translateX(-40%); }
            60%, 78% { transform: translateX(-60%); }
            80%, 98% { transform: translateX(-80%); }
            100% { transform: translateX(0%); }
        }

        /* Hero Section */
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 3rem 1rem;
            max-width: 900px;
            margin: 0 auto 3rem auto;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.7);
            font-weight: 700;
        }
        
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            color: #e0e0e0;
            max-width: 600px;
            line-height: 1.5;
        }
        
        .hero .btn-primary {
            background: #ffd700;
            color: #1e3c72;
            padding: 0.8rem 2rem;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.5);
            transition: background 0.3s ease, transform 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .hero .btn-primary:hover {
            background: #e6c200;
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(230, 194, 0, 0.7);
        }

        /* Features Section */
        .features {
            background: #fff;
            color: #1e3c72;
            padding: 4rem 1rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem;
            max-width: 1100px;
            margin: 2rem auto 4rem auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .feature-card {
            background: #f9f9f9;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(37, 117, 252, 0.2);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: default;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(37, 117, 252, 0.4);
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #2575fc;
        }
        
        .feature-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }
        
        .feature-desc {
            font-size: 1rem;
            color: #555;
            line-height: 1.4;
        }

        /* Footer */
        .footer {
            background-color: #1a1a1a;
            color: #ddd;
            padding: 40px 20px 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: space-between;
        }

        .footer-section {
            flex: 1 1 220px;
            min-width: 220px;
        }

        .footer-logo {
            width: 150px;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        .footer-section h3 {
            color: #ff4b2b;
            margin-bottom: 15px;
            font-weight: 700;
            font-size: 18px;
        }

        .footer-section p, .footer-section a {
            color: #ddd;
            text-decoration: none;
            line-height: 1.6;
        }

        .footer-section a:hover {
            color: #ff4b2b;
            text-decoration: underline;
        }

        /* Social media icons */
        .social-icons {
            display: flex;
            gap: 15px;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: #333;
            color: #ddd;
            font-size: 18px;
            transition: background-color 0.3s, color 0.3s;
            text-decoration: none;
        }

        .social-icon:hover {
            color: #fff;
        }

        .social-icon.instagram:hover {
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285aeb 90%);
            color: white;
        }

        /* Footer bottom */
        .footer-bottom {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #888;
            border-top: 1px solid #333;
            padding-top: 15px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
            }
            .footer-section {
                min-width: 100%;
            }
            nav {
                padding: 1rem;
            }
            nav .logo {
                font-size: 1.4rem;
            }
            .hero h1 {
                font-size: 2.2rem;
            }
            .hero p {
                font-size: 1rem;
            }
        }

        @media (max-width: 600px) {
            nav ul {
                gap: 1rem;
            }
            nav ul li a {
                padding: 0.3rem 0.5rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">PASKIBRA Wira Purusa E-LEARNING</div>
    <ul>
        @if (Route::has('login'))
            @auth
                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" style="color: #fff; text-decoration: none;">Logout</a>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endif
            @endauth
        @endif
    </ul>
</nav>

<!-- Slider Gambar -->
<div class="slider" aria-label="Slider gambar Paskibra E-Learning">
    <div class="slides">
        <img src="{{ asset('images/paskibra/baki.jpg') }}" alt="Latihan Paskibra di lapangan" />
        <img src="{{ asset('images/paskibra/pengibaran.JPG') }}" alt="Upacara bendera Paskibra" />
        <img src="{{ asset('images/paskibra/pengukuhan.JPG') }}" alt="Pelatihan baris-berbaris" />
        <img src="{{ asset('images/paskibra/veteran.JPG') }}" alt="Penghargaan dan prestasi Paskibra" />
        <img src="{{ asset('images/paskibra/2024.JPG') }}" alt="Kegiatan Paskibra 2024" />
    </div>
</div>

<section class="hero" role="banner" aria-label="Selamat datang di Paskibra E-Learning">
    <h1>Selamat Datang di Paskibra Wira Purusa E-Learning</h1>
    <p>Platform pembelajaran online resmi untuk anggota Paskibra Wira Purusa. Belajar, latih kemampuan, dan raih prestasi bersama kami kapan saja dan di mana saja.</p>
    @guest
        <a href="{{ route('register') }}" class="btn-primary" role="button" aria-label="Daftar akun baru">Daftar Sekarang</a>
    @else
        <a href="{{ url('/dashboard') }}" class="btn-primary" role="button" aria-label="Masuk ke Dashboard">Masuk ke Dashboard</a>
    @endguest
</section>

<section class="features" aria-label="Fitur utama Paskibra E-Learning">
    <article class="feature-card" tabindex="0" aria-describedby="desc1">
        <div class="feature-icon"><i class="fas fa-book-open"></i></div>
        <h3 class="feature-title">Materi Lengkap</h3>
        <p class="feature-desc" id="desc1">Akses materi pembelajaran lengkap dan terstruktur untuk meningkatkan kemampuanmu.</p>
    </article>
    <article class="feature-card" tabindex="0" aria-describedby="desc2">
        <div class="feature-icon"><i class="fas fa-pencil-alt"></i></div>
        <h3 class="feature-title">Quiz Interaktif</h3>
        <p class="feature-desc" id="desc2">Uji kemampuanmu dengan quiz interaktif yang menantang dan menyenangkan.</p>
    </article>
    <article class="feature-card" tabindex="0" aria-describedby="desc3">
        <div class="feature-icon"><i class="fas fa-bullhorn"></i></div>
        <h3 class="feature-title">Pengumuman Terbaru</h3>
        <p class="feature-desc" id="desc3">Dapatkan informasi terbaru seputar kegiatan dan pengumuman penting dari Paskibra.</p>
    </article>
    <article class="feature-card" tabindex="0" aria-describedby="desc4">
        <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
        <h3 class="feature-title">Laporan Nilai</h3>
        <p class="feature-desc" id="desc4">Pantau perkembangan dan hasil belajar Anda secara real-time.</p>
    </article>
</section>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            
            <!-- Logo dan Deskripsi -->
            <div class="footer-section about">
                <img src="{{ asset('images/logopaskib.jpg') }}" alt="Logo PASKIBRA" class="footer-logo" onerror="this.src='{{ asset('images/paskibra/new_logo.jpg') }}'"/>
                <p>Organisasi Paskibra Wira Purusa - Membangun generasi penerus yang disiplin dan berprestasi.</p>
            </div>

            <!-- Alamat -->
            <div class="footer-section address">
                <h3>Alamat</h3>
                <p>Gedung Wira Purusa, Jl. Radin Inten II No.2, RT.5/RW.14, Duren Sawit, Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13440</p>
                <p>Indonesia</p>
            </div>

            <!-- Kontak -->
            <div class="footer-section contact">
                <h3>Kontak Person</h3>
                                <p>Email: <a href="mailto:ppwp.provdkijakarta@gmail.com">ppwp.provdkijakarta@gmail.com</a></p>
            </div>

            <!-- Media Sosial -->
            <div class="footer-section social">
                <h3>Media Sosial</h3>
                <div class="social-icons">
                    <a href="https://www.instagram.com/ppwp.dkijakarta/" target="_blank" aria-label="Instagram" class="social-icon instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            &copy; {{ date('Y') }} Paskibra Wira Purusa. Semua hak cipta dilindungi.
        </div>
    </div>
</footer>

</body>
</html>