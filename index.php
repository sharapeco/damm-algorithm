<?php
require __DIR__ . './Damm10.php';

$originalDigits = '619817455105';
$check = Damm10::calc($originalDigits);

$digits = $originalDigits . (string)$check;
$errorDigits = [
	'619817355105', // 1桁のミス
	'618917455105', // 隣接する2桁の入れ替え
	'691817451505', // 隣接する2桁の入れ替え × 2
	'619817422105', // 隣接する2桁のミス
	'61917455105', // 1桁の抜け落ち
];


$tests = [
	$digits,
	...array_map(fn ($digits) => $digits . $check, $errorDigits)
];

foreach ($tests as $test) {
	printResult($test);
}

echo PHP_EOL;
echo '====  RANDOM DIGITS TEST  ====', PHP_EOL;

foreach (range(1, 100000) as $count) {
	$isValid = printResult(generateDigits(10));
	if (!$isValid) {
		throw new LogicException('いやああああああああああああああああああああ');
	}
}

function printResult(string $digits): bool
{
	$isValid = Damm10::verify($digits);
	printf(
		'Test case: %s => %s' . PHP_EOL,
		$digits,
		$isValid ? 'OK' : 'INVALID'
	);
	return $isValid;
}

function generateDigits(int $length): string
{
	if ($length < 2) {
		throw new InvalidArgumentException('Too short length');
	}
	$seed = '0123456789';
	$originalDigits = array_map(fn () => $seed[mt_rand(0, 9)], range(1, $length - 1));
	return Damm10::apply(implode('', $originalDigits));
}
