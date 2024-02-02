<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Chatter
 *
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property string $sent_at
 * @property string $class_name
 * @property int|null $class_record_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Chatter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chatter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chatter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chatter whereClassName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chatter whereClassRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chatter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chatter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chatter whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chatter whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chatter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chatter whereUserId($value)
 * @mixin \Eloquent
 */
class Chatter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'sent_at',
        'class_name',
        'class_record_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
