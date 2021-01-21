<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursements', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->float('amount');
            $table->string('status', 30);
            $table->timestamp('timestamp');
            $table->string('bank_code', 30);
            $table->string('account_number', 50);
            $table->string('beneficiary_name');
            $table->string('remark');
            $table->string('receipt')->nullable();
            $table->timestamp('time_served')->nullable();
            $table->float('fee');
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
        Schema::dropIfExists('disbursements');
    }
}
