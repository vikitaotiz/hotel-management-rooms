<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1516728224BookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('bookings')) {
            Schema::create('bookings', function (Blueprint $table) {
                $table->increments('id');
                $table->datetime('time_from')->nullable();
                $table->datetime('time_to')->nullable();
                $table->datetime('org_time_to')->nullable();
                $table->text('additional_information')->nullable();

                $table->string('account_type');
                $table->string('payment_mode');

                $table->double('add_amount')->nullable();
                $table->string('add_payment_mode')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
