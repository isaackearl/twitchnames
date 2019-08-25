<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Username
 *
 * @property int $id
 * @property string $username
 * @property int $user_id
 * @property bool $is_available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property bool $has_been_found
 * @property \Illuminate\Support\Carbon|null $found_date
 * @property int $found_count
 * @property-read mixed $human_readable_found_date
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Username onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username whereFoundCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username whereFoundDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username whereHasBeenFound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Username whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Username withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Username withoutTrashed()
 * @mixin \Eloquent
 */
class Username extends Model
{

    use SoftDeletes;

    protected $dates = ['found_date'];
    protected $appends = ['human_readable_found_date'];

    protected $fillable = [
        'user_id',
        'username'
    ];

    protected $casts = [
        'has_been_found' => 'boolean',
        'is_available' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getHumanReadableFoundDateAttribute()
    {
        if ($this->found_date)
            return $this->found_date->diffForHumans();

        return null;
    }
}
