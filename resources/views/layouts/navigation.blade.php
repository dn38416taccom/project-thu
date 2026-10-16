<!-- Settings Dropdown / Authentication -->
<div class="hidden sm:flex sm:items-center sm:ms-6">
    @auth
        <!-- ถ้าเข้าสู่ระบบแล้ว ให้แสดง Dropdown ชื่อผู้ใช้ -->
        <x-dropdown align="left" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>

                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('โปรไฟล์ของฉัน') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('ออกจากระบบ') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    @else
        <!-- ถ้ายังไม่ได้เข้าสู่ระบบ ให้แสดงปุ่ม เข้าสู่ระบบ / สมัครสมาชิก -->
        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900 font-semibold px-3 py-2">
            เข้าสู่ระบบ
        </a>
        <a href="{{ route('register') }}" class="ms-2 text-sm bg-black text-white hover:bg-gray-800 font-semibold px-4 py-2 rounded-md">
            สมัครสมาชิก
        </a>
    @endauth
</div>