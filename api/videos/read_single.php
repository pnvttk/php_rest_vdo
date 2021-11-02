<?php
    // header
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once '../../config/Database.php';
    include_once '../../models/Video.php';

    $database = new Database();
    $db = $database->connect();

    // instantiate video object
    $video = new Video($db);
    // get id
    $video->id = isset($_GET['id']) ? $_GET['id'] : die();
    // get video
    $video->read_single();

    // video array
    $video_arr = array(
        'id' => $video->id,
        'title' => $video->title,
        'url' => $video->url,
        'description' => $video->description,
        'img_url' => $video->img_url
    );

    // make json
    print_r(json_encode($video_arr));
        

    //echo json_encode($img_url,  JSON_UNESCAPED_SLASHES); 
?>

