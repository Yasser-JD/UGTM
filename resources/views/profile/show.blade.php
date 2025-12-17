<x-layout title="الملف الشخصي">
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="text-3xl font-bold text-navy-900 mb-8">الملف الشخصي</h1>



            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="p-8">
                    @if(session('success'))
                        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 flex items-center gap-3 border border-green-100">
                            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                            <p class="text-gray-500">{{ $user->email }}</p>
                        </div>
                        <div>
                            @if($user->is_active)
                                <span class="bg-ugtm-purple text-white px-4 py-2 rounded-full font-bold shadow-sm">منخرط</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full font-bold border border-yellow-200">في انتظار التفعيل</span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gray-100 pt-6">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">رقم التأجير</p>
                            <p class="font-medium text-gray-800">{{ $user->rental_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">رقم الهاتف</p>
                            <p class="font-medium text-gray-800">{{ $user->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">الإقليم</p>
                            <p class="font-medium text-gray-800">{{ $user->province }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">الجماعة</p>
                            <p class="font-medium text-gray-800">{{ $user->commune }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">مقر العمل</p>
                            <p class="font-medium text-gray-800">{{ $user->workplace }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">الإطار</p>
                            <p class="font-medium text-gray-800">{{ $user->job_title }}</p>
                        </div>
                    </div>

                    @if(!$user->is_active)
                        <div class="mt-8 bg-blue-50 p-4 rounded-xl border border-blue-100 text-blue-800">
                            <p class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                طلب عضويتك قيد المراجعة من قبل الإدارة. سيتم تفعيل حسابك قريباً لتتمكن من تحميل الوثائق والاستفادة من الخدمات.
                            </p>
                        </div>
                    @else
                        <div class="mt-8">
                            <h3 class="font-bold text-lg mb-4">الخدمات المتاحة</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center hover:shadow-md transition cursor-pointer">
                                    <svg class="w-8 h-8 text-ugtm-purple mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    <span class="font-bold text-gray-700">تحميل الوثائق</span>
                                </div>
                                <a href="{{ route('complaints.create') }}" class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center hover:shadow-md transition cursor-pointer group">
                                    <svg class="w-8 h-8 text-ugtm-purple mx-auto mb-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                    <span class="font-bold text-gray-700">إرسال شكاية</span>
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="mt-8 border-t border-gray-100 pt-6 text-left">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white px-6 py-3 rounded-xl font-bold transition duration-300 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                تسجيل الخروج
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
