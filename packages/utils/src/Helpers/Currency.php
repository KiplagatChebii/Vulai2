<?php
namespace Pos\Utils\Helpers;
/**
 * Currency — Safe money handling. Always use cents (integer), never float.
 */
class Currency
{
    public static function toCents(float $amount): int { return (int) round($amount * 100); }
    public static function toDecimal(int $cents): float { return $cents / 100; }
    public static function format(int $cents, string $currency = 'KES'): string { return $currency . ' ' . number_format(self::toDecimal($cents), 2); }
    public static function add(int $a, int $b): int { return $a + $b; }
    public static function subtract(int $a, int $b): int { return $a - $b; }
    public static function percentage(int $cents, float $percent): int { return (int) round($cents * ($percent / 100)); }
}
