<?php
    // header
    header("Access-Control-Request-Headers: X-Requested-With, accept, content-type");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    //Part added by ilyas :
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
//End of part.

    include_once '../../config/Database.php';
    include_once '../../models/Video.php';

    $database = new Database();
    $db = $database->connect();

    // instantiate video object
    $video = new Video($db);
    // video query
    $result = $video->read();
    // get row count
    $num = $result->rowCount();
    // check if any video
    if($num > 0) {
        // video array
        $video_arr = array();
        // $video_arr['data'] = array(); //! not work with [object : data]

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $video_item = array(
                'id' => $id,
                'title' => $title,
                'url' => $url,
                'description' => $description,
                // 'img' => $img
                'img_url' => $img_url
            );
            // push to "data" 
            // array_push($video_arr['data'], $video_item); //! not work with [object:data]
            array_push($video_arr, $video_item);
        }

        // turn to json 
        echo json_encode($video_arr);
        
    } else {
        // no video
        echo json_encode(array('message' => 'No User Found'));
    }
    //echo json_encode($img_url,  JSON_UNESCAPED_SLASHES); 
?>

