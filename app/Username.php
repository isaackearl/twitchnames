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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Username whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Username whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Username whereIsAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Username whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Username whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Username whereUsername($value)
 * @mixin \Eloquent
 */
class Username extends Model
{

    use SoftDeletes;

    //
    protected $fillable = [
        'user_id',
        'username'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
