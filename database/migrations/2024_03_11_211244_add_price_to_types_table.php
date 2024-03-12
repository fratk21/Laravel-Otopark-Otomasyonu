<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('types', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->default(0.00)->after('name');
        });
    }
    
    public function down()
    {
        Schema::table('types', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
}
