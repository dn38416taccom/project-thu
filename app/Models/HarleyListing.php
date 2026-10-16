<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HarleyListing extends Model
{
    protected $guarded = [];

    // เจ้าของประกาศ (ผู้ลงขาย)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}