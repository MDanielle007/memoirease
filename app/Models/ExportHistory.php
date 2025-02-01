<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExportHistory extends Model
{
    /** @use HasFactory<\Database\Factories\ExportHistoryFactory> */
    use HasFactory;

	protected $fillable = [
        'diary_id',
		'export_type'
	];

	public function diaries():BelongsTo
	{
		return $this->belongsTo(Diaries::class);
	}
}
