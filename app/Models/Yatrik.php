<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yatrik extends Model
{
    use HasFactory;

    protected $table = 'yatriks';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'member_id',
        'event_id',
        'custom_yatrik_id',
        'name',
        'gender',
        'age',
        'aadhar_number',
        'address',
        'city',
        'state',
        'country',
        'religious_method',
        'father_husband_name',
        'reference',
        'mobile_number',
        'emergency_number',
        'email',
        'illness',
        '_99_yatra',
        '_12_gaon_chari_palit_sangh_yatra',
        'present_penance',
        'profile_photo',
        'qr_code',
        'created_by',
        'updated_by',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}