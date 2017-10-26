<?php

namespace Tests\Unit;

use App\Models\Trips\MoneyFormatter;
use Tests\TestCase;

class MoneyFormatterTest extends TestCase
{
    /** @test */
    public function money_formatter_returns_money_with_proper_currency_formatting()
    {
        $amount1 = 100;
        $amount2 = -100;
        $amount3 = 100.506;
        $amount4 = -102.123;

        $this->assertEquals(MoneyFormatter::format($amount1), 100.00);
        $this->assertEquals(MoneyFormatter::format($amount2), -100.00);
        $this->assertEquals(MoneyFormatter::format($amount3), 100.51);
        $this->assertEquals(MoneyFormatter::format($amount4), -102.12);
    }
}
