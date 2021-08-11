<?php

function generateMatrix($n) {
    $matrix = [];
    for ($row=0; $row<$n; $row++) {
        $matrix[] = $row;
        $matrix[$row] = [];
        for ($column=0; $column<$n; $column++) {
            $matrix[$row][$column] = rand(1,9);
        }
    }
    return $matrix;
}

function displayMatrix($matrix) {
    foreach ($matrix as $key => $value) {
        foreach ($matrix[$key] as $value) {
            echo $value . ' ';
        }
        echo "\n";
    }
}

/**
 * find max above baseline and min below baseline
 *
 * @param $matrix
 * @return array[]
 */
function findMaxMin($matrix) {
    $dimension = count($matrix);

    $maxAboveBaseline = [
        'row' => '0',
        'column' => '1',
        'value' => 0
    ];
    $minBelowBaseline = [
        'row' => '1',
        'column' => '0',
        'value' => 10
    ];

    for ($row=0; $row<$dimension;$row++) {
        for ($column=0; $column<$dimension;$column++) {
            if ($row === $column) { // value of baseline
                continue;
            } elseif ($row > $column) { // below baseline (min)
                if ($minBelowBaseline['value'] > $matrix[$row][$column]) {
                    $minBelowBaseline['row'] = $row;
                    $minBelowBaseline['column'] = $column;
                    $minBelowBaseline['value'] = $matrix[$row][$column];
                }
            } elseif ($row < $column) { // above baseline (max)
                if ($maxAboveBaseline['value'] < $matrix[$row][$column]) {
                    $maxAboveBaseline['row'] = $row;
                    $maxAboveBaseline['column'] = $column;
                    $maxAboveBaseline['value'] = $matrix[$row][$column];
                }
            }
        }
    }

    return [
        $maxAboveBaseline,
        $minBelowBaseline
    ];
}

function replaceInMatrix($values, $matrix) {

    $max = $values[0];
    $min = $values[1];
    $matrix[$max['row']][$max['column']] = $min['value'];
    $matrix[$min['row']][$min['column']] = $max['value'];

    return $matrix;
}

/**
 * Write matrix to file matrix.txt
 */
function writeToFile($matrix) {
    foreach ($matrix as $key => $value) {
        foreach ($matrix[$key] as $value) {
            file_put_contents('matrix.txt', $value, FILE_APPEND);
        }
        file_put_contents('matrix.txt', "\n", FILE_APPEND);
    }
}


$matrix = generateMatrix(4);
$maxMin = findMaxMin($matrix);
$newMatrix = replaceInMatrix($maxMin, $matrix);
writeToFile($matrix);


