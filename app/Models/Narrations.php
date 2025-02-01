<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Narrations extends Model
{
    /** @use HasFactory<\Database\Factories\NarrationsFactory> */
    use HasFactory;

	protected $fillable = [
        'diary_id',
		'narration'
	];

	public function diaries():BelongsTo
	{
		return $this->belongsTo(Diaries::class);
	}
}
