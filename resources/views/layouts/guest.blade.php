<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PASKIBRA WiraPurusa E-Learning') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, rgb(15, 2, 2) 0%, rgb(203, 17, 17) 100%);
            min-height: 100vh;
        }
        
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.6);
            background: linear-gradient(135deg, #B91C1C 0%, #991B1B 100%);
        }
        
        .form-input {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }
        
        .form-input:focus {
            border-color: #DC2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
            outline: none;
        }
        
        .form-label {
            color: #374151;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }
        
        .link-primary {
            color: #DC2626;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .link-primary:hover {
            color: #B91C1C;
            text-decoration: underline;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo-container img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }
        
        .logo-subtitle {
            color: #6B7280;
            font-size: 0.9rem;
        }
        
        .error-message {
            color: #DC2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        
        .success-message {
            color: #059669;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: rgba(5, 150, 105, 0.1);
            border-radius: 8px;
            border-left: 4px solid #059669;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Back to Home Link -->
        <div class="w-full sm:max-w-md px-6 py-4">
            <a href="{{ route('welcome') }}" class="inline-flex items-center text-white hover:text-yellow-300 transition duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 auth-card overflow-hidden">
            <!-- Logo Section -->
            <div class="logo-container">
                <img src="{{ asset('images/logopaskib.jpg') }}" alt="PASKIBRA Logo" onerror="this.src='{{ asset('images/paskibra/logo.jpg') }}'">
                <div class="logo-text">PASKIBRA WiraPurusa</div>
                <div class="logo-subtitle">E-Learning Platform</div>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>
</html>