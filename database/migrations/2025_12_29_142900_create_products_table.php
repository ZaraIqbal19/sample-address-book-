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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // id
            $table->unsignedBigInteger('sub_category_id'); // foreign key to subcategories
            $table->string('name'); // product name
            $table->string('image')->nullable(); // image path
            $table->text('description')->nullable(); // description
            $table->decimal('price', 10, 2); // original price
            $table->decimal('discounted_price', 10, 2)->default(0); // discounted price
            $table->date('sale_start')->nullable(); // sale start date
            $table->date('sale_end')->nullable(); // sale end date
            $table->unsignedInteger('sale_percentage')->default(0); // sale percentage
            $table->decimal('sale_amount', 10, 2)->nullable(); // sale amount after discount
            $table->string('sku')->nullable(); // SKU
            $table->timestamps(); // created_at and updated_at

            // Optional: foreign key constraint
            // $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
