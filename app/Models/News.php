<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'Haberler';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'title',          // Haber başlığı
        'content',        // Haber içeriği
        'author',         // Haber yazarı
        'category',       // Haber kategorisi
        'image',          // Haber ile ilgili görselin URL'si
        'is_published',   // Yayınlanma durumu
        'published_at',   // Yayınlanma tarihi
    ];

}
