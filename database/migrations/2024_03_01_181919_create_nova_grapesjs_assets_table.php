<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up(): void
        {
            Schema::create('nova_grapesjs_assets', function (Blueprint $table) {
                $table->id();
                $table->string('disk');
                $table->string('path');
                $table->decimal('height');
                $table->decimal('width');
                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('nova_grapesjs_assets');
        }
    };
