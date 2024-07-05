<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'old_name',
        'owner_id',
        'advisor_id',
        'status',
    ];

    public function sender() 
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function receiver() 
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'file_tag');
    }
}
