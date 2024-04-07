<?php

namespace App\Models;

use App\Enums\CourseType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 *
 */
class Course extends Model
{
    use HasFactory, HasUlids, SoftDeletes, LogsActivity;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'course_code',
        'course_name',
        'description',
        'course_type',
        'course_fee'
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
        'name' => 'like',
        'course_code' => 'like',
        'course_type' => '=',
    ];

    /**
     * @var array|\string[][]
     */
    public array $relationable = [
        'enrollments' => ['id', 'course_id', 'status'],
    ];

    /**
     * @return HasMany
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class,'course_id','id');
    }


    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Course')
            ->logOnlyDirty();
    }
}
