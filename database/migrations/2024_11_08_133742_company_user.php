<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('company_user', function (Blueprint $table) {
            $table->foreignUlid('user_id')->constrained()->onDelete('cascade');
            $table->foreignUlid('company_id')->constrained()->onDelete('cascade');
            $table->primary(['user_id', 'company_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_user');
    }
};
