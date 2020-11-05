<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
	public function up() {
		Schema::create('address', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('cart_id');
			$table->string('name');
			$table->integer('postal_code');
			$table->string('region');
			$table->string('city');
			$table->text('street');
			$table->string('phone_number');
			$table->softDeletes();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::dropIfExists('address');
		$table->dropColumn('deleted_at');
	}
}
