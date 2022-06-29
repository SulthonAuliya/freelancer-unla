<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName(){
        return 'id';
    }

    protected $with = ['job', 'user'];
    
    public function scopeLamarprov($query, $provider_id){
        return $query->whereHas('job.user', function($query) use($provider_id){
            $query->where('id', $provider_id);
        });
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job(){
        return $this->belongsTo(Job::class, 'id_job');
    }

}
