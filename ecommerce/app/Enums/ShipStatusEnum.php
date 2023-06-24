<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ShipStatusEnum extends Enum
{
    const HUY_DON_HANG = -1;
    const CHO_XAC_NHAN = 0;
    const DA_XAC_NHAN = 1;
    const DANG_VAN_CHUYEN = 2;
    const DA_GIAO_HANG = 3;
    const DA_NHAN_HANG = 4;


    public static function getArrayStatusEnum() {
        return [
            'Hủy đơn hàng' => self::HUY_DON_HANG,
            'Chờ xác nhân' => self::CHO_XAC_NHAN,
            'Đã xác nhận' => self::DA_XAC_NHAN,
            'Đang vận chuyển' => self::DANG_VAN_CHUYEN,
            'Đã giao hàng' => self::DA_GIAO_HANG,
            'Đã nhận hàng' => self::DA_NHAN_HANG,
        ];
    }


   
}
