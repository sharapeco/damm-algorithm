<?php

/**
 * Damm アルゴリズム
 */
final class Damm10
{
	private static $matrix = [
		[0 , 3 , 1 , 7 , 5 , 9 , 8 , 6 , 4 , 2],
		[7 , 0 , 9 , 2 , 1 , 5 , 4 , 8 , 6 , 3],
		[4 , 2 , 0 , 6 , 8 , 7 , 1 , 3 , 5 , 9],
		[1 , 7 , 5 , 0 , 9 , 8 , 3 , 4 , 2 , 6],
		[6 , 1 , 2 , 3 , 0 , 4 , 5 , 9 , 7 , 8],
		[3 , 6 , 7 , 4 , 2 , 0 , 9 , 5 , 8 , 1],
		[5 , 8 , 6 , 9 , 7 , 2 , 0 , 1 , 3 , 4],
		[8 , 9 , 4 , 5 , 3 , 6 , 2 , 0 , 1 , 7],
		[9 , 4 , 3 , 8 , 6 , 1 , 7 , 2 , 0 , 5],
		[2 , 5 , 8 , 1 , 4 , 3 , 6 , 7 , 9 , 0],
	];

	/**
	 * Damm アルゴリズムに基づき、数字列の仮変数値を計算する
	 *
	 * @param string $digits 数字列
	 * @return int 仮変数値
	 */
	public static function calc(string $digits): int
	{
		/** @var int $i 仮変数 */
		$i = 0;
		foreach (str_split($digits) as $digit) {
			$d = ord($digit) - 48;
			if ($d < 0 || $d > 9) {
				throw new \InvalidArgumentException('Invalid digit');
			}
			$i = self::$matrix[$i][$d];
		}
		return $i;
	}

	/**
	 * チェックディジットなしの数字列にチェックディジットを追加する
	 *
	 * @param string $digits 数字列
	 * @return string チェックディジットを追加した数字列
	 */
	public static function apply(string $digits): string
	{
		return $digits . self::calc($digits);
	}

	/**
	 * 数字列に正しいチェックディジットがついているかどうか検証する
	 *
	 * @param string $digits 数字列
	 * @return bool
	 */
	public static function verify(string $digits): bool
	{
		return self::calc($digits) === 0;
	}
}
