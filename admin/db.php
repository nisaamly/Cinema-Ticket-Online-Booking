<?php
date_default_timezone_set('Asia/Jakarta');
$servername = "localhost";
$database = "ctob";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

function insert($table,$arr) {
    global $conn;
    $field = '';
    $value = '';
    foreach($arr as $key => $val){
        $val = mysqli_real_escape_string($conn, $val);
        $field .= $key.",";
        $value .= "'$val',";
    }
    $field = substr($field,0,-1);
    $value = substr($value,0,-1);
    
    $sql = "INSERT INTO $table ($field) VALUES ($value)";
    
    mysqli_query($conn, $sql);
    
    return mysqli_insert_id($conn);
}

function update($table,$arr,$where) {
    global $conn;
    $update = '';
    foreach($arr as $key => $val){
        $val = mysqli_real_escape_string($conn, $val);
        $update .= "$key = '$val',";
    }
    $update = substr($update,0,-1);

    $sql = "UPDATE $table SET $update WHERE $where";

    echo $sql;

    return mysqli_query($conn, $sql);
}

function select($table,$value,$where){
    global $conn;
    $sql = "SELECT $value FROM $table WHERE $where";

    return mysqli_query($conn, $sql);
}

function delete($table,$where){
    global $conn;
    $sql = "DELETE FROM $table WHERE $where";

    $exec = mysqli_query($conn, $sql);
    if (!$exec) {
        $sql = "UPDATE $table SET soft_delete = 1 WHERE $where";
        $exec = mysqli_query($conn, $sql);
    }

    return $exec;
}

function generateNomor(){
    foreach(select('transaksi','max(id) as id', 'true') as $lastId){}
    $res = "TX/".date('m/Y/'). str_pad($lastId['id'], 4, '0', STR_PAD_LEFT);;
    return $res;
}