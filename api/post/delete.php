<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
//this header is going to tell me which are the other allowed headers (the previous ones)
//X-Requested-With helps us with cross site scripting attacks and has to do with cors
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

//Set ID to update
$post->id = $data->id;

//Delete post
if ($post->delete()) {
    echo json_encode(
        array(
            'message' => 'Post deleted'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'Post not deleted'
        )
    );
}
