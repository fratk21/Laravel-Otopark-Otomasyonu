<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEntryExitTimesToVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
        
            $table->timestamp('exit_time')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
          
            $table->dropColumn('exit_time');
        });
    }
}
