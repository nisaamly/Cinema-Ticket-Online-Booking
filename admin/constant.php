<?php

// extra 
$dataKelas = [
    [
        'id' => 1,
        'nama' => 'Standar'
    ], [
        'id' => 2,
        'nama' => 'Premium'
    ], [
        'id' => 3,
        'nama' => 'Max Movie'
    ],
];

$dataMethodBayar = [
    [
        'id' => 1,
        'nama' => 'Cash'
    ], [
        'id' => 2,
        'nama' => 'Debit'
    ],
];

function getKelasById($id)
{
    global $dataKelas;
    $key = array_search($id, array_column($dataKelas, 'id'));
    return $dataKelas[$key]['nama'];
}

function getMethodBayarById($id)
{
    global $dataMethodBayar;
    $key = array_search($id, array_column($dataMethodBayar, 'id'));
    return $dataMethodBayar[$key]['nama'];
}
