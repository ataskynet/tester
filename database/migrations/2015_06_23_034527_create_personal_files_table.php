<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personal_files', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->string('source')->unique();
            $table->string('rand')->unique();
            $table->integer('personal_folder_id');
            $table->integer('user_id');
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
		Schema::drop('personal_files');
	}

}
