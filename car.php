<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 31/01/15
 * Time: 16:35
 */

$data = [
	'left' => [
		['left' => 1, 'empty'],
		['left' => [4,5]],
		['left' => [8,9]],
		['left' => [12,13]],
		['left' => [16,17]],
		['left' => [20,21]],
		['left' => [24,25]],
		['table'],
		['right' => [28,29]],
		['empty', 'empty'],
		['left' => [34,35]],
		['table'],
		['right' => [38,39]],
		['right' => [42,43]],
		['right' => [46,47]],
		['right' => [50,51]],
		['right' => [54,55]],
		['right' => [58,59]],
	],
	'right' => [
//		['empty', 'empty'],
		['left' => [2,3]],
		['left' => [6,7]],
		['left' => [10,11]],
		['left' => [14,15]],
		['left' => [18,19]],
		['left' => [22,23]],
		['left' => [26,27]],
		['left' => [30,31]],
		['table'],
		['right' => [32,33]],
		['right' => [36,37]],
		['right' => [40,41]],
		['right' => [44,45]],
		['right' => [48,49]],
		['right' => [52,53]],
		['right' => [56,57]],
		['right' => [60,61]],

	]
];

function iterFirst($array)
{
	foreach($array as $v)
		return $v;
	return null;
}

function renderTable ()
{
	return '<td class="table" rowspan=2>&nbsp;</td>';
}
function renderLeftSeat($number)
{
	return '<td class="seat back-left">'.$number.'</td>';
}
function renderRightSeat($number)
{
	return '<td class="seat back-right">'.$number.'</td>';
}

function renderHall()
{
	return '<tr class="hall"><td></td></tr>';
}

function renderEmptySeat ()
{
	return '<td class="seat empty"></td>';
}

function renderRow($rowData)
{
	$tr1 = [];
	$tr2 = [];

	foreach ($rowData as $coupe)
	{
		if (count($coupe) == 1)
		{
			if (iterFirst($coupe) == 'table')
				$tr1[] = renderTable();
			if (array_key_exists('left', $coupe))
			{
				$tr1[] = renderLeftSeat($coupe['left'][1]);
				$tr2[] = renderLeftSeat($coupe['left'][0]);
			}
			if (array_key_exists('right', $coupe))
			{
				$tr1[] = renderRightSeat($coupe['right'][1]);
				$tr2[] = renderRightSeat($coupe['right'][0]);
			}
		}
		if (count($coupe) == 2)
		{
			$line = [];
			foreach ($coupe as $k => $v) {
				if ($v == 'empty') {
					$line[] = renderEmptySeat();
				} else {
					if ($k == 'left')
						$line[] = renderLeftSeat($v);
				if ($k == 'right')
					$line[] = renderRightSeat($v);
			}
			}
			$tr1[] = $line[1];
			$tr2[] = $line[0];
		}
	}
	return [$tr1, $tr2];
}
function renderCar ()
{
	global $data;
	echo '<table class="car"><tbody>';

	list($tr1, $tr2) = renderRow($data['right']);
	list($tr3, $tr4) = renderRow($data['left']);

	echo "<tr>".implode('', $tr1).'</tr>';
	echo "<tr>".implode('', $tr2).'</tr>';
	echo renderHall();
	echo "<tr>".implode('', $tr3).'</tr>';
	echo "<tr>".implode('', $tr4).'</tr>';

	echo '</tbody></table>';
}