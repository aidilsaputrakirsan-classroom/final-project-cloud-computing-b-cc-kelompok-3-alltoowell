<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('name', 100);
            $table->integer('price');
            $table->text('description')->nullable();
            $table->jsonb('facilities')->default('[]');
            $table->integer('capacity')->default(1);
            $table->text('image')->nullable();
            $table->string('status', 20)->default('available')
                  ->check("status IN ('available', 'occupied')");
            $table->text('location')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        // Index untuk pencarian
        DB::statement('CREATE INDEX idx_rooms_status ON rooms(status)');
        DB::statement('CREATE INDEX idx_rooms_price ON rooms(price)');
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};