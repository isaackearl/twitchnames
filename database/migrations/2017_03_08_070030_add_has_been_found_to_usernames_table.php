<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHasBeenFoundToUsernamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usernames', function (Blueprint $table) {
            $table->boolean('has_been_found')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usernames', function (Blueprint $table) {
            $table->dropColumn('has_been_found');
        });
    }
}
