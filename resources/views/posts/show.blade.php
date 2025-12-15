<x-layout title="{{ $post->title }}">
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                <a href="/" class="hover:text-ugtm-purple">الرئيسية</a>
                <span>/</span>
                <a href="{{ route('categories.show', $post->category->slug) }}" class="text-ugtm-purple font-bold hover:underline">{{ $post->category->name }}</a>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="lg:w-4/5">
                    <!-- Article Header -->
                    <div class="mb-8">
                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                            <span class="flex items-center gap-1 bg-white px-3 py-1 rounded-full shadow-sm border border-gray-100">
                                <svg class="w-4 h-4 text-ugtm-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $post->created_at->format('Y-m-d') }}
                            </span>
                            @if($post->is_urgent)
                            <span class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-xs font-bold border border-red-100 animate-pulse">عاجل</span>
                            @endif
                        </div>
                        <h1 class="text-3xl md:text-5xl font-extrabold text-navy-900 mb-6 leading-tight">
                            {{ $post->title }}
                        </h1>
                    </div>

                    <!-- Featured Image -->
                    @if($post->image)
                    <div class="mb-10 rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                        <img src="{{ str_starts_with($post->image, 'http') ? $post->image : Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
                    </div>
                    @endif

                    <!-- Article Body -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10">
                        <div class="prose prose-lg prose-slate max-w-none text-gray-700 leading-relaxed break-words prose-headings:font-bold prose-headings:text-navy-900 prose-a:text-ugtm-purple prose-a:no-underline hover:prose-a:underline prose-img:rounded-xl">
                            {!! nl2br(e($post->content)) !!}
                        </div>

                        <!-- Attachments -->
                        @if($post->attachment)
                        <div class="mt-12">
                            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4 hover:border-ugtm-purple/30 hover:shadow-md transition duration-300 group">
                                <div class="flex items-center gap-4 w-full sm:w-auto">
                                    <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center shadow-sm text-red-500 border border-gray-100 group-hover:scale-105 transition">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-navy-900 text-lg">تحميل المرفق الرسمي</p>
                                        <p class="text-xs text-gray-500">ملف PDF • اضغط للتحميل</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($post->attachment) }}" class="w-full sm:w-auto text-center bg-navy-800 text-white px-6 py-3 rounded-lg hover:bg-ugtm-purple transition shadow-lg hover:shadow-xl font-bold flex items-center justify-center gap-2" download>
                                    <span>تحميل الملف</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <x-sidebar :memos="$memos" />
            </div>
        </div>
    </div>
</x-layout>
