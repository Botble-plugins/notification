<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('bp_notifications')) {
            Schema::create('bp_notifications', function (Blueprint $table) {
                $table->id();
                $table->morphs('notifiable');
                $table->string('title');
                $table->text('body');
                $table->string('url')->nullable();
                $table->boolean('read')->default(0);
                $table->boolean('notified')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('bp_notifications');
    }
};
