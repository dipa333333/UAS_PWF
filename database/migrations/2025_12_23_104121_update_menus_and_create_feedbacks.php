<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kolom harga diskon di tabel menus
        Schema::table('menus', function (Blueprint $table) {
            $table->decimal('discount_price', 10, 2)->nullable()->after('price');
        });

        // 2. Buat tabel feedbacks (Kritik Saran)
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('discount_price');
        });
        Schema::dropIfExists('feedbacks');
    }
};