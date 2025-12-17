<x-layout title="بطاقة العضوية">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #printable-card, #printable-card * {
                visibility: visible;
            }
            #printable-card {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                width: 85.6mm;
                height: 53.98mm;
                border: 1px solid #000;
                border-radius: 8px;
                overflow: hidden;
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                background-color: white !important;
            }
            
            /* Print Layout Optimization */
            #printable-card .h-32 { height: 12mm !important; } /* Smaller header */
            #printable-card .-mt-12 { margin-top: -6mm !important; }
            
            /* Logo & Name Section */
            #printable-card .w-24 { width: 10mm !important; height: 10mm !important; padding: 1px !important; margin-bottom: 1mm !important; }
            #printable-card h2 { font-size: 10pt !important; margin-bottom: 0 !important; }
            #printable-card p.text-gray-500 { font-size: 7pt !important; margin-bottom: 2mm !important; }
            
            /* Content Grid (Details + QR) */
            #printable-card .print-content-grid {
                display: grid !important;
                grid-template-columns: 1.5fr 1fr !important;
                gap: 2mm !important;
                padding: 0 4mm !important;
                align-items: center !important;
                text-align: right !important;
            }
            
            /* Details Column */
            #printable-card .space-y-3 { margin: 0 !important; }
            #printable-card .space-y-3 > div { 
                border-bottom: none !important; 
                padding-bottom: 1mm !important; 
                display: flex !important;
                justify-content: space-between !important;
            }
            #printable-card .text-sm { font-size: 7pt !important; }
            #printable-card .text-xs { font-size: 6pt !important; }
            
            /* QR Column */
            #printable-card .mt-6 { margin-top: 0 !important; padding: 0 !important; border: none !important; background: none !important; }
            #printable-card svg { width: 16mm !important; height: 16mm !important; }
            #printable-card .text-[10px] { display: none !important; } /* Hide "Scan to verify" text */

            /* Hide footer */
            #printable-card .border-t { display: none !important; }
            
            @page {
                size: auto;
                margin: 0mm;
            }
        }
    </style>

    <div class="bg-gray-50 min-h-screen py-12 flex items-center justify-center">
        <div class="container mx-auto px-4 w-full md:w-[80%] md:max-w-none">
            
            <!-- Back Button -->
            <div class="mb-6 flex justify-between items-center no-print">
                <a href="{{ route('profile.show') }}" class="flex items-center gap-2 text-gray-500 hover:text-ugtm-purple transition">
                    <svg class="w-5 h-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    العودة للملف الشخصي
                </a>
                <button onclick="window.print()" class="flex items-center gap-2 bg-ugtm-purple text-white px-4 py-2 rounded-lg hover:bg-navy-900 transition shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    طباعة البطاقة
                </button>
            </div>

            <!-- Card Container -->
            <div id="printable-card" class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 relative">
                <!-- Header Pattern -->
                <div class="h-32 bg-ugtm-purple relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10 pattern-dots"></div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <!-- Corner Logo Removed -->
                </div>

                <!-- Profile Info -->
                <div class="px-8 pb-8 text-center -mt-12 relative z-10">
                    <div class="w-24 h-24 bg-white p-2 rounded-full shadow-lg mx-auto mb-4 flex items-center justify-center border-4 border-white">
                        <img src="{{ asset('images/logo-FAE.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    
                    <h2 class="text-2xl font-bold text-navy-900 mb-1">{{ $user->name }}</h2>
                    <p class="text-gray-500 text-sm mb-6">{{ $user->job_title }}</p>

                    <div class="print-content-grid">
                        <div class="space-y-3 text-right text-sm">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-400">رقم التأجير</span>
                                <span class="font-bold text-navy-800">{{ $user->rental_number }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-400">مقر العمل</span>
                                <span class="font-bold text-navy-800">{{ $user->workplace }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-400">الجماعة</span>
                                <span class="font-bold text-navy-800">{{ $user->commune }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-2">
                                <span class="text-gray-400">الحالة</span>
                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-bold">منخرط</span>
                            </div>
                        </div>

                        <!-- QR Code -->
                        <div class="mt-6 bg-gray-50 p-3 rounded-xl border border-gray-100 flex flex-col items-center justify-center">
                            <div class="bg-white p-2 rounded-lg shadow-sm mb-1">
                                {!! QrCode::size(100)->generate(URL::signedRoute('verification.verify', ['id' => $user->id])) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 p-3 text-center border-t border-gray-100">
                    <p class="text-[10px] text-gray-400">الجامعة الوطنية  للتعليم - FAE</p>
                </div>
            </div>

        </div>
    </div>
</x-layout>
