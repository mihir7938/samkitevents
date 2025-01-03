<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'events';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'total_days',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function event_all_days()
    {
        return $this->hasMany(Day::class, 'event_id', 'id');
    }

    public function event_all_yatriks()
    {
        return $this->hasMany(Yatrik::class, 'event_id', 'id');
    }

    public function event_all_yatras()
    {
        return $this->hasMany(Yatra::class, 'event_id', 'id');
    }
}
