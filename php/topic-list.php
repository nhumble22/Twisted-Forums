<div class="center topic-list">
	<li>
			<h4>Topic</h4>
			<h4>Last Updated</h4>
			<h4>Replies</h4>
	</li>
	<?php
		

		function dateDifference($then) {
			$now =  new DateTime();
			$difference = date_diff($then, $now)->format("%y");
			if ($difference != 0) {
				echo $difference." years ago";
			} else {
				$difference = date_diff($then, $now)->format("%m");
				if ($difference != 0) {
					echo $difference." months ago";
				} else {
					$difference = date_diff($then, $now)->format("%d");
					if ($difference != 0) {
						echo $difference." days ago";
					} else {
						$difference = date_diff($then, $now)->format("%h");
						if ($difference != 0) {
							echo $difference." hours ago";
						} else {
							$difference = date_diff($then, $now)->format("%i");
							if ($difference != 0) {
								echo $difference." minutes ago";
							} else {
								$difference = date_diff($then, $now)->format("%frac");
								if ($difference != 0) {
									echo $difference." seconds ago";
								} else {
									echo "just now";
								}
							}
						}
					}
				}
			}
		}
		$topicQuery = "SELECT * FROM topics ORDER BY topic_last_update DESC";
		$checkResult = mysqli_query($link, $topicQuery);
		while ($rows = mysqli_fetch_assoc($checkResult)):

			$date = $rows['topic_date'];
			$then = $rows['topic_last_update'];
			$then = new DateTime($then);

			$userId = $rows['topic_user'];
			$userQuery = "SELECT * FROM users WHERE user_id = '".mysqli_real_escape_string($link,$userId)."'";
			$userCheckResult = mysqli_query($link, $userQuery);
			$userRows = mysqli_fetch_assoc($userCheckResult);

			$topicId = $rows['topic_id'];
			$postQuery = "SELECT * FROM posts WHERE post_topic = '".mysqli_real_escape_string($link,$topicId)."'";
			$postCheckResult = mysqli_query($link, $postQuery);
			$postCount = mysqli_num_rows($postCheckResult);
	?>
	<li>
		<?php
		echo "<a href='topic?id=".$rows['topic_id']."'>";
		?>
			<h3><?php echo $rows['topic_title'];?></h3>
		</a>
		<div>
			<div>
				<h4>By <span><?php echo $userRows['user_name'];?></span> - <?php echo date('j F Y',strtotime($date)); ?></h4>
			</div>
			<div class="particulars">
				<h4><?php echo dateDifference($then); ?></h4>
				<h4><?php echo $postCount; ?> replies</h4>
			</div>
		</div>
	</li>

	<?php
		endwhile;
	?>
	<li>
		<h4 class="center-text">No more topics</h4>
	</li>
</div>









