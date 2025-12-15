@props(['memos'])

<aside class="lg:w-1/5">
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

        <button class="w-full mt-6 py-2 border border-navy-800 text-navy-800 rounded-lg hover:bg-navy-800 hover:text-white transition font-bold text-sm">
            مشاهدة جميع الوثائق
        </button>
    </div>
</aside>
