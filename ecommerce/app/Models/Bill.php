<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Bill extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    use Notifiable;


    public function getNamestatusAttribute() {
        if($this->attributes['status'] == -1) {
            return  'Đơn bị hủy!';
        }
        if($this->attributes['status'] == 0) {
            return  'Chờ xác nhận!';
        }
        if($this->attributes['status'] == 1) {
            return  'Đã xác nhận!';
        }
        if($this->attributes['status'] == 2) {
            return  'Đang vận chuyển!';
        }
        if($this->attributes['status'] == 3) {
            return  'Đã giao hàng!';
        }
        if($this->attributes['status'] == 4) {
            return  'Đã nhận hàng';
        }
    }

    public function getNameAddressAttribute() {
        $wards = \Kjmtrue\VietnamZone\Models\Ward::where('id',$this->wards)->get()->first();
        $districts = \Kjmtrue\VietnamZone\Models\District::where('id', $this->districts)->get()->first();
        $provinces = \Kjmtrue\VietnamZone\Models\Province::where('id', $this->provinces)->get()->first();
        return $this->street.', '. $wards->name.', '.$districts->name.', '.$provinces->name;
    }

    public function Detail_bill() {
        return $this->belongsTo(Detail_bill::class);
    }

    public function Product() {
        return $this->belongsTo(Product::class);
    }
}
