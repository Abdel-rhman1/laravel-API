<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuperadminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // 'firstname', 'midname', 'lastname', 'email', 'address', 'password',
        Schema::create('superadmins', function (Blueprint $table) {
            $table->id();
            $table->string("firstname" , 100);
            $table->string("midname"  , 100);
            $table->string("lastname" , 100);
            $table->string("email" , 100);
            $table->string("address" , 100);
            $table->string("password" , 100);
            $table->rememberToken();
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('superadmins');
    }
}
