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
        Schema::create('forms', function (Blueprint $table) {
            $table->id(); // form_id
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('request_date'); //วันที่กรอกแบบฟอร์ม
            $table->text('request_details'); //
            $table->enum('status', [1, 2]); // สถานะฟอร์ม
            $table->string('guest_salutation')->nullable(); //คำนำหน้า
            $table->string('guest_name')->nullable(); //ชื่อ
            $table->integer('guest_age')->nullable(); //อายุ
            $table->string('guest_occupation')->nullable(); //อาชีพ
            $table->string('guest_phone')->nullable(); //เบอร์มือถือ
            $table->string('guest_house_number')->nullable(); //บ้านเลขที่
            $table->string('guest_village')->nullable(); //หมู่ที่
            $table->string('guest_subdistrict')->nullable(); //ตำบล
            $table->string('guest_district')->nullable(); //อำเภอ
            $table->string('guest_province')->nullable();//จังหวัด
            $table->date('start_date'); //วันที่เริ่ม
            $table->date('end_date'); //วันที่สิ้นสุด
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
