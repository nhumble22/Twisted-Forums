<?php
include('config.php');

$postId = $_GET['id'];

//get topic return
$topicQuery = "SELECT post_topic FROM posts WHERE post_id='".mysqli_real_escape_string($link,$postId)."'";
$result = mysqli_query($link, $topicQuery);
$rows = mysqli_fetch_assoc($result);
$topicId = $rows['post_topic'];


//Delete post
$deleteQuery = "DELETE FROM posts WHERE post_id='".mysqli_real_escape_string($link,$postId)."'";
mysqli_query($link, $deleteQuery);


//update topic last update date

//get last post date
$postQuery = "SELECT * FROM posts WHERE post_topic='".mysqli_real_escape_string($link,$topicId)."' ORDER BY post_id DESC LIMIT 1";
$result = mysqli_query($link, $postQuery);
$rows = mysqli_fetch_assoc($result);
$testDate = $rows['post_date'];

if ($testDate) {
	//there are posts
	$topicUpdateDate = $testDate;
} else {
	//there are no posts
 	$topicQuery = "SELECT * FROM topics WHERE topic_id='".mysqli_real_escape_string($link,$topicId)."'";
 	$result = mysqli_query($link, $topicQuery);
 	$rows = mysqli_fetch_assoc($result);
 	$topicUpdateDate = $rows['topic_date'];
}

//get topic return
$topicQuery = "UPDATE topics SET topic_last_update='".mysqli_real_escape_string($link,$topicUpdateDate)."' WHERE topic_id='".mysqli_real_escape_string($link,$topicId)."'";
mysqli_query($link, $topicQuery);


header("Location:topic?id=$topicId");
exit();


?>