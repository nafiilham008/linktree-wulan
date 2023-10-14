<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'link_id'
    ];
    
    /**
     * Relationship with User model.
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
