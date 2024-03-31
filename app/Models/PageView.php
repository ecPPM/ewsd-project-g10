<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = ['user_id', 'page_url', 'browser'];

    public static function logPageView($userId, $pageName, $browser)
    {
        self::create([
            'user_id' => $userId,
            'page_url' => $pageName,
            'browser' => $browser,
        ]);
    }
}
