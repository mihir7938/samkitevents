<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yatra extends Model
{
    use HasFactory;

    protected $table = 'yatra';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'yatrik_id',
        'event_id',
        'day_id',
        'is_allowed',
        'attendance',
        'created_by',
        'updated_by',
    ];

    public function yatrik()
    {
        return $this->belongsTo(Yatrik::class, 'yatrik_id', 'id');
    }
}