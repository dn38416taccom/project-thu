<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('harley_listings', function (Blueprint $table) {
            $table->string('image_path', 255)->nullable()->after('title')->comment('รูปภาพตัวรถ');
        });
    }

    public function down(): void
    {
        Schema::table('harley_listings', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};