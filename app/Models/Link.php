<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    /**
     * Fillable fields.
     *
     * @return void
     */
    protected $fillable = [
        'user_id',
        'title',
        'url',
        'description',
        'image',
    ];
    
    /**
     * Relationship with Click model.
     *
     * @return void
     */
    public function click() {
        return $this->hasMany(Click::class, 'link_id', 'id');
    }

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
