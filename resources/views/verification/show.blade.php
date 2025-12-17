<x-layout title="تحقق من العضوية">
    <div class="bg-gray-50 min-h-screen py-12 flex items-center justify-center">
        <div class="container mx-auto px-4 max-w-md text-center">
            
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>

                <h1 class="text-2xl font-bold text-navy-900 mb-2">عضوية صالحة</h1>
                <p class="text-gray-500 mb-8">هذه البطاقة صالحة وتنتمي لعضو مسجل.</p>

                <div class="space-y-4 text-right bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center border-b border-gray-200 pb-3">
                        <span class="text-gray-400 text-sm">الاسم الكامل</span>
                        <span class="font-bold text-navy-800">{{ $user->name }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-200 pb-3">
                        <span class="text-gray-400 text-sm">رقم التأجير</span>
                        <span class="font-bold text-navy-800">{{ $user->rental_number }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-200 pb-3">
                        <span class="text-gray-400 text-sm">مقر العمل</span>
                        <span class="font-bold text-navy-800">{{ $user->workplace }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 text-sm">الصفة</span>
                        <span class="font-bold text-navy-800">{{ $user->job_title }}</span>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="/" class="text-ugtm-purple font-bold hover:underline">العودة للرئيسية</a>
                </div>
            </div>

        </div>
    </div>
</x-layout>
