@props(['memos'])

<aside class="lg:w-1/5">
     <!-- Search Widget -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
        <h3 class="text-xl font-bold text-navy-800 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-ugtm-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            بحث
        </h3>
        <form action="{{ route('search') }}" method="GET" class="relative">
            <input type="text" name="q" placeholder="ابحث عن مقال..." class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 px-4 pr-10 focus:outline-none focus:border-ugtm-purple focus:ring-1 focus:ring-ugtm-purple transition text-sm">
            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-ugtm-purple transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </form>
    </div>
    @auth
    <!-- Profile Widget -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 bg-ugtm-purple/10 text-ugtm-purple rounded-full flex items-center justify-center shrink-0">
                <span class="font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <div>
                <h4 class="font-bold text-navy-900 text-sm">{{ Auth::user()->name }}</h4>
                <p class="text-xs text-gray-500">عضو مسجل</p>
            </div>
        </div>
        <a href="{{ route('profile.show') }}" class="block w-full border border-ugtm-purple text-ugtm-purple py-1.5 rounded-lg font-bold hover:bg-ugtm-purple hover:text-white transition text-center text-sm">
            الملف الشخصي
        </a>
    </div>
    @endauth

    @guest
    <!-- Login Widget -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
        <h3 class="text-xl font-bold text-navy-800 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-ugtm-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
            فضاء المنخرط
        </h3>
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">رقم التأجير</label>
                <input type="text" name="rental_number" required class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:border-ugtm-purple focus:ring-1 focus:ring-ugtm-purple transition text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور</label>
                <input type="password" name="password" required class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:border-ugtm-purple focus:ring-1 focus:ring-ugtm-purple transition text-sm">
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember_sidebar" class="h-3.5 w-3.5 text-ugtm-purple focus:ring-ugtm-purple border-gray-300 rounded">
                <label for="remember_sidebar" class="mr-2 block text-xs text-gray-900">
                    تذكرني
                </label>
            </div>
            <button type="submit" class="w-full bg-ugtm-purple text-white py-2 rounded-lg font-bold hover:bg-navy-900 transition shadow-md">
                دخول
            </button>
            <div class="text-center text-xs text-gray-500 mt-2">
                ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-ugtm-purple hover:underline font-bold">انخرط الآن</a>
            </div>
        </form>
    </div>
    @endguest
   

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
        <h3 class="text-xl font-bold text-navy-800 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-ugtm-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            المذكرات الوزارية
        </h3>
        
        <ul class="space-y-4">
            @forelse($memos as $memo)
            <li class="group cursor-pointer">
                <a href="{{ route('posts.show', $memo->slug) }}" class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-red-50 text-red-500 rounded flex items-center justify-center shrink-0">
                        <span class="font-bold text-xs">PDF</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-navy-800 group-hover:text-ugtm-purple transition">{{ $memo->title }}</p>
                        @if($memo->attachment)
                        <span class="text-xs text-gray-400">تحميل PDF</span>
                        @else
                        <span class="text-xs text-gray-400">عرض التفاصيل</span>
                        @endif
                    </div>
                </a>
            </li>
            <hr class="border-gray-100">
            @empty
            <li class="text-gray-500 text-sm">لا توجد مذكرات حالياً</li>
            @endforelse
        </ul>

        <a href="{{ route('categories.show', 'memos') }}" class="block w-full mt-6 py-2 border border-navy-800 text-navy-800 rounded-lg hover:bg-navy-800 hover:text-white transition font-bold text-sm text-center">
            مشاهدة جميع الوثائق
        </a>
    </div>
</aside>
