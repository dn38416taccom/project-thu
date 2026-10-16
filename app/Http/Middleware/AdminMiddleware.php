<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // ตรวจสอบว่าล็อกอินแล้ว และเป็น Admin (is_admin == true) หรือไม่
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // ถ้าไม่ใช่แอดมิน ให้ดีดกลับไปหน้าหลักพร้อมแจ้งเตือน
        return redirect()->route('home')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงส่วนนี้สำหรับผู้ดูแลระบบ');
    }
}