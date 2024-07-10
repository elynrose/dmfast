<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'packages';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const NOTIFY_ME_RADIO = [
        'Email' => 'Email',
        'Text'  => 'Text Message',
        'Both'  => 'Both',
    ];

    protected $fillable = [
        'name',
        'intervals_id',
        'credits',
        'notify_me',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function intervals()
    {
        return $this->belongsTo(Interval::class, 'intervals_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
