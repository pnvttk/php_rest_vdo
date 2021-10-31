<?php
    // header
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
    

    include_once '../../config/Database.php';
    include_once '../../models/Video.php';

    $database = new Database();
    $db = $database->connect();

    // instantiate video object
    $video = new Video($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $video->title = $data->title;
    $video->url = $data->url;
    $video->description = $data->description;
    $video->img_url = $data->img_url;

    // create post
    if($video->create()) {
        echo json_encode(
            array('message' => 'Post Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Post Not Created')
        );
    }