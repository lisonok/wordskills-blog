<?php

$connect = new PDO('mysql:host=ba5t3ohg1kijtaboujzj-mysql.services.clever-cloud.com;dbname=ba5t3ohg1kijtaboujzj', 'uuwamzqhmxdxw5v1', 'wGXZTn9n50oBlGaxZhrT');

$error = '';
$post_name = '';
$post_content = '';

if (empty($_POST["post_name"])) {
    $error .= '<p class="text-danger">Name is required</p>';
} else {
    $post_name = $_POST["post_name"];
}

if (empty($_POST["post_content"])) {
    $error .= '<p class="text-danger">Comment is required</p>';
} else {
    $post_content = $_POST["post_content"];
}

session_start();
if ($error == '' && $_SESSION["loggedin"] === true) {
    $query = "
 INSERT INTO posts 
 (parent_post_id, post, post_title) 
 VALUES (:parent_post_id, :post, :post_title)
 ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':parent_post_id' => $_POST["post_id"],
            ':post'    => $post_content,
            ':post_title' => $post_name
        )
    );
    $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
    'error'  => $error
);

echo json_encode($data);
