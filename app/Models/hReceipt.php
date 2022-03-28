<?php

namespace App\Models;

use App\Models\fReceipt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class hReceipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'client_id', 'total', 'discount', 'type', 'status', 'user_id', 'profit'
    ];
    protected $with = ['fReceipts'];

    public function client()
    {
        return  $this->belongsTo(Client::class);
    }

    public function fReceipts()
    {
        return $this->hasMany(fReceipt::class, 'header_id', 'id');
    }
}
