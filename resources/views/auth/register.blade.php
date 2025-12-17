<x-layout title="تسجيل الانخراط">
    <div class="bg-gray-50 min-h-screen py-12 flex items-center justify-center">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-2xl border border-gray-100">
            <h2 class="text-3xl font-bold text-navy-900 mb-8 text-center">طلب الانخراط</h2>

            <form action="{{ route('register') }}" method="POST" class="space-y-6"
                  x-data="{
                      locations: {{ json_encode($locations) }},
                      commune: '',
                      schools: [],
                      updateSchools() {
                          this.schools = this.locations[this.commune] || [];
                      },
                      formData: {
                          name: '{{ old('name') }}',
                          rental_number: '{{ old('rental_number') }}',
                          email: '{{ old('email') }}',
                          phone: '{{ old('phone') }}',
                          password: '',
                          password_confirmation: '',
                          commune: '',
                          workplace: '',
                          job_title: '',
                          agree_organic_law: false,
                          agree_solidarity: false
                      },
                      touched: {},
                      errors: {},
                      validate(field) {
                          this.touched[field] = true;
                          this.errors[field] = null;

                          const value = this.formData[field];

                          if (field === 'name') {
                              if (!value) this.errors.name = 'الاسم مطلوب';
                              else if (!/^[\u0600-\u06FF\s]+$/.test(value)) this.errors.name = 'الاسم يجب أن يكون بالحروف العربية فقط';
                          }
                          if (field === 'rental_number' && !value) this.errors.rental_number = 'رقم التأجير مطلوب';
                          if (field === 'email') {
                              if (!value) this.errors.email = 'البريد الإلكتروني مطلوب';
                              else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) this.errors.email = 'البريد الإلكتروني غير صالح';
                          }
                          if (field === 'phone' && !value) this.errors.phone = 'رقم الهاتف مطلوب';
                          if (field === 'commune' && !value) this.errors.commune = 'يرجى اختيار الجماعة';
                          if (field === 'workplace' && !value) this.errors.workplace = 'يرجى اختيار المؤسسة';
                          if (field === 'job_title' && !value) this.errors.job_title = 'يرجى اختيار الإطار';
                          if (field === 'password') {
                              if (!value) this.errors.password = 'كلمة المرور مطلوبة';
                              else if (value.length < 8) this.errors.password = 'كلمة المرور يجب أن تكون 8 حروف على الأقل';
                          }
                          if (field === 'password_confirmation') {
                              if (value !== this.formData.password) this.errors.password_confirmation = 'كلمة المرور غير متطابقة';
                          }
                          if (field === 'agree_organic_law' && !this.formData.agree_organic_law) this.errors.agree_organic_law = 'يجب الموافقة على القانون التنظيمي';
                          if (field === 'agree_solidarity' && !this.formData.agree_solidarity) this.errors.agree_solidarity = 'يجب الموافقة على الميثاق';
                      },
                      isValid(field) {
                          return this.touched[field] && !this.errors[field];
                      },
                      isInvalid(field) {
                          return this.touched[field] && this.errors[field];
                      },
                      getInputClass(field) {
                          if (this.isInvalid(field)) return 'border-red-500 focus:border-red-500 focus:ring-red-500';
                          if (this.isValid(field)) return 'border-green-500 focus:border-green-500 focus:ring-green-500';
                          return 'border-gray-300 focus:border-ugtm-purple focus:ring-ugtm-purple';
                      }
                  }">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">الاسم الكامل (بالعربية فقط)</label>
                    <input type="text" name="name" id="name" x-model="formData.name" @blur="validate('name')" @input="validate('name')" required 
                           class="w-full px-4 py-2 rounded-lg border focus:ring-2 transition"
                           :class="getInputClass('name')" dir="rtl">
                    <span x-show="isInvalid('name')" x-text="errors.name" class="text-red-500 text-sm mt-1 block"></span>
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Rental Number -->
                <div>
                    <label for="rental_number" class="block text-sm font-medium text-gray-700 mb-1">رقم التأجير</label>
                    <input type="text" name="rental_number" id="rental_number" x-model="formData.rental_number" @blur="validate('rental_number')" @input="validate('rental_number')" required 
                           class="w-full px-4 py-2 rounded-lg border focus:ring-2 transition"
                           :class="getInputClass('rental_number')">
                    <span x-show="isInvalid('rental_number')" x-text="errors.rental_number" class="text-red-500 text-sm mt-1 block"></span>
                    @error('rental_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" x-model="formData.email" @blur="validate('email')" @input="validate('email')" required 
                           class="w-full px-4 py-2 rounded-lg border focus:ring-2 transition"
                           :class="getInputClass('email')">
                    <span x-show="isInvalid('email')" x-text="errors.email" class="text-red-500 text-sm mt-1 block"></span>
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">رقم الهاتف</label>
                    <input type="text" name="phone" id="phone" x-model="formData.phone" @blur="validate('phone')" @input="validate('phone')" required 
                           class="w-full px-4 py-2 rounded-lg border focus:ring-2 transition"
                           :class="getInputClass('phone')">
                    <span x-show="isInvalid('phone')" x-text="errors.phone" class="text-red-500 text-sm mt-1 block"></span>
                    @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Province (Fixed) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الإقليم</label>
                    <input type="text" value="العرائش (Larache)" disabled class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed">
                </div>

                <!-- Commune -->
                <div>
                    <label for="commune" class="block text-sm font-medium text-gray-700 mb-1">الجماعة</label>
                    <select name="commune" id="commune" x-model="formData.commune" @change="commune = formData.commune; updateSchools(); validate('commune')" required 
                            class="w-full px-4 py-2 rounded-lg border focus:ring-2 transition"
                            :class="getInputClass('commune')">
                        <option value="">اختر الجماعة</option>
                        <template x-for="(schoolsList, communeName) in locations" :key="communeName">
                            <option :value="communeName" x-text="communeName"></option>
                        </template>
                    </select>
                    <span x-show="isInvalid('commune')" x-text="errors.commune" class="text-red-500 text-sm mt-1 block"></span>
                    @error('commune') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Workplace (School) -->
                <div>
                    <label for="workplace" class="block text-sm font-medium text-gray-700 mb-1">مقر العمل (المؤسسة)</label>
                    <select name="workplace" id="workplace" x-model="formData.workplace" @change="validate('workplace')" required 
                            class="w-full px-4 py-2 rounded-lg border focus:ring-2 transition"
                            :class="getInputClass('workplace')" :disabled="!formData.commune">
                        <option value="">اختر المؤسسة</option>
                        <template x-for="school in schools" :key="school">
                            <option :value="school" x-text="school"></option>
                        </template>
                    </select>
                    <span x-show="isInvalid('workplace')" x-text="errors.workplace" class="text-red-500 text-sm mt-1 block"></span>
                    @error('workplace') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Job Title -->
                <div>
                    <label for="job_title" class="block text-sm font-medium text-gray-700 mb-1">الإطار</label>
                    <select name="job_title" id="job_title" x-model="formData.job_title" @change="validate('job_title')" required 
                            class="w-full px-4 py-2 rounded-lg border focus:ring-2 transition"
                            :class="getInputClass('job_title')">
                        <option value="">اختر الإطار</option>
                        <option value="متصرف تربوي">متصرف تربوي</option>
                        <option value="أستاذ التعليم الابتدائي">أستاذ التعليم الابتدائي</option>
                        <option value="أستاذ التعليم الثانوي الإعدادي">أستاذ التعليم الثانوي الإعدادي</option>
                        <option value="أستاذ التعليم الثانوي التأهيلي">أستاذ التعليم الثانوي التأهيلي</option>
                        <option value="ملحق تربوي">ملحق تربوي</option>
                        <option value="ملحق الاقتصاد والإدارة">ملحق الاقتصاد والإدارة</option>
                    </select>
                    <span x-show="isInvalid('job_title')" x-text="errors.job_title" class="text-red-500 text-sm mt-1 block"></span>
                    @error('job_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور</label>
                    <input type="password" name="password" id="password" x-model="formData.password" @blur="validate('password')" @input="validate('password'); validate('password_confirmation')" required 
                           class="w-full px-4 py-2 rounded-lg border focus:ring-2 transition"
                           :class="getInputClass('password')">
                    <span x-show="isInvalid('password')" x-text="errors.password" class="text-red-500 text-sm mt-1 block"></span>
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" x-model="formData.password_confirmation" @blur="validate('password_confirmation')" @input="validate('password_confirmation')" required 
                           class="w-full px-4 py-2 rounded-lg border focus:ring-2 transition"
                           :class="getInputClass('password_confirmation')">
                    <span x-show="isInvalid('password_confirmation')" x-text="errors.password_confirmation" class="text-red-500 text-sm mt-1 block"></span>
                </div>

                <!-- Agreements -->
                <div class="space-y-4 pt-4 border-t border-gray-100">
                    <!-- Organic Law Agreement -->
                    <div class="flex items-start gap-3">
                        <div class="flex items-center h-5">
                            <input id="agree_organic_law" name="agree_organic_law" type="checkbox" x-model="formData.agree_organic_law" @change="validate('agree_organic_law')" required 
                                   class="h-4 w-4 text-ugtm-purple focus:ring-ugtm-purple border rounded transition"
                                   :class="isInvalid('agree_organic_law') ? 'border-red-500 ring-red-500 text-red-600 focus:ring-red-500' : 'border-gray-300'">
                        </div>
                        <div class="text-sm">
                            <label for="agree_organic_law" class="font-medium text-gray-700">أوافق على</label>
                            <button type="button" @click="$dispatch('open-modal', 'organic-law-modal')" class="text-ugtm-purple hover:underline font-bold">القانون التنظيمي</button>
                            <label for="agree_organic_law" class="font-medium text-gray-700">للجامعة الحرة للتعليم.</label>
                            <span x-show="isInvalid('agree_organic_law')" x-text="errors.agree_organic_law" class="text-red-500 text-xs block mt-1"></span>
                        </div>
                    </div>

                    <!-- Solidarity Agreement -->
                    <div class="flex items-start gap-3">
                        <div class="flex items-center h-5">
                            <input id="agree_solidarity" name="agree_solidarity" type="checkbox" x-model="formData.agree_solidarity" @change="validate('agree_solidarity')" required 
                                   class="h-4 w-4 text-ugtm-purple focus:ring-ugtm-purple border rounded transition"
                                   :class="isInvalid('agree_solidarity') ? 'border-red-500 ring-red-500 text-red-600 focus:ring-red-500' : 'border-gray-300'">
                        </div>
                        <div class="text-sm">
                            <label for="agree_solidarity" class="font-medium text-gray-700">
                                ألتزم بروح التضامن مع النقابة والمشاركة الفعالة في أنشطتها والدفاع عن مبادئها.
                            </label>
                            <span x-show="isInvalid('agree_solidarity')" x-text="errors.agree_solidarity" class="text-red-500 text-xs block mt-1"></span>
                        </div>
                    </div>
                </div>

                <!-- Organic Law Modal -->
                <div x-data="{ show: false }" 
                     x-show="show" 
                     @open-modal.window="if ($event.detail === 'organic-law-modal') show = true" 
                     @keydown.escape.window="show = false"
                     style="display: none;"
                     class="fixed inset-0 z-50 overflow-y-auto" 
                     aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    
                    <!-- Backdrop -->
                    <div x-show="show" 
                         x-transition:enter="ease-out duration-300" 
                         x-transition:enter-start="opacity-0" 
                         x-transition:enter-end="opacity-100" 
                         x-transition:leave="ease-in duration-200" 
                         x-transition:leave-start="opacity-100" 
                         x-transition:leave-end="opacity-0" 
                         class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" 
                         @click="show = false" aria-hidden="true"></div>

                    <!-- Modal Panel -->
                    <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                        <div x-show="show" 
                             x-transition:enter="ease-out duration-300" 
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                             x-transition:leave="ease-in duration-200" 
                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                             class="relative inline-block align-bottom bg-white rounded-2xl text-right overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full border border-gray-100">
                            
                            <!-- Header -->
                            <div class="bg-navy-900 px-6 py-4 flex items-center justify-between">
                                <h3 class="text-lg font-bold text-white flex items-center gap-2" id="modal-title">
                                    <svg class="w-5 h-5 text-ugtm-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    القانون التنظيمي
                                </h3>
                                <button @click="show = false" class="text-gray-400 hover:text-white transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>

                            <!-- Content -->
                            <div class="px-6 py-6 max-h-[60vh] overflow-y-auto custom-scrollbar">
                                <div class="prose prose-sm max-w-none text-gray-600">
                                    <p class="font-bold text-navy-800 mb-4">مرحباً بك في الجامعة الحرة للتعليم.</p>
                                    <p class="mb-4">
                                        هذا نص  للقانون التنظيمي. يرجى قراءة البنود التالية بعناية قبل الموافقة:
                                    </p>
                                    <ul class="list-disc list-inside space-y-2 bg-gray-50 p-4 rounded-xl border border-gray-100">
                                        <li>يلتزم العضو باحترام قرارات الهيئات التقريرية للنقابة.</li>
                                        <li>يعتبر الانخراط التزاماً أخلاقياً ومادياً تجاه المنظمة.</li>
                                        <li>الدفاع عن المدرسة العمومية واجب وطني ومسؤولية مشتركة.</li>
                                        <li>الالتزام بمبادئ التضامن والعمل الجماعي.</li>
                                    </ul>
                                    <p class="mt-4 text-xs text-gray-400">
                                        * بالموافقة على هذا القانون، فإنك تصرح باطلاعك الكامل على جميع بنوده والتزامك بها.
                                    </p>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row-reverse gap-3 border-t border-gray-100">
                                <button type="button" @click="show = false; formData.agree_organic_law = true; validate('agree_organic_law')" class="w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-sm px-6 py-2.5 bg-ugtm-purple text-base font-bold text-white hover:bg-navy-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ugtm-purple sm:w-auto transition transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    فهمت وأوافق
                                </button>
                                <button type="button" @click="show = false" class="mt-3 w-full inline-flex justify-center items-center rounded-xl border border-gray-300 shadow-sm px-6 py-2.5 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto transition">
                                    إغلاق
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button style="margin-top:0.5rem;" type="submit" class="w-full bg-ugtm-purple text-white font-bold py-3 rounded-lg hover:bg-ugtm-purple-dark transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    إرسال طلب الانخراط
                </button>
            </form>
            
            <div class="mt-6 text-center text-sm text-gray-600">
                لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="text-ugtm-purple font-bold hover:underline">تسجيل الدخول</a>
            </div>
        </div>
    </div>
</x-layout>
