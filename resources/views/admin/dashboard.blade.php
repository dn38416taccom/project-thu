<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ระบบจัดการผู้ดูแลระบบ (Admin Dashboard)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">รายการประกาศทั้งหมดในระบบ</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">รูปภาพ</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">หัวข้อประกาศ</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">ตระกูล / รุ่น</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">ราคา</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">ผู้ลงขาย</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600">การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($listings as $item)
                                <tr>
                                    <td class="px-4 py-3">
                                        @if($item->image_path)
                                            <img src="{{ asset('storage/' . $item->image_path) }}" class="w-16 h-12 object-cover rounded">
                                        @else
                                            <div class="w-16 h-12 bg-gray-100 flex items-center justify-center text-xs text-gray-400 rounded">ไม่มีรูป</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-gray-900">{{ $item->title }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $item->family_series }} - {{ $item->model_name }}</td>
                                    <td class="px-4 py-3 font-bold text-red-600">฿{{ number_format($item->selling_price) }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $item->seller_name }}</td>
                                    <td class="px-4 py-3 text-center space-x-2">
                                        <a href="{{ route('listings.show', $item->id) }}" target="_blank" class="text-blue-600 hover:underline">ดูหน้าเว็บ</a>
                                        
                                        <!-- ปุ่มลบประกาศ -->
                                        <form action="{{ route('listings.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบประกาศนี้? การกระทำนี้ไม่สามารถยกเลิกได้');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1.5 rounded font-semibold transition">
                                                🗑️ ลบประกาศ
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-6 text-gray-500">ไม่มีรายการประกาศในระบบ</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $listings->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>