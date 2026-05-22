<?php
namespace Pos\Config;
class PosConstants
{
    const SALE_STATUS_PENDING   = 'pending';
    const SALE_STATUS_COMPLETED = 'completed';
    const SALE_STATUS_VOIDED    = 'voided';
    const SALE_STATUS_REFUNDED  = 'refunded';
    const PAYMENT_CASH   = 'cash';
    const PAYMENT_CARD   = 'card';
    const PAYMENT_MPESA  = 'mpesa';
    const PAYMENT_BANK   = 'bank_transfer';
    const PAYMENT_PENDING  = 'pending';
    const PAYMENT_SUCCESS  = 'success';
    const PAYMENT_FAILED   = 'failed';
    const PAYMENT_REFUNDED = 'refunded';
    const LOW_STOCK_THRESHOLD = 10;
    const DEFAULT_PER_PAGE    = 20;
    const MAX_PER_PAGE        = 100;
    public static function saleStatuses(): array { return [self::SALE_STATUS_PENDING, self::SALE_STATUS_COMPLETED, self::SALE_STATUS_VOIDED, self::SALE_STATUS_REFUNDED]; }
    public static function paymentMethods(): array { return [self::PAYMENT_CASH, self::PAYMENT_CARD, self::PAYMENT_MPESA, self::PAYMENT_BANK]; }
}
