<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('export_histories', function (Blueprint $table) {
			$table->id();
			$table->foreignId('diary_id')->constrained()->onDelete('cascade');
			$table->string('export_type'); // e.g., 'pdf', 'csv'
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('export_histories');
	}
};
