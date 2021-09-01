<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFirstNameToLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logistics', function (Blueprint $table) {
            $table->string('first_name')->after('name')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
            $table->string('address')->after('company_name')->nullable();
            $table->boolean('cac')->default(0)->after('address')->nullable();
            $table->string('cac_document')->after('cac')->nullable();
            $table->boolean('paid')->after('is_verified')->nullable();
            $table->string('paid_amount')->after('paid')->nullable();
            $table->string('type_of_bike')->after('identification_id')->nullable();
            $table->string('plate_number')->after('type_of_bike')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logistics', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('address');
            $table->dropColumn('cac');
            $table->dropColumn('cac_document');
            $table->dropColumn('paid');
            $table->dropColumn('paid_amount');
            $table->dropColumn('type_of_bike');
            $table->dropColumn('plate_number');
        });
    }
}
