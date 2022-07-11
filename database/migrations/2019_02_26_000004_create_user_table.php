<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Schema table name to migrate
     *
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     *
     * @table user
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->unsignedInteger('role_id')->default('1');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index(["role_id"], 'fk_user_has_role_idx');

            $table->foreign('role_id', 'fk_user_has_role_idx')
                ->references('id')->on('roles')
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
