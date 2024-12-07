<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Yatra extends Model
{
    use HasFactory;
    use SoftDeletes;

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
        'deleted_by',
    ];

    public function yatrik()
    {
        return $this->belongsTo(Yatrik::class, 'yatrik_id', 'id');
    }
}