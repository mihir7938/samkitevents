<?php

namespace App\Services;

use App\Models\Yatrik;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class YatrikService
{
    public function getAllYatriks($per_page = -1)
    {
        if($per_page == -1){
            return Yatrik::orderBy('created_at', 'desc')->get();    
        }
        return Yatrik::orderBy('created_at', 'desc')->paginate($per_page);
    }
    public function getYatrikById($id)
    {
        return Yatrik::find($id);
    }
    public function create($data)
    {
        return Yatrik::create($data);
    }
    public function update($yatrik, $data)
    {
        return $yatrik->update($data);
    }
    public function delete($yatrik)
    {
        return $yatrik->delete($yatrik);
    }
    public function fetchYatriksByEvent($event_id)
    {
        return Yatrik::where('event_id', $event_id)->get();
    }
    public function fetchInfoByMemberId($member_id)
    {
        return Yatrik::where('member_id', $member_id)->first();
    }
}
