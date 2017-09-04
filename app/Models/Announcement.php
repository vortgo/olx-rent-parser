<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * \App\Models\Announcement
 *
 * @property int $id
 * @property string $url
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Announcement whereUrl($value)
 * @mixin \Eloquent
 */
class Announcement extends Model
{
    protected $fillable = ['url', 'title'];
}
