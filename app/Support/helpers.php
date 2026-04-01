<?php

if (!function_exists('format_inr')) {
    /**
     * Format a number in Indian currency style.
     */
    function format_inr($amount, int $decimals = 0, bool $withSymbol = true): string
    {
        $amount = $amount ?? 0;
        $negative = $amount < 0;
        $amount = abs((float) $amount);

        $parts = explode('.', number_format($amount, $decimals, '.', ''));
        $intPart = $parts[0] ?? '0';
        $decPart = $parts[1] ?? '';

        if (strlen($intPart) > 3) {
            $last3 = substr($intPart, -3);
            $rest = substr($intPart, 0, -3);
            $rest = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $rest);
            $intPart = $rest . ',' . $last3;
        }

        $formatted = $intPart;
        if ($decimals > 0) {
            $formatted .= '.' . $decPart;
        }

        if ($negative) {
            $formatted = '-' . $formatted;
        }

        return $withSymbol ? '₹' . $formatted : $formatted;
    }
}
