<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDailyEarningsTable extends Migration
{
    public function up()
    {
        Schema::create('daily_earnings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('earning', 8, 2); // Örnek olarak 8 haneli, 2 ondalıklı bir sayı saklanacak
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_earnings');
    }
}
