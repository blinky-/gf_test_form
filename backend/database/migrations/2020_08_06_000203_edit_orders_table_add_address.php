<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditOrdersTableAddAddress extends Migration
{

    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->json('delivery_address')->after('delivery_since');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('delivery_address');
        });
    }
}
