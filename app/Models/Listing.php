<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    // protected $fillable = ['title','company','location','website','email','tags','description'];
    protected $fillable = [
        'user_id',
        'title',
        'logo',
        'company',
        'location',
        'website',
        'email',
        'tags',
        'description'
    ];
    public function scopeFilter($query,array $filters){
        if($filters['tag']??false){
            $query->where('tags', 'like','%'. request('tag') . '%');
        }
        if($filters['search']??false){
            $query->where('title', 'like','%'. request('search') . '%')
            ->orWhere('description', 'like','%'. request('search') . '%')
            ->orWhere('tags', 'like','%'. request('search') . '%');
        }
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
