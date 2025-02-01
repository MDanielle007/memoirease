<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiaryEntries extends Model
{
    /** @use HasFactory<\Database\Factories\DiaryEntriesFactory> */
    use HasFactory;

	protected $fillable = [
		'diary_id',
		'entry_date',
		'entry_title',
		'content',
		'user_id'
	];

	public function diaries():BelongsTo
	{
		return $this->belongsTo(Diaries::class);
	}
}
