<?php
    // header
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
    

    include_once '../../config/Database.php';
    include_once '../../models/Video.php';

    $database = new Database();
    $db = $database->connect();

    // instantiate video object
    $video = new Video($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set id to delete
    $video->id = $data->id;

    // delete post
    if($video->delete()) {
        echo json_encode(
            array('message' => 'Post Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Post Not Deleted')
        );
    }