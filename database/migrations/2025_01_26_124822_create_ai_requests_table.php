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
		Schema::create('ai_requests', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained()->onDelete('cascade'); // Tracks who made the request
			$table->foreignId('diary_id')->nullable()->constrained()->onDelete('cascade'); // Links request to a diary
			$table->string('request_type'); // e.g., 'summary', 'narration'
			$table->text('input_data'); // Data sent to the AI
			$table->text('response_data')->nullable(); // AI's response
			$table->integer('input_tokens')->nullable(); // Tokens for input
			$table->integer('output_tokens')->nullable(); // Tokens for output
			$table->decimal('cost', 8, 2)->nullable(); // Cost of the API request in PHP or USD
			$table->string('status')->default('pending'); // Status: 'pending', 'completed', 'failed'
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('ai_requests');
	}
};
