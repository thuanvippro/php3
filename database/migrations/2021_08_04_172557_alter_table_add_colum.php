<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAddColum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image');
            $table->integer('price')->default(0);
            $table->integer('sale_price')->nullable();
            $table->integer('quantity')->default(0);
            $table->float('weight')->default(0);
            $table->integer('starts')->nullable();
            $table->integer('views')->nullable();
            $table->integer('likes')->nullable();
            $table->text('short_description')->nullable();
            $table->text('detailed_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('price');
            $table->dropColumn('sale_price');
            $table->dropColumn('quantity');
            $table->dropColumn('weight');
            $table->dropColumn('starts');
            $table->dropColumn('views');
            $table->dropColumn('likes');
            $table->dropColumn('short_description');
            $table->dropColumn('detailed_description');
        });
    }
}
