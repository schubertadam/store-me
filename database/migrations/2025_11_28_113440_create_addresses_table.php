<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users');
            $table->string('type');
            $table->string('label')->nullable();
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('country_code');
            $table->string('zip');
            $table->string('city');
            $table->string('street');
            $table->boolean('is_default');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
