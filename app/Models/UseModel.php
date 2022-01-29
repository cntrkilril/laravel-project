<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Thing;
use App\Models\Place;

class UseModel extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo('User', 'id', 'user_id');
    }

    public function place() {
        return $this->belongsTo('Place', 'id', 'place_id');
    }

    public function thing() {
        return $this->belongsTo('Thing', 'id', 'thing_id');
    }
}
