<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'UGTM Education' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">



    <!-- Top Bar -->
    <div class="bg-navy-900 text-white py-2 text-sm hidden md:block">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-4 opacity-80">
                 <span>{{ now()->locale('ar')->translatedFormat('l j F Y') }}</span>
                <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
            </div>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-ugtm-purple transition"><span class="sr-only">Facebook</span><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                <a href="#" class="hover:text-ugtm-purple transition"><span class="sr-only">Twitter</span><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                <span class="w-px h-4 bg-gray-700"></span>
                <a href="mailto:contact@ugtm-education.com" class="hover:text-ugtm-purple transition text-xs">contact@ugtm-education.com</a>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            
            <div class="flex items-center gap-3">
                <a href="/" class="flex items-center gap-3 group">
                    <img src="/images/logo.png" alt="UGTM Logo"    class="h-16 w-auto transition transform group-hover:scale-120">
                    <div class="flex flex-col">
                        <span class="text-2xl font-black text-navy-900 tracking-tight leading-none group-hover:text-ugtm-purple transition">UGTM</span>
                        <span class="text-xs font-bold text-gray-500 tracking-widest uppercase group-hover:text-navy-900 transition">Education</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center space-x-8 space-x-reverse">
                <a href="/" class="text-navy-900 font-bold hover:text-ugtm-purple transition relative py-2 group">
                    الرئيسية
                    <span class="absolute bottom-0 right-0 w-0 h-0.5 bg-ugtm-purple transition-all duration-300 group-hover:w-full"></span>
                </a>
                
                @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="text-gray-600 font-medium hover:text-ugtm-purple transition relative py-2 group">
                    {{ $category->name }}
                    <span class="absolute bottom-0 right-0 w-0 h-0.5 bg-ugtm-purple transition-all duration-300 group-hover:w-full"></span>
                </a>
                @endforeach

                <a href="#" class="px-6 py-2.5 mr-2 bg-navy-900 text-white rounded-full hover:bg-ugtm-purple transition shadow-lg hover:shadow-ugtm-purple/30 font-bold text-sm transform hover:-translate-y-0.5">
                    اتصل بنا
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-navy-900 hover:text-ugtm-purple focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition.origin.top class="md:hidden bg-white border-t border-gray-100 absolute w-full shadow-lg">
            <div class="flex flex-col p-4 space-y-4">
                <a href="/" class="text-navy-900 font-bold hover:text-ugtm-purple transition block px-4 py-2 rounded-lg hover:bg-gray-50">الرئيسية</a>
                @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="text-gray-600 font-medium hover:text-ugtm-purple transition block px-4 py-2 rounded-lg hover:bg-gray-50 text-center">{{ $category->name }}</a>
                @endforeach
                <a href="#"  class="text-center px-6 py-3 mr-5 bg-navy-900 text-white rounded-lg hover:bg-ugtm-purple transition font-bold">اتصل بنا</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-navy-900 text-white py-12 mt-12">
        <div class="container mx-auto px-4 grid md:grid-cols-3 gap-8 text-center md:text-right">
            <div>
                <h3 class="text-xl font-bold mb-4">الجامعة الحرة للتعليم</h3>
                <p class="text-gray-400">نضال مستمر من أجل كرامة الأسرة التعليمية.</p>
                <img src="/images/logo3.png" alt="UGTM Footer Logo" style="width: 300px; height: auto;" class="h-24 mx-auto md:mx-0 mt-4 opacity-90">
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">روابط سريعة</h3>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white">الرئيسية</a></li>
                    <li><a href="#" class="hover:text-white">اتصل بنا</a></li>
                </ul>

            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">تواصل معنا</h3>
                <p class="text-gray-400">الرباط، المغرب</p>
                <p class="text-gray-400">contact@ugtm-education.com</p>
            </div>
            
        </div>
        <div class="text-center text-gray-600 mt-2 pt-2 border-t border-gray-800">
            &copy; {{ date('Y') }} UGTM Education. All rights reserved.
        </div>
    </footer>

</body>
</html>
