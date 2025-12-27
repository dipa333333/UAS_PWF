<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('category'); // Hapus kolom lama
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->after('name'); // Tambah relasi
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('category');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
