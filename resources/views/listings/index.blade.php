<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('รายการรถ Harley-Davidson ทั้งหมด') }}
            </h2>
            @auth
                <a href="{{ route('listings.create') }}" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-md text-sm shadow">
                    + ลงประกาศขายรถ
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <h3 class="text-2xl font-bold text-gray-800">รถที่เปิดขายอยู่</h3>
            </div>

            @if($listings->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($listings as $item)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border flex flex-col justify-between">
                            <div>
                                <!-- แสดงรูปภาพตัวรถ -->
                                @if($item->image_path)
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                                        ไม่มีรูปภาพ
                                    </div>
                                @endif

                                <div class="p-5">
                                    <span class="text-xs bg-red-100 text-red-800 font-bold px-2.5 py-0.5 rounded">
                                        {{ $item->family_series }}
                                    </span>
                                    <h4 class="text-lg font-bold text-gray-900 mt-2 line-clamp-1">{{ $item->title }}</h4>
                                    <p class="text-gray-500 text-xs mt-1">
                                        ปี {{ $item->model_year }} | {{ number_format($item->mileage_km) }} {{ $item->mileage_type }}
                                    </p>
                                    <p class="text-2xl font-black text-red-600 mt-3">
                                        ฿{{ number_format($item->selling_price) }}
                                    </p>
                                </div>
                            </div>

                            <div class="p-5 pt-0">
                                <a href="{{ route('listings.show', $item->id) }}" class="block w-full text-center bg-gray-900 hover:bg-black text-white text-sm font-semibold py-2 rounded-md transition">
                                    ดูรายละเอียด
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $listings->links() }}
                </div>
            @else
                <div class="bg-white p-12 text-center rounded-lg shadow-sm border">
                    <p class="text-gray-500">ยังไม่มีรายการประกาศขายรถในขณะนี้</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>