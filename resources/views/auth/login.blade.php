<x-layout title="تسجيل الدخول">
    <div class="bg-gray-50 min-h-screen py-12 flex items-center justify-center">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md border border-gray-100">
            <h2 class="text-3xl font-bold text-navy-900 mb-8 text-center">تسجيل الدخول</h2>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Rental Number -->
                <div>
                    <label for="rental_number" class="block text-sm font-medium text-gray-700 mb-1">رقم التأجير</label>
                    <input type="text" name="rental_number" id="rental_number" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ugtm-purple focus:border-transparent transition" value="{{ old('rental_number') }}">
                    @error('rental_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom:0.5rem;">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ugtm-purple focus:border-transparent transition">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Remember Me -->
                <div  style="margin-bottom:0.5rem;" class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-ugtm-purple focus:ring-ugtm-purple border-gray-300 rounded">
                    <label for="remember" class="mr-2 block text-sm text-gray-900">
                        تذكرني
                    </label>
                </div>

                <button type="submit" class="w-full bg-ugtm-purple text-white font-bold py-3 rounded-lg hover:bg-ugtm-purple-dark transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    دخول
                </button>
            </form>
            
            <div class="mt-6 text-center text-sm text-gray-600">
                ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-ugtm-purple font-bold hover:underline">انخرط الآن</a>
            </div>
        </div>
    </div>
</x-layout>
