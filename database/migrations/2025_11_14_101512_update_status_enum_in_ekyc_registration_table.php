<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah enum dengan raw SQL (karena Laravel tidak bisa ubah enum langsung via BluePrint)
        DB::statement("ALTER TABLE ekyc_registrations MODIFY COLUMN status ENUM('draft', 'submitted', 'accepted', 'rejected') DEFAULT 'draft'");
    }

    public function down(): void
    {
        // Roolbacl ke enum semula
        DB::statement("ALTER TABLE ekyc_registrations MODIFY COLUMN status ENUM('draft', 'submitted') DEFAULT 'draft'");
    }
};