<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('complex_projects', function (Blueprint $table) {
            $table->foreignUlid('project_id')->constrained()->onDelete('cascade');
            $table->decimal('budget', 15);
            $table->date('timeline');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complex_projects');
    }
};
