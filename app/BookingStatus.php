<?php

namespace App;

enum BookingStatus: string
{
    case Pending = 'pending';       // قيد الانتظار (لسه متحددش)
    case Confirmed = 'confirmed';   // مؤكد (الدفع تم أو الدكتور وافق)
    case Completed = 'completed';   // تم الكشف (الموعد انتهى بنجاح)
    case Cancelled = 'cancelled';   // ملغي (سواء من المريض أو الدكتور)

    // public function label(): string
    // {
    //     return match ($this) {
    //         self::Pending => 'قيد الانتظار',
    //         self::Confirmed => 'مؤكد',
    //         self::Completed => 'completed',
    //         self::Cancelled => 'cancelled',
    //     };
    // }
}
