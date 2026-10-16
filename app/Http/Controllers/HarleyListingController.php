<?php

namespace App\Http\Controllers;

use App\Models\HarleyListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HarleyListingController extends Controller
{
    // 1. หน้าแสดงรายการรถทั้งหมด
    public function index()
    {
        $listings = HarleyListing::where('status', 'active')->latest()->paginate(12);
        return view('listings.index', compact('listings'));
    }

    // 2. หน้าฟอร์มลงประกาศขาย
    public function create()
    {
        return view('listings.create');
    }

    // 3. บันทึกข้อมูลลงฐานข้อมูล พร้อมรองรับการอัปโหลดรูปภาพ
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'vin' => 'required|unique:harley_listings,vin',
            'selling_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = $request->all();

        // จัดการอัปโหลดรูปภาพ
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('bikes', 'public');
            $data['image_path'] = $path;
        }

        // ลบคีย์ 'image' ออกก่อน insert ลงฐานข้อมูล
        unset($data['image']);

        // ค่า Default สำหรับฟิลด์จำเป็นใน Migration 50 ฟิลด์
        $data['user_id'] = Auth::id();
        $data['seller_name'] = $request->input('seller_name', Auth::user()->name ?? 'ผู้ขาย');
        $data['seller_phone'] = $request->input('seller_phone', '0800000000');
        $data['seller_type'] = $request->input('seller_type', 'private');
        $data['license_plate'] = $request->input('license_plate', 'ไม่ระบุ');
        $data['registration_province'] = $request->input('registration_province', 'กรุงเทพมหานคร');
        $data['family_series'] = $request->input('family_series', 'Softail');
        $data['model_name'] = $request->input('model_name', 'Fat Boy 114');
        $data['model_year'] = $request->input('model_year', 2021);
        $data['registration_year'] = $request->input('registration_year', 2021);
        $data['color_original'] = $request->input('color_original', 'Vivid Black');
        $data['engine_type'] = $request->input('engine_type');
        $data['engine_capacity_cc'] = $request->input('engine_capacity_cc', 1868);
        $data['transmission'] = $request->input('transmission', '6-Speed');
        $data['fuel_system'] = $request->input('fuel_system', 'ESPFI');
        $data['mileage_km'] = $request->input('mileage_km', 0);
        $data['mileage_type'] = $request->input('mileage_type', 'km');
        $data['condition_rating'] = $request->input('condition_rating', '4_very_good');
        $data['selling_price'] = $request->input('selling_price', 0.00);
        $data['service_history'] = $request->input('service_history', 'full_dealer_history');
        $data['viewing_location_province'] = $request->input('viewing_location_province', 'กรุงเทพมหานคร');
        $data['viewing_location_district'] = $request->input('viewing_location_district', 'วัฒนา');
        $data['status'] = 'active';

        HarleyListing::create($data);

        return redirect()->route('home')->with('success', 'ลงประกาศขายรถ Harley-Davidson พร้อมรูปถ่ายเรียบร้อยแล้ว!');
    }

    // 4. แสดงรายละเอียดรถรายคัน
    public function show(HarleyListing $listing)
    {
        $listing->increment('views_count');
        return view('listings.show', compact('listing'));
    }

    // 5. สำหรับ Admin / เจ้าของ: ลบประกาศซื้อขาย
    public function destroy(HarleyListing $listing)
    {
        // ลบไฟล์รูปภาพออกจาก Storage หากมี
        if ($listing->image_path && Storage::disk('public')->exists($listing->image_path)) {
            Storage::disk('public')->delete($listing->image_path);
        }

        // ลบข้อมูลประกาศออกจากฐานข้อมูล
        $listing->delete();

        return redirect()->route('home')->with('success', 'ลบประกาศซื้อขายเรียบร้อยแล้ว!');
    }
}