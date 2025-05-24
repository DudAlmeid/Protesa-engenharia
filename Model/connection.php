<?php
$con = new mysqli("localhost","root","usbw","db_protesa");
    if(mysqli_connect_errno()){
        trigger_error( mysqli_connect_error());
    }
?>