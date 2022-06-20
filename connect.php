<?php 
//VAO MYSQL TAO DATABASE
$conn_createdb = new mysqli('localhost','root');
$sql = "create database if not exists abc12";
$conn_createdb->query($sql);

$sql = "use abc12";
$conn_createdb->query($sql);

$sql = "create table if not exists abc12users(
    USERNAME VARCHAR(100) not null unique,
    PASSWORD_HASH char(40) not null,
    PHONE varchar(10)
)";
$conn_createdb->query($sql);
if($conn_createdb->error){
    echo $conn_createdb->error;
}

// $conn_createdb->close();

// $conn = 'create database abc12 if not exists';