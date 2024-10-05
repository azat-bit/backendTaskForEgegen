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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');        // IP adresini kaydedeceğimiz alan
            $table->string('method');            // HTTP metodu (GET, POST, PUT, DELETE vs.)
            $table->string('url');               // İsteğin yapıldığı URL
            $table->text('user_agent')->nullable(); // İsteğin user agent bilgisi (tarayıcı bilgisi)
            $table->timestamps();                // created_at ve updated_at zaman damgaları
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
