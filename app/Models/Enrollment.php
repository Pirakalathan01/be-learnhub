<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 *
 */
class Enrollment extends Model
{

    use HasFactory, HasUlids, SoftDeletes, LogsActivity;

    /**
     * @var string[]
     */
    protected $fillable = [
        'course_id',
        'user_id',
        'status',
    ];

    /**
     * @var string[]
     */
    protected $casts = [

    ];

    /**
     * @var array|string[]
     */
    public array $filterable = [
        'status' => '=',
        'user_id' => '=',
        'course_id' => '=',
    ];

    /**
     * @var array|\string[][]
     */
    public array $relationable = [
        'course' => ['id','course_code', 'course_name', 'course_type', 'course_fee'],
        'user' => ['id', 'first_name', 'last_name', 'email'],
    ];

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Enrollment')
            ->logOnlyDirty();
    }
}
