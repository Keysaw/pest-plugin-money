<?php

declare(strict_types=1);

namespace Brickx\PestPluginMoney\Libraries;

use Brick\Math\Exception\NumberFormatException;
use Brick\Math\Exception\RoundingNecessaryException;
use Brick\Money\Exception\UnknownCurrencyException;
use Brick\Money\Money;
use Brickx\PestPluginMoney\Contracts\ChecksMoney;
use Pest\Expectation;

final class Brick implements ChecksMoney
{
	public function toBeMoney($expectation) : Expectation
	{
		return $expectation->toBeInstanceOf(Money::class);
	}

	/**
	 * @throws UnknownCurrencyException
	 * @throws RoundingNecessaryException
	 * @throws NumberFormatException
	 */
	public function toCost($expectation, $amount, $currency) : Expectation
	{
		return $expectation->toEqual($this->parseMoney($amount, $currency));
	}

	/**
	 * @throws UnknownCurrencyException
	 * @throws NumberFormatException
	 * @throws RoundingNecessaryException
	 */
	public function toCostMoreThan($expectation, $amount, $currency) : Expectation
	{
		expect($expectation->value->isGreaterThan($this->parseMoney($amount, $currency)))->toBeTrue();

		return $expectation;
	}

	/**
	 * @throws UnknownCurrencyException
	 * @throws RoundingNecessaryException
	 * @throws NumberFormatException
	 */
	public function toCostLessThan($expectation, $amount, $currency) : Expectation
	{
		expect($expectation->value->isLessThan($this->parseMoney($amount, $currency)))->toBeTrue();

		return $expectation;
	}

	/**
	 * @throws UnknownCurrencyException
	 * @throws NumberFormatException
	 * @throws RoundingNecessaryException
	 */
	private function parseMoney($amount, $currency) : Money
	{
		if ($amount instanceof Money) {
			return $amount;
		}

		return Money::of($amount, $currency);
	}
}
