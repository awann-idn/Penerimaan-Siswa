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
        Schema::table('applicants', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->after('id');
            $table->string('pas_foto')->nullable()->after('previous_school');
            $table->string('kartu_pelajar')->nullable()->after('pas_foto');
            $table->string('dokumen_tambahan')->nullable()->after('kartu_pelajar');
            $table->text('admin_notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'pas_foto', 'kartu_pelajar', 'dokumen_tambahan', 'admin_notes']);
        });
    }
};
