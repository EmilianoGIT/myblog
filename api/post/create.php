<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

//We need to get the data that's posted, because we receive the data from the request
//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//Create post
if ($post->create()) {
    echo json_encode(
        array(
            'message' => 'Post created'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'Post not created'
        )
    );
}
