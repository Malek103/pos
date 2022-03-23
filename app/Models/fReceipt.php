<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fReceipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'product_id', 'header_id', 'cost', 'quantity', 'price', 'profit',
    ];
    protected $with = ['product'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function header()
    {
        return $this->belongsTo(hReceipt::class, 'header_id', 'id');
    }
}
