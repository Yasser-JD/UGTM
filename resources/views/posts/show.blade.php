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
                            
                            <!-- Share Button -->
                            <button x-data="{
                                copied: false,
                                async share() {
                                    const url = window.location.href;
                                    const title = '{{ $post->title }}';

                                    if (navigator.share) {
                                        try {
                                            await navigator.share({
                                                title: title,
                                                url: url
                                            });
                                        } catch (err) {
                                            console.error('Share failed:', err);
                                        }
                                    } else {
                                        try {
                                            if (navigator.clipboard && navigator.clipboard.writeText) {
                                                await navigator.clipboard.writeText(url);
                                            } else {
                                                // Legacy fallback
                                                const textArea = document.createElement('textarea');
                                                textArea.value = url;
                                                textArea.style.position = 'fixed'; // Avoid scrolling to bottom
                                                document.body.appendChild(textArea);
                                                textArea.focus();
                                                textArea.select();
                                                try {
                                                    document.execCommand('copy');
                                                } catch (err) {
                                                    console.error('Fallback copy failed', err);
                                                    alert('Please copy this URL manually: ' + url);
                                                }
                                                document.body.removeChild(textArea);
                                            }
                                            this.copied = true;
                                            setTimeout(() => this.copied = false, 2000);
                                        } catch (err) {
                                            console.error('Copy failed:', err);
                                            alert('Please copy this URL manually: ' + url);
                                        }
                                    }
                                }
                            }" 
                            @click="share()"
                            class="flex items-center gap-2 px-3 py-1 rounded-full border transition text-xs font-bold cursor-pointer"
                            :class="copied ? 'bg-green-50 text-green-600 border-green-200' : 'bg-white text-gray-500 border-gray-100 hover:bg-ugtm-purple hover:text-white hover:border-ugtm-purple'">
                                <template x-if="!copied">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                </template>
                                <template x-if="copied">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </template>
                                <span x-text="copied ? 'تم النسخ!' : 'مشاركة'"></span>
                            </button>
                        </div>
                        <h1 class="text-3xl md:text-5xl font-extrabold text-navy-900 mb-6 leading-tight">
                            {{ $post->title }}
                        </h1>
                    </div>

                    <!-- Featured Image / Slider -->
                    @if($post->image)
                        @php
                            $images = is_array($post->image) ? $post->image : [$post->image];
                        @endphp
                        
                        @if(count($images) > 1)
                            <div class="relative w-full mb-10 rounded-2xl overflow-hidden shadow-lg border border-gray-100 group" 
                                 style="height: 500px;"
                                 x-data='{ 
                                    activeSlide: 0, 
                                    slides: @json($images),
                                    timer: null,
                                    autoSlide: true,
                                    startTimer() {
                                        if (!this.autoSlide) return;
                                        this.timer = setInterval(() => {
                                            this.activeSlide = this.activeSlide === this.slides.length - 1 ? 0 : this.activeSlide + 1;
                                        }, 2000);
                                    },
                                    stopTimer() {
                                        clearInterval(this.timer);
                                    },
                                    touchStartX: 0,
                                    touchEndX: 0,
                                    handleTouchStart(e) {
                                        this.touchStartX = e.changedTouches[0].screenX;
                                    },
                                    handleTouchEnd(e) {
                                        this.touchEndX = e.changedTouches[0].screenX;
                                        this.handleSwipe();
                                    },
                                    handleSwipe() {
                                        if (this.touchEndX < this.touchStartX - 50) {
                                            this.stopAutoSlide();
                                            this.activeSlide = this.activeSlide === 0 ? this.slides.length - 1 : this.activeSlide - 1; // Swipe Left -> Previous
                                        }
                                        if (this.touchEndX > this.touchStartX + 50) {
                                            this.stopAutoSlide();
                                            this.activeSlide = this.activeSlide === this.slides.length - 1 ? 0 : this.activeSlide + 1; // Swipe Right -> Next
                                        }
                                    },
                                    stopAutoSlide() {
                                        this.autoSlide = false;
                                        this.stopTimer();
                                    }
                                 }'
                                 x-init="startTimer()"
                                 @mouseenter="stopTimer()"
                                 @mouseleave="if(autoSlide) startTimer()"
                                 @touchstart="handleTouchStart($event)"
                                 @touchend="handleTouchEnd($event)">
                                
                                <!-- Slides -->
                                <template x-for="(slide, index) in slides" :key="index">
                                    <div x-show="activeSlide === index" 
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0 transform scale-95"
                                         x-transition:enter-end="opacity-100 transform scale-100"
                                         x-transition:leave="transition ease-in duration-300"
                                         x-transition:leave-start="opacity-100 transform scale-100"
                                         x-transition:leave-end="opacity-0 transform scale-95"
                                         class="absolute inset-0 w-full h-full">
                                        <img :src="slide.startsWith('http') ? slide : '/storage/' + slide" :alt="'Slide ' + (index + 1)" class="w-full h-full object-cover">
                                    </div>
                                </template>

                                <!-- Navigation Arrows -->
                                <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-2 rounded-full transition backdrop-blur-sm">
                                    <svg class="w-6 h-6 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                </button>
                                <button @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white p-2 rounded-full transition backdrop-blur-sm">
                                    <svg class="w-6 h-6 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </button>

                                <!-- Dots -->
                                <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                                    <template x-for="(slide, index) in slides" :key="index">
                                        <button @click="activeSlide = index" 
                                                class="w-2.5 h-2.5 rounded-full transition-all"
                                                :class="activeSlide === index ? 'bg-white w-6' : 'bg-white/50 hover:bg-white'">
                                        </button>
                                    </template>
                                </div>
                            </div>
                        @else
                            <div class="mb-10 rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                                <img src="{{ str_starts_with($images[0], 'http') ? $images[0] : Storage::url($images[0]) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
                            </div>
                        @endif
                    @endif

                    <!-- Article Body -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10">
                        <div class="prose prose-lg prose-slate max-w-none text-gray-700 leading-relaxed break-words prose-headings:font-bold prose-headings:text-navy-900 prose-a:text-ugtm-purple prose-a:no-underline hover:prose-a:underline prose-img:rounded-xl">
                            {!! nl2br(e($post->content)) !!}
                        </div>

                        <!-- Attachments -->
                        @if($post->attachment)
                            @php
                                $attachments = is_array($post->attachment) ? $post->attachment : [$post->attachment];
                            @endphp
                            <div class="mt-12">
                                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                                    <h3 class="font-bold text-navy-900 mb-4 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-ugtm-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                        مرفقات التحميل
                                    </h3>
                                    <div class="space-y-3">
                                        @foreach($attachments as $attachment)
                                            @if(Auth::check() && Auth::user()->is_active)
                                                <a href="{{ Storage::url($attachment) }}" target="_blank" class="flex items-center justify-between bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition border border-gray-100 group">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-10 h-10 bg-red-50 text-red-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                                        </div>
                                                        <span class="font-medium text-gray-700 group-hover:text-ugtm-purple transition" dir="ltr">{{ basename($attachment) }}</span>
                                                    </div>
                                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-ugtm-purple transition rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                </a>
                                            @else
                                                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-10 h-10 bg-gray-200 text-gray-500 rounded-lg flex items-center justify-center">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                        </div>
                                                        <div>
                                                            <span class="font-medium text-gray-700 block" dir="ltr">{{ basename($attachment) }}</span>
                                                            <span class="text-xs text-red-500 font-bold">
                                                                @if(Auth::check())
                                                                    عذراً، يجب أن تكون عضواً مفعلاً لتحميل هذا الملف.
                                                                @else
                                                                    عذراً، يجب تسجيل الدخول وتفعيل العضوية لتحميل الملف.
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
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
