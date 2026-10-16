<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $listing->title }}
            </h2>
            <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-black font-semibold">
                ← กลับหน้าหลัก
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- ฝั่งซ้าย: รูปภาพและรายละเอียดตัวรถ -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- 🖼️ ส่วนแสดงรูปภาพตัวรถจริงขนาดใหญ่ -->
                    <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                        @if($listing->image_path)
                            <img src="{{ asset('storage/' . $listing->image_path) }}" alt="{{ $listing->title }}" class="w-full h-[450px] object-cover">
                        @else
                            <div class="w-full h-80 bg-gray-100 flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>ไม่มีรูปภาพตัวรถ</span>
                            </div>
                        @endif
                    </div>

                    <!-- การ์ดหัวข้อและราคา -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="bg-red-100 text-red-800 text-xs font-bold px-2.5 py-1 rounded">
                                    {{ $listing->family_series }}
                                </span>
                                <h1 class="text-3xl font-extrabold text-gray-900 mt-2">{{ $listing->title }}</h1>
                                <p class="text-gray-500 text-sm mt-1">
                                    ลงประกาศเมื่อ: {{ $listing->created_at->format('d/m/Y H:i') }} | ยอดเข้าชม: {{ number_format($listing->views_count) }} ครั้ง
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="text-3xl font-black text-red-600">฿{{ number_format($listing->selling_price) }}</span>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $listing->is_negotiable ? 'ราคาต่อรองได้' : 'เน็ท/สุทธิ' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ข้อมูลตัวรถและสเปก -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <h3 class="text-lg font-bold border-b pb-3 mb-4">ข้อมูลตัวรถและสเปกเครื่องยนต์</h3>
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-6 text-sm">
                            <div>
                                <p class="text-gray-500">ยี่ห้อ / ตระกูล</p>
                                <p class="font-bold text-gray-800">Harley-Davidson ({{ $listing->family_series }})</p>
                            </div>
                            <div>
                                <p class="text-gray-500">รุ่น (Model)</p>
                                <p class="font-bold text-gray-800">{{ $listing->model_name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">ปี ผลิต / จดทะเบียน</p>
                                <p class="font-bold text-gray-800">ปี {{ $listing->model_year }} (จด {{ $listing->registration_year }})</p>
                            </div>
                            <div>
                                <p class="text-gray-500">ขนาดเครื่องยนต์</p>
                                <p class="font-bold text-gray-800">{{ number_format($listing->engine_capacity_cc) }} CC</p>
                            </div>
                            <div>
                                <p class="text-gray-500">ประเภทเครื่องยนต์</p>
                                <p class="font-bold text-gray-800">{{ $listing->engine_type }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">ระบบเกียร์</p>
                                <p class="font-bold text-gray-800">{{ $listing->transmission }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">เลขไมล์ปัจจุบัน</p>
                                <p class="font-bold text-gray-800">{{ number_format($listing->mileage_km) }} {{ $listing->mileage_type }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">สีตัวรถ</p>
                                <p class="font-bold text-gray-800">{{ $listing->color_original }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">ทะเบียนรถ</p>
                                <p class="font-bold text-gray-800">{{ $listing->license_plate }} ({{ $listing->registration_province }})</p>
                            </div>
                            <div>
                                <p class="text-gray-500">เลขตัวถัง (VIN)</p>
                                <p class="font-bold text-gray-800 font-mono text-xs">{{ $listing->vin }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- รายละเอียดของแต่งเพิ่มเติม -->
                    @if($listing->custom_accessories_detail)
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <h3 class="text-lg font-bold border-b pb-3 mb-3">รายละเอียดของแต่งและอุปกรณ์เพิ่มเติม</h3>
                        <p class="text-gray-700 whitespace-pre-line">{{ $listing->custom_accessories_detail }}</p>
                    </div>
                    @endif

                </div>

                <!-- ฝั่งขวา: ข้อมูลการติดต่อผู้ขาย -->
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <h3 class="text-lg font-bold border-b pb-3 mb-4">ข้อมูลติดต่อผู้ขาย</h3>
                        
                        <!-- แสดงปุ่มลบเฉพาะเมื่อผู้ใช้ล็อกอินและเป็น Admin เท่านั้น -->
                        @if(auth()->check() && auth()->user()->is_admin)
                            <div class="mt-4 pt-4 border-t">
                                <form action="{{ route('listings.destroy', $listing->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบประกาศนี้หรือไม่?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md text-sm transition">
                                        🗑️ ลบประกาศซื้อขายนี้ (Admin Only)
                                    </button>
                                </form>
                            </div>
                        @endif
                                <p class="text-xs text-gray-500">ชื่อผู้ลงขาย</p>
                                <p class="font-bold text-gray-800 text-lg">{{ $listing->seller_name }}</p>
                                <span class="inline-block text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded mt-1">
                                    {{ $listing->seller_type == 'private' ? 'เจ้าของขายเอง' : 'เต็นท์ / ดีลเลอร์' }}
                                </span>
                            </div>

                            <div class="pt-2 border-t">
                                <p class="text-xs text-gray-500">เบอร์โทรศัพท์ติดต่อ</p>
                                <a href="tel:{{ $listing->seller_phone }}" class="text-xl font-bold text-blue-600 hover:underline block mt-1">
                                    📞 {{ $listing->seller_phone }}
                                </a>
                            </div>

                            @if($listing->seller_line_id)
                            <div class="pt-2">
                                <p class="text-xs text-gray-500">Line ID</p>
                                <p class="font-bold text-green-600">💬 {{ $listing->seller_line_id }}</p>
                            </div>
                            @endif

                            <div class="pt-2 border-t">
                                <p class="text-xs text-gray-500">สถานที่นัดดูรถ</p>
                                <p class="font-semibold text-gray-800 mt-1">
                                    📍 อ.{{ $listing->viewing_location_district }} จ.{{ $listing->viewing_location_province }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
