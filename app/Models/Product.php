<?php

namespace App\Models;

use App\Models\Receipt;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'user_id', 'price', 'cost', 'quantity', 'barcode', 'status', 'image', 'favare', 'sold', 'profits'
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/defult.png');
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return Storage::url($this->image);
    }
    public function freceipts()
    {
        return $this->hasMany(fReceipt::class);
    }
}
