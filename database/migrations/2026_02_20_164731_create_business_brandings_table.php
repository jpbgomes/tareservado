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
        Schema::create('business_brandings', function (Blueprint $table) {
            $table->foreignId('business_id')
                ->primary()
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('template_key');
            $table->string('primary_color', 7);
            $table->string('secondary_color', 7)->nullable();
            $table->integer('font_key');
            $table->foreignId('logo_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_brandings');
    }
};
