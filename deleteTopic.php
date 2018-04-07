<?php
include('config.php');

$topicId = $_GET['id'];

//delete posts relating to topic
$deleteQuery = "DELETE FROM posts WHERE post_topic ='".mysqli_real_escape_string($link,$topicId)."'";
mysqli_query($link, $deleteQuery);

//Delete topic
$deleteQuery = "DELETE FROM topics WHERE topic_id ='".mysqli_real_escape_string($link,$topicId)."'";
mysqli_query($link, $deleteQuery);

header("Location:index");
exit();

?>