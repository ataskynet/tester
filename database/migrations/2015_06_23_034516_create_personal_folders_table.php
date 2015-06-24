<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalFoldersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personal_folders', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->integer('user_id')->nullable();
            $table->integer('sub_directory')->nullable();
            $table->integer('personal_folder_id')->nullable();
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
		Schema::drop('personal_folders');
	}

}
