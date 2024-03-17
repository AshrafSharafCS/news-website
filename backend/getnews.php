<?php
include("connection.php");



    $query = $mysqli->prepare("SELECT * FROM news");
    $query->execute();
    $query->store_result();
    $num_rows = $query->num_rows();

    if($num_rows == 0) {
        $response["status"] = "No News";
    }else{
        $news = [];
        $query->bind_result($id, $author, $title, $content);
        while($query->fetch()){
            $article = [
                'id' => $id,
                'author' => $author,
                'title' => $title,
                'content' => $content,
            ];

            $news[] = $article;
        }

        $response["status"] = "Success";
        $response["news"] = $news;
    }

    echo json_encode($response);



