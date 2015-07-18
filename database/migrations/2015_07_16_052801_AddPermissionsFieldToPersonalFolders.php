<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermissionsFieldToPersonalFolders extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('personal_folders', function(Blueprint $table)
		{
            $table->string('permission')->default('1');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('personal_folders', function(Blueprint $table)
		{
            $table->dropColumn('permission');
		});
	}

}
