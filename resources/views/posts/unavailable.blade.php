<x-layout>
    <div class="min-h-[60vh] flex flex-col items-center justify-center text-center px-4">
        <div class="bg-red-50 text-red-500 rounded-full p-6 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 mb-4 font-outfit">عذراً، هذا المحتوى غير متاح</h1>
        
        <p class="text-gray-600 text-lg mb-8 max-w-md">
            المقال الذي تحاول الوصول إليه قد تم حذفه أو لم يتم نشره بعد.
        </p>

        <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-ugtm-purple hover:bg-ugtm-purple-dark transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            العودة إلى الصفحة الرئيسية
        </a>
    </div>
</x-layout>
