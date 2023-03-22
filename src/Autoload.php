<?php

declare(strict_types=1);

namespace Brickx\PestPluginMoney;

use Brickx\PestPluginMoney\Factories\MoneyFactory;
use Pest\Expectation;
use Pest\Plugin;

Plugin::uses(BrickxMoney::class);

$GLOBALS['pestCurrency'] = 'USD';

function useCurrency(string $currency) : void
{
	$GLOBALS['pestCurrency'] = $currency;
}

function useMoneyLibrary(string $moneyClass) : void
{
	$GLOBALS['pestMoneyLibrary'] = $moneyClass;
}

expect()->extend('toBeMoney', function () : Expectation {
	return MoneyFactory::make()->toBeMoney($this);
});

expect()->extend('toCost', function ($amount, $currency = null) : Expectation {
	return MoneyFactory::make()->toCost($this, $amount, $currency ?? $GLOBALS['pestCurrency']);
});

expect()->extend('toCostMoreThan', function ($amount, $currency = null) : Expectation {
	return MoneyFactory::make()->toCostMoreThan($this, $amount, $currency ?? $GLOBALS['pestCurrency']);
});

expect()->extend('toCostLessThan', function ($amount, $currency = null) : Expectation {
	return MoneyFactory::make()->toCostLessThan($this, $amount, $currency ?? $GLOBALS['pestCurrency']);
});
