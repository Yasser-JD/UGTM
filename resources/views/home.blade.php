<x-layout>
    <!-- Hero Section -->
    <!-- Hero Section -->
    <section class="relative w-full h-[600px] bg-navy-900 overflow-hidden group" x-data='{ 
        activeSlide: 0, 
        slides: {!! $featuredPosts->map(fn($p) => [
            'id' => $p->id,
            'title' => $p->title,
            'excerpt' => Str::limit($p->content, 150),
            'image' => is_array($p->image) ? (str_starts_with($p->image[0], 'http') ? $p->image[0] : Storage::url($p->image[0])) : (str_starts_with($p->image, 'http') ? $p->image : Storage::url($p->image)),
            'url' => route('posts.show', $p->slug)
        ])->toJson() !!},
        timer: null,
        autoSlide: true,
        startTimer() {
            if (!this.autoSlide) return;
            this.timer = setInterval(() => {
                this.nextSlide();
            }, 5000);
        },
        stopTimer() {
            clearInterval(this.timer);
        },
        nextSlide() {
            this.activeSlide = this.activeSlide === this.slides.length - 1 ? 0 : this.activeSlide + 1;
        },
        prevSlide() {
            this.activeSlide = this.activeSlide === 0 ? this.slides.length - 1 : this.activeSlide - 1;
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
                this.prevSlide(); // Swipe Left -> Previous
            }
            if (this.touchEndX > this.touchStartX + 50) {
                this.stopAutoSlide();
                this.nextSlide(); // Swipe Right -> Next
            }
        },
        stopAutoSlide() {
            this.autoSlide = false;
            this.stopTimer();
        }
    }' x-init="startTimer()" @mouseenter="stopTimer()" @mouseleave="if(autoSlide) startTimer()" 
       @touchstart="handleTouchStart($event)" @touchend="handleTouchEnd($event)">
        
        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="slide.id">
            <div x-show="activeSlide === index" 
                 x-transition:enter="transition ease-in-out"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave=""
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 style="transition-duration: 1500ms;"
                 class="absolute inset-0 w-full h-full">
                
                <!-- Background Image -->
                <img :src="slide.image" :alt="slide.title" class="absolute inset-0 w-full h-full object-cover opacity-50">
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-navy-900 via-navy-900/60 to-transparent"></div>
                
                <!-- Content -->
                <div class="relative z-10 container mx-auto px-6 h-full flex flex-col items-center justify-center text-center">
                    <span class="inline-block py-1 px-4 rounded-full bg-white/10 text-white border border-white/20 text-sm font-bold mb-6 backdrop-blur-md animate-fade-in-up">
                         حديث الساعة
                    </span>
                    <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight drop-shadow-2xl max-w-5xl mx-auto" x-text="slide.title"></h1>
                    <p class="text-gray-200 text-xl mb-10 max-w-3xl mx-auto line-clamp-2 leading-relaxed opacity-90" x-text="slide.excerpt"></p>
                    <a :href="slide.url" class="inline-flex items-center gap-3 px-8 py-4 bg-ugtm-purple text-white font-bold rounded-full shadow-lg hover:bg-opacity-90 transition transform hover:-translate-y-1 hover:shadow-ugtm-purple/50">
                        <span>اقرأ المقال كاملاً</span>
                        <svg class="w-5 h-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </template>

        <!-- Navigation Dots -->
        <div class="absolute bottom-8 left-0 right-0 flex justify-center gap-3 z-20" x-show="slides.length > 1">
            <template x-for="(slide, index) in slides" :key="slide.id">
                <button @click="activeSlide = index" 
                        class="w-3 h-3 rounded-full transition-all duration-300"
                        :class="activeSlide === index ? 'bg-ugtm-purple w-8' : 'bg-white/50 hover:bg-white'">
                </button>
            </template>
        </div>

        <!-- Arrows -->
        <button @click="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 text-white/50 hover:text-white transition hidden md:block" x-show="slides.length > 1">
            <svg class="w-10 h-10 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button @click="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 text-white/50 hover:text-white transition hidden md:block" x-show="slides.length > 1">
            <svg class="w-10 h-10 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </section>

    <div class="container mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Latest News -->
            <div class="lg:w-3/4">
                <div class="flex justify-between items-center mb-8 border-b-2 border-gray-200 pb-4">
                    <h2 class="text-3xl font-bold text-navy-800 border-b-4 border-ugtm-purple inline-block pb-4 -mb-5">آخر الأخبار</h2>
                    <a href="{{ route('categories.show', 'news') }}" class="text-ugtm-purple hover:underline">عرض الكل &larr;</a>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($latestPosts as $post)
                    <article class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100">
                        <div class="h-48 bg-gray-200 relative">
                            @php
                                $image = is_array($post->image) ? $post->image[0] : $post->image;
                            @endphp
                            <img src="{{ str_starts_with($image, 'http') ? $image : Storage::url($image) }}" class="w-full h-full object-cover">
                            <a href="{{ route('categories.show', $post->category->slug) }}" class="absolute top-4 right-4 bg-ugtm-purple text-white text-xs px-2 py-1 rounded hover:bg-navy-800 transition">
                                {{ $post->category->name }}
                            </a>
                        </div>
                        <div class="p-5">
                            <span class="text-gray-400 text-sm flex items-center gap-1 mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $post->created_at->format('Y-m-d') }}
                            </span>
                            <h3 class="text-lg font-bold text-navy-800 mb-2 leading-snug hover:text-ugtm-purple transition">
                                <a href="{{ route('posts.show', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-ugtm-purple text-sm font-bold mt-2 inline-block">اقرأ التفاصيل</a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar -->
            <x-sidebar :memos="$memos" />

        </div>
    </div>
</x-layout>
