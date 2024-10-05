<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'logs';

    // Kaydedilebilir alanlar
    protected $fillable = [
        'ip_address', 
        'method', 
        'url', 
        'user_agent',
    ];
}
