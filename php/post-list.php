<div class="center post-list">
	<?php
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 1) {

		$topicId = $_GET['id'];
		$topicQuery = "SELECT * FROM topics WHERE topic_id = '".mysqli_real_escape_string($link,$topicId)."'";
		$checkResult = mysqli_query($link, $topicQuery);
		$rows = mysqli_fetch_assoc($checkResult);
		$topicTitle = $rows['topic_title'];

		$topicUser = $rows['topic_user'];
		$userQuery = "SELECT * FROM users WHERE user_id = '".mysqli_real_escape_string($link,$topicUser)."'";
		$userCheckResult = mysqli_query($link, $userQuery);
		$userRows = mysqli_fetch_assoc($userCheckResult);
		$topicUser = $userRows['user_name'];
		$date = $rows['topic_date'];
	?>
	
	<li>
		<h4><?php echo $topicTitle;?></h4>
		<div>
			<h4>By <span><?php echo $topicUser;?></span> - <?php echo date('j F Y - h:i a',strtotime($date)); ?></h4>
		</div>
		<p><?php echo $rows['topic_content'];?></p>
		<input type="checkbox" id="editTopic">
		<div class="topic-edit-box">
			<form method="POST">
				
				<label><h4>Edit subject</h4></label>

				<input name="editTopicTitle" id="editTopicTitle" value="<?php echo $topicTitle;?>">

				<input type="hidden" name="editTopicDetails" id="editTopicDetails" value="editTopicDetails">
				<input type="hidden" name="topicId" id="topicId" value="<?php echo $topicId;?>">

				<label><h4>Edit message</h4></label>
				<textarea name="editTopicContent" id="editTopicContent"><?php echo $rows['topic_content'];?></textarea>
				<input type="submit" name="submit" value="Submit">
				<label for="editTopic"><h4>Cancel</h4></label>
			</form>
		</div>
		<input type="checkbox" id="deleteTopic">
		<div class="centre delete-topic-box">
			<span><h4>Are you sure you want to delete this topic and all relating posts?</h4></span>
			<a href="deleteTopic?id=<?php echo $topicId;?>"><h4>Yes</h4></a>
			<label for="deleteTopic"><h4>Cancel</h4></label>
		</div>
		<div class="post-buttons">
			<label for="editTopic"><h4>Edit</h4></label>
			<label for="deleteTopic"><h4>Delete</h4></label>
		</div>
	</li>
	<?php
	

	$postQuery = "SELECT * FROM posts WHERE post_topic = '".mysqli_real_escape_string($link,$topicId)."' ORDER BY post_date ASC";
	$checkResult = mysqli_query($link, $postQuery);
	while ($rows = mysqli_fetch_assoc($checkResult)):
	$date = $rows['post_date'];

	$postUser = $rows['post_user'];
	$userQuery = "SELECT * FROM users WHERE user_id = '".mysqli_real_escape_string($link,$postUser)."'";
	$userCheckResult = mysqli_query($link, $userQuery);
	$userRows = mysqli_fetch_assoc($userCheckResult);
	$postUser = $userRows['user_name'];
	$postId = $rows['post_id'];
	?>
	<a name="post-<?php echo $postId;?>"></a>
	<li>
		<h4>Re: <?php echo $topicTitle;?></h4>
		<div>
			<h4>By <span><?php echo $postUser;?></span> - <?php echo date('j F Y - h:i a',strtotime($date)); ?></h4>
		</div>
		<input type="checkbox" class="edit" id="reply-<?php echo $postId;?>">
			<p><?php echo $rows['post_content'];?></p>
		<div class="centre edit-box">
			<label><h4>Edit reply</h4></label>
			<form method="POST">

				<input type="hidden" name="editPost" id="editPost" value="editPost">
				<input type="hidden" name="postId" id="postId" value="<?php echo $postId;?>">
				
				<textarea name="editPostContent" id="editPostContent" ><?php echo $rows['post_content'];?></textarea>
				<input type="submit" name="submit" value="Submit">
				<label for="reply-<?php echo $postId;?>"><h4>Cancel</h4></label>
			</form>
		</div>
		<input type="checkbox" class="delete" id="delete-<?php echo $postId;?>">
		<div class="centre delete-box">
			<span><h4>Are you sure you want to delete this post?</h4></span>
			<a href="deletePost?id=<?php echo $postId;?>"><h4>Yes</h4></a>
			<label for="delete-<?php echo $postId;?>"><h4>Cancel</h4></label>
		</div>
		<div class="post-buttons">
			<label for="reply-<?php echo $postId;?>"><h4>Edit</h4></label>
			<label for="delete-<?php echo $postId;?>"><h4>Delete</h4></label>
		</div>
	</li>
	<?php
		endwhile;
	} else {

		$topicId = $_GET['id'];
		$topicQuery = "SELECT * FROM topics WHERE topic_id = '".mysqli_real_escape_string($link,$topicId)."'";
		$checkResult = mysqli_query($link, $topicQuery);
		$rows = mysqli_fetch_assoc($checkResult);
		$topicTitle = $rows['topic_title'];

		$topicUser = $rows['topic_user'];
		$userQuery = "SELECT * FROM users WHERE user_id = '".mysqli_real_escape_string($link,$topicUser)."'";
		$userCheckResult = mysqli_query($link, $userQuery);
		$userRows = mysqli_fetch_assoc($userCheckResult);
		$topicUser = $userRows['user_name'];
		$date = $rows['topic_date'];
	?>
	
	<li>
		<h4><?php echo $topicTitle;?></h4>
		<div>
			<h4>By <span><?php echo $topicUser;?></span> - <?php echo date('j F Y - h:i a',strtotime($date)); ?></h4>
		</div>
		<p><?php echo $rows['topic_content'];?></p>
	</li>
	<?php
	$postQuery = "SELECT * FROM posts WHERE post_topic = '".mysqli_real_escape_string($link,$topicId)."' ORDER BY post_date ASC";
	$checkResult = mysqli_query($link, $postQuery);
	while ($rows = mysqli_fetch_assoc($checkResult)):
	$date = $rows['post_date'];

	$postUser = $rows['post_user'];
	$userQuery = "SELECT * FROM users WHERE user_id = '".mysqli_real_escape_string($link,$postUser)."'";
	$userCheckResult = mysqli_query($link, $userQuery);
	$userRows = mysqli_fetch_assoc($userCheckResult);
	$postUser = $userRows['user_name'];
	$postId = $rows['post_id'];
	?>
	<a name="post-<?php echo $postId;?>"></a>
	<li>
		<h4>Re: <?php echo $topicTitle;?></h4>
		<div>
			<h4>By <span><?php echo $postUser;?></span> - <?php echo date('j F Y - h:i a',strtotime($date)); ?></h4>
		</div>
		<p><?php echo $rows['post_content'];?></p>
	</li>
	<?php
		endwhile;
	}

	?>
	<?php
		if (!isset($_SESSION['user'])) {
		?>
		<li>
			<h4 class="center-text">To participate, please <a href="#top"><span onclick="login()">login</span></a> or <a href="#top"><span onclick="register()">register</span></a></h4>
		</li>
		<?php
		} else {
		?>

		<li class="reply-box">
			<label for="postContent"><h4>Add new reply</h4></label>
			<form method="POST" class="form replyForm">
				<input type="hidden" name="reply" id="reply" value="reply">
				<textarea name="postContent" id="postContent" class="input <?php echo $postContentClass; ?>"></textarea>
				<input type="checkbox" name="emailReply" id="emailReply" value="yes" <?php echo $emailReply; ?>>
				<label for="emailReply"><h4>Email me a copy of my reply</h4></label>
				<input type="submit" name="submit" value="Submit">
				<div class="error-box"><h4 class="error" id="replyError"><?php echo $postContentError; ?></h4></div>
			</form>

		</li>

	<?php
	}
	?>
</div>
	











