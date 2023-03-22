<?php

declare(strict_types=1);

namespace Brickx\PestPluginMoney\Factories;

use Brickx\PestPluginMoney\Contracts\ChecksMoney;
use Brickx\PestPluginMoney\Libraries\Archtech;
use Brickx\PestPluginMoney\Libraries\Brick;
use Brickx\PestPluginMoney\Libraries\Money;
use InvalidArgumentException;

/**
 * @internal
 */
final class MoneyFactory
{
	private static array $map = [
		\Brick\Money\Money::class => Brick::class,
		\Money\Money::class => Money::class,
		\ArchTech\Money\Money::class => Archtech::class,
	];

	public static function make() : ChecksMoney
	{
		if (array_key_exists('pestMoneyLibrary', $GLOBALS)) {
			return new MoneyFactory::$map[$GLOBALS['pestMoneyLibrary']]();
		}

		if (class_exists(\Brick\Money\Money::class)) {
			return new Brick();
		}

		if (class_exists(\Money\Money::class)) {
			return new Money();
		}

		if (class_exists(\ArchTech\Money\Money::class)) {
			return new Archtech();
		}

		throw new InvalidArgumentException('You don’t have a supported Money library installed!');
	}
}
