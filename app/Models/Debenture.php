<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debenture extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'client_id', 'amount', 'type', 'status', 'user_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
