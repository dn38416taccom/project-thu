<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HarleyListingController;
use Illuminate\Support\Facades\Route;

// หน้าแรก Redirect ไปรายการรถ
Route::get('/', function () {
    return redirect()->route('home');
});

// 🔓 Route ที่คนทั่วไปเข้าดูได้
Route::get('/listings', [HarleyListingController::class, 'index'])->name('home');

// 🔐 Route ที่ต้องเข้าสู่ระบบก่อน
Route::middleware(['auth'])->group(function () {
    // 📌 ย้าย /listings/create มาไว้ด้านบนสุดของกลุ่มนี้
    Route::get('/listings/create', [HarleyListingController::class, 'create'])->name('listings.create');
    Route::post('/listings', [HarleyListingController::class, 'store'])->name('listings.store');

    // โปรไฟล์ผู้ใช้
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔴 Route เฉพาะแอดมิน (ลบประกาศ)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::delete('/listings/{listing}', [HarleyListingController::class, 'destroy'])->name('listings.destroy');
});

// 📌 หน้ารายละเอียดรถรายคัน ต้องอยู่ "ล่างสุด" ของ /listings
Route::get('/listings/{listing}', [HarleyListingController::class, 'show'])->name('listings.show');

// Route สำรองสำหรับ Dashboard
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';