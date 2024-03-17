<?php
include("connection.php");


$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method){
    case 'GET':
        $response = getAllNews();
        echo json_encode($response);

    case 'POST':
        if(!empty($_POST["author"] && $_POST["title"] && $_POST["content"] )){
            $author= $_POST["author"];
            $title= $_POST["title"];
            $content= $_POST["content"];

            $response = createNews($author,$title,$content);
            echo json_encode($response);  
        }
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


function createNews($author,$title,$content){
    global $mysqli;
    $response;
    $query = $mysqli->prepare("INSERT INTO news (author,title,content) VALUES (?,?,?)");
    $query->bind_param("sss", $author,$title,$content);
    if($query->execute()){
        $response["status"] = "Added Successfully";
    }else{
        $response["status"] = "Failed";
    }

    return $response;


}