<?php

$connect = mysqli_connect("localhost", "sklep online", "databaze", "sklep online" );

if(mysqli_connect_errno()){
   exit('conntection failed' . mysqli_connect_error());
}