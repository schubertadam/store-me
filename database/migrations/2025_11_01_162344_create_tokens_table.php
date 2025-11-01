<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->string('token')->primary();
            $table->string('email');
            $table->string('reason');
            $table->timestamp('created_at')->nullable();

            $table->unique(['email', 'reason']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tokens');
    }
};
