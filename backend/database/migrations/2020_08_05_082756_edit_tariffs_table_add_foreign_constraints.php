<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTariffsTableAddForeignConstraints extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('client_id')
                ->references('id')
                ->on('clients');

            $table->foreign('tariff_id')
                ->references('id')
                ->on('tariffs');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('client_id');
            $table->dropForeign('tariff_id');
        });
    }
}
