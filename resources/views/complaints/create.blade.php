<x-layout title="إرسال شكاية">
    <div class="bg-gray-50 min-h-screen py-12 flex items-center justify-center">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-2xl border border-gray-100">
            <h2 class="text-3xl font-bold text-navy-900 mb-8 text-center">إرسال شكاية</h2>

            <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">نوع المشكلة</label>
                    <select name="type" id="type" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ugtm-purple focus:border-transparent transition">
                        <option value="">اختر نوع المشكلة</option>
                        <option value="administrative">مشكلة إدارية</option>
                        <option value="educational">مشكلة تربوية</option>
                        <option value="financial">مشكلة مالية</option>
                        <option value="legal">مشكلة قانونية</option>
                        <option value="other">أخرى</option>
                    </select>
                    @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">موضوع الشكاية</label>
                    <input type="text" name="subject" id="subject" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ugtm-purple focus:border-transparent transition" value="{{ old('subject') }}">
                    @error('subject') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Details -->
                <div>
                    <label for="details" class="block text-sm font-medium text-gray-700 mb-1">تفاصيل المشكلة</label>
                    <textarea name="details" id="details" rows="5" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ugtm-purple focus:border-transparent transition">{{ old('details') }}</textarea>
                    @error('details') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Attachment -->
                <div>
                    <label for="attachment" class="block text-sm font-medium text-gray-700 mb-1">مرفقات (اختياري)</label>
                    <input type="file" name="attachment[]" id="attachment" multiple class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ugtm-purple focus:border-transparent transition">
                    <p class="text-xs text-gray-500 mt-1">يمكنك إرفاق ملفات داعمة لشكايتك (صور، PDF، مستندات).</p>
                    @error('attachment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('profile.show') }}" class="text-gray-600 hover:text-gray-800 font-medium">إلغاء</a>
                    <button type="submit" class="bg-ugtm-purple text-white font-bold py-3 px-8 rounded-lg hover:bg-ugtm-purple-dark transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        إرسال
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
