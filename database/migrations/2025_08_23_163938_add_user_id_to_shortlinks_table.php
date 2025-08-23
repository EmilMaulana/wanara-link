<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('shortlinks', function (Blueprint $table) {
            // Menambahkan kolom user_id sebagai foreign key
            $table->foreignId('user_id')
                  ->after('id') // Opsional: menempatkan kolom setelah kolom id
                  ->constrained('users') // Menghubungkan ke tabel 'users'
                  ->onDelete('cascade'); // Jika user dihapus, shortlink miliknya juga akan terhapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shortlinks', function (Blueprint $table) {
            // Menghapus foreign key constraint terlebih dahulu
            $table->dropForeign(['user_id']);
            // Menghapus kolom user_id
            $table->dropColumn('user_id');
        });
    }
};
