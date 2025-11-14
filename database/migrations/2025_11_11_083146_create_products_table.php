<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained('categories');
            $table->integer('stock');
            $table->string('sku')->unique();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('summary')->nullable();
            $table->string('description')->nullable();
            $table->decimal('price');
            $table->string('sale_type')->nullable();
            $table->decimal('sale_amount')->nullable();
            $table->dateTime('sale_active_from')->nullable();
            $table->dateTime('sale_active_to')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
