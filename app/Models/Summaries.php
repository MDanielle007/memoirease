<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Summaries extends Model
{
	/** @use HasFactory<\Database\Factories\SummariesFactory> */
	use HasFactory;

	protected $fillable = [
		'diary_id',
		'summary'
	];

	public function diary(): BelongsTo
	{
		return $this->belongsTo(Diaries::class);
	}
}
