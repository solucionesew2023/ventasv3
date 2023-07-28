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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained()->onDelete('cascade');
            $table->date('purchase_date');
            $table->string('invoice_number');
            $table->string('state');
            $table->json('invoice_payments')->nullable();
            $table->double('reteica')->nullable();
            $table->double('reteiva')->nullable();
            $table->double('retefuente')->nullable();
            $table->double('freight')->nullable();
            $table->double('discount')->nullable();
            $table->double('total_iva');
            $table->double('balance');
            $table->double('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
