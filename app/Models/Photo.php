<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'src', 
    ];
    protected $appends = ['complete_url'];
    public function getCompleteUrlAttribute() {
        return asset('images/' . $this->src);
    }
}
