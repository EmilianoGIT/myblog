<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new Post($db);
    
    //Blog post query
    $result = $post->read();
    //Get row count
    $num = $result->rowCount();

    //Check if any post
    if($num > 0) {

        //Post array
        $posts_arr = array();
        //$post_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            //with extract I can get the variables from the rows
            extract($row);

            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );

            array_push($posts_arr, $post_item);
            //Push to the data
            //array_push($post_arr['data'], $post_item);
        }

        //Turn it to JSON & output
        echo json_encode($posts_arr);

    } else {
        echo json_encode(
            array('message' => 'No posts found')
        );
    }


