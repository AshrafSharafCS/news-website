<?php
include("connection.php");

$author=$_POST['author'];
$title=$_POST['title'];
$content=$_POST['content'];
    
 
$query = $mysqli->prepare("INSERT INTO news (author,title,content) VALUES (?,?,?)");
$query->bind_param("sss", $author,$title,$content);

if($query->execute()){
        $response["status"] = "Added Successfully";
    }else{
        $response["status"] = "Failed";
    }
echo $author;
echo json_encode($response);