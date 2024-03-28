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
        Schema::create('guest', function (Blueprint $table) {
            $table->id();
            $table->string('ID_identity')->unique();
            $table->string('name');
            $table->string('address');
            $table->enum('region', ['TEGAL','SLAWI','BREBES', 'PEMALANG', 'JATENG', 'LUAR_JATENG']);
            $table->date('birth_date');
            $table->enum('work', ['WIRASWASTA','PNS','TNI_POLRI', 'GURU', 'PELAJAR', 'FREELANCER', 'BURUH', 'PETANI', 'NELAYAN', 'PEDAGANG', 'PENGUSAHA', 'TIDAK_BEKERJA']);
            $table->enum('education', ['TS','SD','SMP','SMA', 'PT']);
            $table->enum('gender', ['L','P','N'])->default('N');
            $table->enum('type_guest', ['WEB','WORK_IN_GUEST','OWNER', 'TRAVEL', 'COORPORATE_FAMILY', 'ENTERTAINMENT']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest');
    }
};
