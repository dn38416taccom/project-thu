<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ลงประกาศขายรถ Harley-Davidson') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">รูปภาพตัวรถจริง * (รองรับ JPG, PNG, WEBP ขนาดไม่เกิน 5MB)</label>
                        <input type="file" name="image" accept="image/*" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-black file:text-white hover:file:bg-gray-800">
                    </div>
                    <!-- Section 1: ข้อมูลผู้ขาย -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">1. ข้อมูลผู้ขาย / การติดต่อ</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ชื่อผู้ติดต่อ *</label>
                                <input type="text" name="seller_name" value="{{ old('seller_name', Auth::user()->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">เบอร์โทรศัพท์ *</label>
                                <input type="text" name="seller_phone" value="{{ old('seller_phone') }}" required placeholder="*** *** ****" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Line ID</label>
                                <input type="text" name="seller_line_id" value="{{ old('seller_line_id') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ประเภทผู้ขาย *</label>
                                <select name="seller_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="private">เจ้าของขายเอง (Private)</option>
                                    <option value="dealer">เต็นท์ / ดีลเลอร์ (Dealer)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: ข้อมูลตัวรถ -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">2. ข้อมูลตัวรถ และราคาขาย</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">หัวข้อลงประกาศ *</label>
                                <input type="text" name="title" value="{{ old('title') }}" required placeholder="เช่น Harley-Davidson Fat Boy 114 ปี 2021 สภาพสวยมาก" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ตระกูลรถ (Family Series) *</label>
                                <select name="family_series" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">-- เลือกตระกูลรถ --</option>
                                    <option value="Softail">Softail</option>
                                    <option value="Touring">Touring</option>
                                    <option value="Sportster">Sportster</option>

                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ชื่อรุ่น (Model Name) *</label>
                                <input type="text" name="model_name" value="{{ old('model_name') }}" required placeholder="เช่น Fat Boy 114, Iron 883" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ปี ค.ศ. ผลิต *</label>
                                <input type="number" name="model_year" value="{{ old('model_year') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ปีที่จดทะเบียน *</label>
                                <input type="number" name="registration_year" value="{{ old('registration_year') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">เลขตัวถัง (VIN) *</label>
                                <input type="text" name="vin" value="{{ old('vin') }}" required maxlength="17" placeholder="17 หลัก" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ทะเบียนรถ *</label>
                                <input type="text" name="license_plate" value="{{ old('license_plate') }}" required placeholder="เช่น 1กข 9999" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">จังหวัดที่จดทะเบียน *</label>
                                <input type="text" name="registration_province" value="{{ old('registration_province') }}" required placeholder="เช่น กรุงเทพมหานคร" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ราคาขาย (บาท) *</label>
                                <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price') }}" required placeholder="850000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-red-600 font-bold">
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: สเปกเครื่องยนต์ & สภาพ -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">3. สเปกเครื่องยนต์ และระยะทาง</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">เครื่องยนต์ (engine_type) *</label>
                                <select name="engine_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">-- เลือกเครื่องยนต์ --</option>
                                    <option value="Shovel Head">Shovel Head</option>
                                    <option value="Sportster Evolution">Sportster Evolution</option>
                                    <option value="Evolution">Evolution</option>
                                    <option value="TwinCam">TwinCam</option>
                                    <option value="Milwaukee-Eight">Milwaukee-Eight</option>
                                    <option value="Revolution">Revolution</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ขนาดเครื่องยนต์ (CC) *</label>
                                <input type="number" name="engine_capacity_cc" value="{{ old('engine_capacity_cc', 1868) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">ระบบเกียร์ *</label>
                                <select name="transmission" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">-- เลือกระบบเกียร์ --</option>
                                    <option value="6-Speed">6-Speed</option>
                                    <option value="5-Speed">5-Speed</option>
                                    <option value="5-Speed">4-Speed</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">เลขไมล์ *</label>
                                <input type="number" name="mileage_km" value="{{ old('mileage_km') }}" required placeholder="12000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">สีเดิม *</label>
                                <input type="text" name="color_original" value="{{ old('color_original') }}" required placeholder="Vivid Black" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">จังหวัดที่นัดดูรถ *</label>
                                <input type="text" name="viewing_location_province" value="{{ old('viewing_location_province') }}" required placeholder="กรุงเทพมหานคร" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">อำเภอ/เขต นัดดูรถ *</label>
                                <input type="text" name="viewing_location_district" value="{{ old('viewing_location_district') }}" required placeholder="วัฒนา" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('home') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-md">ยกเลิก</a>
                        <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-6 rounded-md shadow">บันทึกและลงประกาศ</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
