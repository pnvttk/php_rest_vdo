<?php
    // header
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    $database = new Database();
    $db = $database->connect();

    // instantiate user object
    $user = new User($db);
    // user query
    $result = $user->read();
    // get row count
    $num = $result->rowCount();
    // check if any user
    if($num > 0) {
        // user array
        $user_arr = array();
        // $user_arr['data'] = array(); //! don't use

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $user_item = array(
                'id' => $id,
                'username' => $username,
                'password' => $password,
                'email' => $email
            );
            // push to "data"
            // array_push($user_arr['data'], $user_item); //! don't use [data]
            array_push($user_arr['data'], $user_item);
        }

        // turn to json 
        echo json_encode($user_arr);
        
    } else {
        // no user
        echo json_encode(array('message' => 'No User Found'));
    }

?>