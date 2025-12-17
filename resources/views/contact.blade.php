<x-layout title="اتصل بنا - الجامعة الحرة للتعليم">
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Header -->
            <div class="text-center mb-12">
                <span class="text-ugtm-purple font-bold tracking-wider uppercase text-sm">تواصل معنا</span>
                <h1 class="text-4xl font-bold text-navy-900 mt-2">اتصل بنا</h1>
                <div class="w-24 h-1 bg-ugtm-purple mx-auto mt-4 rounded-full"></div>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                    نحن هنا للإجابة على استفساراتكم والاستماع إلى مقترحاتكم. لا تترددوا في التواصل معنا.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row">
                <!-- Contact Info -->
                <div style="padding: 40px;" class="bg-navy-900 text-white p-10 md:w-1/3 flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-6">معلومات الاتصال</h3>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-200 text-sm uppercase mb-1">العنوان</h4>
                                    <p class="text-gray-300 text-sm leading-relaxed">الرباط، المغرب</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-200 text-sm uppercase mb-1">البريد الإلكتروني</h4>
                                    <p class="text-gray-300 text-sm">contact@ugtm-education.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative z-10 mt-12">
                        <h4 class="font-bold text-gray-200 text-sm uppercase mb-4">تابعنا</h4>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-ugtm-purple transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-ugtm-purple transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div style="padding: 40px 20px;" class="p-10 md:w-2/3">
                    @if(session('error'))
                        <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 flex items-center gap-3 border border-red-100">
                            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 flex items-center gap-3 border border-green-100">
                            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-bold text-navy-800 mb-2">الاسم الكامل</label>
                                <input type="text" name="name" id="name" required class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-ugtm-purple focus:ring-1 focus:ring-ugtm-purple transition">
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-bold text-navy-800 mb-2">رقم الهاتف</label>
                                <input type="tel" name="phone" id="phone" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-ugtm-purple focus:ring-1 focus:ring-ugtm-purple transition">
                                @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-navy-800 mb-2">البريد الإلكتروني</label>
                            <input type="email" name="email" id="email" required class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-ugtm-purple focus:ring-1 focus:ring-ugtm-purple transition">
                            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-bold text-navy-800 mb-2">الرسالة</label>
                            <textarea name="message" id="message" rows="5" required class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-ugtm-purple focus:ring-1 focus:ring-ugtm-purple transition"></textarea>
                            @error('message') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full bg-ugtm-purple text-white font-bold py-4 rounded-lg hover:bg-navy-900 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            إرسال الرسالة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
