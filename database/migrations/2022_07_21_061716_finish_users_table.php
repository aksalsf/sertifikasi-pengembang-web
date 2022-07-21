<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('birthinfo')->nullable();
            $table->multiLineString('address')->nullable();
            $table->string('phone')->nullable();
            $table->text('photo')->nullable();
            $table->integer('math')->nullable();
            $table->integer('indonesian')->nullable();
            $table->integer('english')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birthinfo');
            $table->dropColumn('address');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('photo');
            $table->dropColumn('math');
            $table->dropColumn('indonesian');
            $table->dropColumn('english');
        });
    }
};
