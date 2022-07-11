<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Schema table name to migrate
     *
     * @var string
     */
    public $tableName = 'payments';

    /**
     * Run the migrations.
     *
     * @table payment
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('payment_request_id');
            $table->string('description');
            $table->double('amount');
            $table->unsignedInteger('currencies_id');
            $table->string('iban', 40);
            $table->timestamps();
            $table->softDeletes();

            $table->index(["user_id"], 'fk_payment_user1_idx');

            $table->index(["payment_request_id"], 'fk_payment_payment_request1_idx');

            $table->index(["currencies_id"], 'fk_payment_currencies1_idx');


            $table->foreign('user_id', 'fk_payment_user1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('payment_request_id', 'fk_payment_payment_request1_idx')
                ->references('id')->on('payment_requests')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('currencies_id', 'fk_payment_currencies1_idx')
                ->references('id')->on('currencies')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
