<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name'); // Untuk kolom "Name"
            $table->date('date');           // Untuk sortir "Date"
            $table->integer('total_items');  // Untuk kolom "Total Order"
            $table->string('status');        // Awaiting approval, In Production, dll
            $table->string('location');      // Untuk kolom "Event Location"
            $table->string('payment_status');// Untuk kolom "Payment Status"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};