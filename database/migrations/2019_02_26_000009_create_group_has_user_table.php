<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupHasUserTable extends Migration
{
    /**
     * Schema table name to migrate
     *
     * @var string
     */
    public $tableName = 'group_has_users';

    /**
     * Run the migrations.
     *
     * @table group_has_user
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index(["user_id"], 'fk_group_has_user_user1_idx');

            $table->index(["group_id"], 'fk_group_has_user_group1_idx');


            $table->foreign('group_id', 'fk_group_has_user_group1_idx')
                ->references('id')->on('groups')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('user_ID', 'fk_group_has_user_user1_idx')
                ->references('id')->on('users')
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
