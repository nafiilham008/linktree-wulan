<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id'
    ];
    
    /**
     * Relationship with Link model.
     *
     * @return void
     */
    public function link()
    {
        return $this->belongsTo(Link::class, 'link_id', 'id');
    }
}
