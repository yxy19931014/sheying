<?php
    header("Content-Type:text/html;charset=utf-8");
    $arr=$_FILES["upload"];
    $temp_name=$arr["tmp_name"];
    $fileName=$arr["name"];
    move_uploaded_file($temp_name,"img/".$fileName);
    echo $fileName;



?>