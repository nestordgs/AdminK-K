<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUserIdByClientIdToClientPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_phones', function (Blueprint $table) {
            $table->renameColumn('user_id', 'client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_phones', function (Blueprint $table) {
            $table->renameColumn('client_id', 'user_id');

        });
    }
}
