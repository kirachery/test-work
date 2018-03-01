<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'workers';

$connect = mysqli_connect($host,$user,$password,$dbname);
if (!$connect) {
    echo "Ошибка содинения с базой (" .mysqli_connect_errno() . ') : '.mysqli_connect_error();

    exit;
}
