<?php
include("connection.php");


$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method){
    case 'GET':
        $response = getAllNews();
        echo json_encode($response);

    // case 'POST':
    //     $response = createNews();
    //     echo json_encode($response);
        
}



function getAllNews(){
    global $mysqli;
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

    return $response;

}