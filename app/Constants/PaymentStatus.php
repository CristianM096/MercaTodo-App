<?php

namespace App\Constants;

use Illuminate\Contracts\Support\Arrayable;

class PaymentStatus implements Arrayable
{
    public const PENDING = 'PENDING';
    public const APPROVED = 'APPROVED';
    public const REJECTED = 'REJECTED';

    public function toArray(): array
    {
        return[
            self::PENDING,
            self::APPROVED,
            self::REJECTED,
        ];
    }
}
