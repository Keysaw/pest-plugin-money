<?php

declare(strict_types=1);

namespace Brickx\PestPluginMoney\Contracts;

use Pest\Expectation;

interface ChecksMoney
{
	public function toBeMoney($expectation) : Expectation;

	public function toCost($expectation, $amount, $currency) : Expectation;

	public function toCostMoreThan($expectation, $amount, $currency) : Expectation;

	public function toCostLessThan($expectation, $amount, $currency) : Expectation;
}
