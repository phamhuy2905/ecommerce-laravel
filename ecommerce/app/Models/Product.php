<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $dates = ['expired_at'];
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory() {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function vendor() {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function getNamestatusAttribute() {
        if($this->attributes['status'] == 1) {
            return 'Fulfill';
        }
        else if($this->attributes['status'] == 0) {
            return 'Pending';
        }
    }
}
