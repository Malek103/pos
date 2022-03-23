<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'user_id', 'phone', 'place', 'description', 'gender', 'type', 'account'
    ];

    public function hreceipts()
    {
        return  $this->hasMany(hReceipt::class);
    }
    public function catchs()
    {
        return $this->hasMany(Debenture::class);
    }
}
