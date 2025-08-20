<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteReaction extends Model
{
    protected $fillable = [
        'reaction_type',
        'quote_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
