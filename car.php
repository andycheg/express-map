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
		['left' => [5,4]],
		['left' => [9,8]],
		['left' => [13,12]],
		['left' => [17,16]],
		['left' => [21,20]],
		['left' => [25,24]],
		['table'],
		['right' => [28,29]],
		['empty', 'empty'],
		['left' => [35,34]],
		['table'],
		['right' => [39,38]],
		['right' => [43,42]],
		['right' => [47,46]],
		['right' => [51,50]],
		['right' => [55,54]],
		['right' => [59,58]],
	],
	'right' => [
		['empty', 'empty'],
		['left' => [2,3]],
		['left' => [6,7]],
		['left' => [10,11]],
		['left' => [14,15]],
		['left' => [18,19]],
		['left' => [22,23]],
		['left' => [26,27]],
		['left' => [30,31]],
		['table'],
		['right' => [33,32]],
		['right' => [37,36]],
		['right' => [41,40]],
		['right' => [45,44]],
		['right' => [49,48]],
		['right' => [53,52]],
		['right' => [57,56]],
		['right' => [61,60]],

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