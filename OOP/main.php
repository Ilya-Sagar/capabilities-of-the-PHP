<?php

require_once 'Facades/Facade.php'; // содержит методы для обращения к обычным методам как к статичным + чейнинг методов
require_once 'Models/Model.php'; // содержит методы для создание простого sql запроса с условиями
require_once 'Models/User.php';
require_once 'Models/Worker.php';


$Ivan = new Worker('Ivan', 25, 1000);
$Vasya = new Worker('Vasya', 26, 2000);


$add = [
    'name' => 1,
    '>age' => 12,
    'sity' => [
        'value' => '123',
        'operator' => '<='
    ],
    '>index' => [
        'value' => 2
    ]
];

$destoryArray = [
    'sity'
];
$destoryString = 'index';

echo Worker::add($add)->destroy($destoryString)->destroy($destoryArray)->getSql();
