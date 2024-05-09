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
            $table->string('first_name')->after('name');
            $table->string('last_name')->after('first_name');
            $table->date('DOB')->after('last_name');
            $table->string('mobile')->after('DOB');
            $table->text('address')->after('mobile');
            $table->string('state')->after('address');
            $table->string('city')->after('state');
            $table->string('pincode')->after('city');
            $table->string('username')->after('pincode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
