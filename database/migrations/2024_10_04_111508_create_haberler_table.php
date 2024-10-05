<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('Haberler', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Haber başlığı
            $table->text('content'); // Haber içeriği
            $table->string('author'); // Haber yazarı
            $table->string('category'); // Haber kategorisi
            $table->string('image')->nullable(); // Haber görseli (isteğe bağlı)
            $table->boolean('is_published')->default(false); // Yayınlanma durumu
            $table->timestamp('published_at')->nullable(); // Yayınlanma tarihi
            $table->timestamps(); // created_at ve updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('haberler');
    }
};
