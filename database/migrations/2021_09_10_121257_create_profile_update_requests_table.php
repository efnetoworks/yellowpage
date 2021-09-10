<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUpdateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_update_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('logistic_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->boolean('cac')->default(0)->nullable();
            $table->string('cac_document')->nullable();
            $table->string('email')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('slug')->nullable();
            $table->string('phone')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('local_government_id')->nullable();
            $table->string('bvn')->nullable();
            $table->string('identification_type')->nullable();
            $table->string('identification_id')->nullable();
            $table->string('type_of_bike')->nullable();
            $table->string('plate_number')->nullable();
            $table->longText('reason')->nullable();
            $table->integer('has_requested_to_update_profile')->nullable();
            $table->boolean('approval_status')->default(0)->nullable();
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
        Schema::dropIfExists('profile_update_requests');
    }
}
