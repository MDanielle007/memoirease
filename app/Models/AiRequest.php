<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiRequest extends Model
{
    /** @use HasFactory<\Database\Factories\AiRequestFactory> */
    use HasFactory;

	protected $fillable = [
		'user_id',
        'diary_id',
		'request_type',
		'input_data',
		'response_data',
		'input_tokens',
		'output_tokens',
		'cost',
		'status'
	];

	public function user():BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function diaries():BelongsTo
	{
		return $this->belongsTo(Diaries::class);
	}
}
