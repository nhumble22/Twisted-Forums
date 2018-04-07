<?php
//Default Class Error Inserts//
	//register
	$registerEmailClass = "";
	$registerUsernameClass = "";
	$registerPasswordClass = "";

	//login
	$loginEmailClass = "";
	$loginPasswordClass = "";

	//topic		
	$topicTitleClass = "";
	$topicContentClass = "";

	//reply
	$postContentClass = "";

//Default Error Inserts//
	//register
	$registerEmailError = "";
	$registerUsernameError = "";
	$registerPasswordError = "";

	//login
	$loginEmailError = "";
	$loginPasswordError = "";

	//topic		
	$topicError = "";


	//reply
	$postContentError = "";

//Checkbox Inserts
$registerCheckbox = "";
$loginCheckbox = "";
$topicCheckbox = "";

//Checkbox Selected Inserts
$registerSelected = "";
$loginSelected = "";
$topicSelected = "";

$emailTopic = "";
$emailReply = "";

//Error Count
$registerErrors = 0;
$loginErrors = 0;
$topicErrors = 0;










//If Post Handles
if (isset($_POST['submit'])){ 

	//RegisterCheck
	if (isset($_POST['register']) && $_POST['register'] == 'register')  {
		//register email
		$registerEmail = filter_var($_POST['registerEmail'], FILTER_SANITIZE_EMAIL);
		if ($registerEmail != "") {
			if (!filter_var($registerEmail, FILTER_VALIDATE_EMAIL)) {
				$registerEmailError = "Email not valid";
				$registerErrors++;
				$registerEmailClass = "shatter";
			} else {
				//search database, if found in database, echo already registered
				$checkQuery = "SELECT * FROM users WHERE user_email = '".mysqli_real_escape_string($link,$registerEmail)."'";
				$checkResult = mysqli_query($link, $checkQuery);
				$rows = mysqli_fetch_assoc($checkResult);
				if ($rows['user_email'] === $registerEmail) {
				    $registerEmailError = "	Already registered";
				    $registerErrors++;
				    $registerEmailClass = "shatter";
				} else {
					$registerEmailError = "Seems valid";
					//do nothing
				}				
			}
		} else if ($registerEmail === "") {
			$registerErrors++;
			$registerEmailError = "Required";
			$registerEmailClass = "shatter";
		};
		//register username
		$registerUsername = filter_var($_POST['registerUsername'], FILTER_SANITIZE_STRING);
		if ($registerUsername != "") {
			if (!preg_match("/^[a-zA-Z ]*$/",$registerUsername)) {
				$registerUsernameError = "Invalid - Letters only";
				$registerErrors++;
				$registerUsernameClass = "shatter";
			} else if (strlen($registerUsername) < 6) {
				$registerUsernameError = "Minimum 6 characters";
				$registerErrors++;
				$registerUsernameClass = "shatter";
			} else {
				//search database, if found in database, echo already registered
				$checkQuery = "SELECT * FROM users WHERE user_name = '".mysqli_real_escape_string($link,$registerUsername)."'";
				$checkResult = mysqli_query($link, $checkQuery);
				$rows = mysqli_fetch_assoc($checkResult);
				if ($rows['user_name'] === $registerUsername) {
				    $registerUsernameError = "Already registered";
				    $registerErrors++;
				    $registerUsernameClass = "shatter";
				} else {
					$registerUsernameError = "Seems valid";
					//do nothing
				}
			}
		} else if ($registerUsername === "") {
			$registerErrors++;
			$registerUsernameError = "Required";
			$registerUsernameClass = "shatter";
		}
		//register password
		$registerPassword = $_POST['registerPassword'];
		if ($registerPassword != "") {
			if (strlen($registerPassword) < 6) {
				$registerPasswordError = "Minimum 6 characters";
				$registerErrors++;
				$registerPasswordClass = "shatter";
			} else {
				$registerPasswordError = "Seems Valid";
				//do nothing
			}
		} else if ($registerPassword=== "") {
			$registerErrors++;
			$registerPasswordError = "Required";
			$registerPasswordClass = "shatter";
		}
		//If Errors Check
		if ($registerErrors > 0) {
			$registerCheckbox = "checked";
			$registerSelected = "selected-button";
		} else {
			$registerEmail = trim($registerEmail);
			$registerUsername = trim($registerUsername);
			$registerPassword = password_hash($registerPassword, PASSWORD_BCRYPT);
	 		$addQuery = "INSERT INTO users (user_email, user_name, user_password) 
	 					VALUES ('".mysqli_real_escape_string($link,$registerEmail)."', 
	 						'".mysqli_real_escape_string($link,$registerUsername)."', 
	 						'".mysqli_real_escape_string($link,$registerPassword)."')";
	 		$result = mysqli_query($link, $addQuery);
		}
	}

	//LoginCheck
	if (isset($_POST['login']) && $_POST['login'] == 'login')  {
		$loginEmail = filter_var($_POST['loginEmail'], FILTER_SANITIZE_EMAIL);
		if ($loginEmail != "") {
			if (!filter_var($loginEmail, FILTER_VALIDATE_EMAIL)) {
				$loginEmailError = "Email not valid";
				$loginErrors++;
				$loginEmailClass = "shatter";
			} else {
				//search database, if not found in database, echo not registered
				$checkQuery = "SELECT * FROM users WHERE user_email = '".mysqli_real_escape_string($link,$loginEmail)."'";
				$checkResult = mysqli_query($link, $checkQuery);
				$rows = mysqli_fetch_assoc($checkResult);
				if ($rows['user_email'] === $loginEmail) {
				    $loginEmailError = "Appears Valid";
					$loginPassword = $_POST['loginPassword'];
					if ($loginPassword != "") {
						//cheack n database
			 			$checkQuery = "SELECT * FROM users WHERE user_email = '".mysqli_real_escape_string($link,$loginEmail)."'";
			 			$checkResult = mysqli_query($link, $checkQuery);
			 			$rows = mysqli_fetch_assoc($checkResult);

			 			$dbpassword = $rows['user_password'];

			 			if (password_verify($loginPassword, $dbpassword)) {
			 	 			$loginPasswordError = "success";
			 	 			
			 	 			//update session id
			 	 			$sessionQuery = "UPDATE users SET session_id = '".session_id()."'  WHERE user_email = '".mysqli_real_escape_string($link,$loginEmail)."'";
			 	 			mysqli_query($link, $sessionQuery);

			 	 			//set session user
			 	 			$checkQuery = "SELECT * FROM users WHERE session_id = '".session_id()."'";
			 	 			$testUser = mysqli_query($link, $checkQuery);
			 	 			if (mysqli_num_rows($testUser) == 1) {
			 		 		 	$rows = mysqli_fetch_assoc($testUser);
			 		 		 	$_SESSION['user'] = $rows;
			 		 		}
			 		 	} else {
			 		 		$loginPasswordError = "Incorrect password";
							$loginErrors++;
							$loginPasswordClass = "shatter";
			 		 	}
					} else {
						$loginPasswordError = "Required";
						$loginErrors++;
						$loginPasswordClass = "shatter";
					}
				} else {
					$loginEmailError = "Email not found";
					$loginErrors++;
					$loginEmailClass = "shatter";
					
				}
			}
		}else {
			$loginEmailError = "Required";
			$loginErrors++;
			$loginEmailClass = "shatter";
		}
		//If Errors Check
		if ($loginErrors > 0) {
			$loginCheckbox = "checked";
			$loginSelected = "selected-button";
		} else {
			//real stuff
		}
	}

	//PostReplyCheck
	if (isset($_POST['reply']) && $_POST['reply'] == 'reply')  {	
		$postContent = filter_var($_POST['postContent'], FILTER_SANITIZE_STRING);
		if ($postContent != "") {
			if (strlen($postContent) < 10) {
				$postContentError = "Reply  has a minimum of 10 characters";
				$postContentClass = "shatter";
				$emailReply = "checked";
			} else {
				$postContent = trim($_POST['postContent']);
				$postDate = date("Y-m-d H:i:s");
				$postTopic = $_GET['id'];
				$postUser = $_SESSION['user']['user_id'];

				//update posts table
				$addQuery = "INSERT INTO posts (post_content, post_date, post_topic, post_user) 
	 						 VALUES ('".mysqli_real_escape_string($link,$postContent)."', 
	 						'".mysqli_real_escape_string($link,$postDate)."', 
	 						'".mysqli_real_escape_string($link,$postTopic)."',
	 						'".mysqli_real_escape_string($link,$postUser)."')";
		 		$result = mysqli_query($link, $addQuery);

				//update topic last update
				$updateQuery = "UPDATE topics SET topic_last_update = '".mysqli_real_escape_string($link,$postDate)."' WHERE topic_id = '".mysqli_real_escape_string($link,$postTopic)."'";
				$result = mysqli_query($link, $updateQuery);
				$replyError = "success";

				//get post anchor ID
				$postQuery = "SELECT * FROM posts WHERE post_topic = '".mysqli_real_escape_string($link,$postTopic)."' ORDER BY post_id DESC LIMIT 1";
				$result = mysqli_query($link, $postQuery);
				$rows = mysqli_fetch_assoc($result);
				$newPostId = $rows['post_id'];

				$emailToReply = $_POST['emailReply'];
				if ($emailToReply === 'Yes') {
					//get user email save as $email
					$userEmail = $_SESSION['user']['user_email'];
					//get thread title save as $topicTitle
					$topicQuery = "SELECT * FROM topics WHERE topic_id = '".mysqli_real_escape_string($link,$postTopic)."'";
					$result = mysqli_query($link, $topicQuery);
					$rows = mysqli_fetch_assoc($result);
					$topicTopic = $rows['topic_title'];
					$topicContent = $rows['topic_content'];
					$topicDate = $rows['topic_date'];

				    //email reply details to users email
					$email_subject = "Your reply to Twisted Forum's topic: ".$topicTitle."";

					$email_message = "Your reply to Twisted Forum's topic: ".$topicTitle."on ".$postDate."\n\n";
					$email_message .= "Forum topic:".$topicTitle."\n";
				    $email_message .= "Topic date:".$topicDate."\n\n";
   					$email_message .= "".$topicContent."\n\n";
   					$email_message .= "Your Reply:\n\n";
   					$email_message .= "".$postContent."\n\n";
   
					// create email headers
					$headers = 'From: noreply@twisted.co.nz'."\r\n".
					'Reply-To: noreply@twisted.co.nz'."\r\n" .
					'X-Mailer: PHP/' . phpversion();
					@mail($userEmail, $email_subject, $email_message, $headers);  
				}

				header("Location:topic?id=$postTopic#post-$newPostId");
				exit();
			}
		} else {
			$postContentError = "Required";
			$postContentClass = "shatter";
			
		}

	}

	//TopicCheck
	if (isset($_POST['topic']) && $_POST['topic'] == 'topic')  {
		$topicTitle = filter_var($_POST['topicTitle'], FILTER_SANITIZE_STRING);
		$topicContent = filter_var($_POST['topicContent'], FILTER_SANITIZE_STRING);
		

		if ($topicTitle === "" || $topicContent === "") {
			$topicError = "All fields are required";
			$topicErrors++;
			if ($topicTitle === "") {
				$topicTitleClass = "shatter";
			}
			if ($topicContent === "") {
				$topicContentClass = "shatter";
			}
		} else if (strlen($topicTitle) < 10 || strlen($topicContent) < 10) {
			$topicError = "Minimum 10 characters per field";
			$topicErrors++;
			if (strlen($topicTitle) < 10) {
				$topicTitleClass = "shatter";
			}
			if (strlen($topicContent) < 10) {
				$topicContentClass = "shatter";
			}
		} 
		if ($topicErrors > 0) {
			$topicSelected = "selected-button";
			$topicCheckbox = "checked";
			
		} else {
			//submit form
				$topicDate = date("Y-m-d H:i:s");
				$topicLastUpdate = $topicDate;
				$topicUser = $_SESSION['user']['user_id'];

				$updateQuery = "INSERT INTO topics (topic_title, topic_content, topic_date, topic_user, topic_last_update)
								VALUES ('".mysqli_real_escape_string($link,$topicTitle)."', 
		 						'".mysqli_real_escape_string($link,$topicContent)."', 
		 						'".mysqli_real_escape_string($link,$topicDate)."',
		 						'".mysqli_real_escape_string($link,$topicUser)."',
		 						'".mysqli_real_escape_string($link,$topicLastUpdate)."')";
				$result = mysqli_query($link, $updateQuery);

				$topicQuery = "SELECT topic_id FROM topics WHERE topic_title = '".mysqli_real_escape_string($link,$topicTitle)."'";
				$result = mysqli_query($link, $topicQuery);
				$rows = mysqli_fetch_assoc($result);
				$newTopicId = $rows['topic_id'];

				$emailToTopic = $_POST['emailTopic'];
				if ($emailToTopic === 'Yes') {
					//get user email save as $userEmail
					$userEmail = $_SESSION['user']['user_email'];

				    //email reply details to users email
					$email_subject = "Your new topic posted on Twisted Forum: ".$topicTitle."";

					$email_message = "Your new topic posted on Twisted Forum: ".$topicTitle."on ".$topicDate."\n\n";
   					$email_message .= "".$topicContent."\n\n";
   
					// create email headers
					$headers = 'From: noreply@twisted.co.nz'."\r\n".
					'Reply-To: noreply@twisted.co.nz'."\r\n" .
					'X-Mailer: PHP/' . phpversion();
					@mail($userEmail, $email_subject, $email_message, $headers);  
				}

				header("Location:topic?id=$newTopicId");
				exit();
		}
	}
	
	//editReply
	if (isset($_POST['editPost']) && $_POST['editPost'] == 'editPost')  {
		$postId = $_POST['postId'];
		$postContent = $_POST['editPostContent'];

		//get post details
		$postQuery = "SELECT * FROM posts WHERE post_id='".mysqli_real_escape_string($link,$postId)."'";
		$result = mysqli_query($link, $postQuery);
		$rows = mysqli_fetch_assoc($result);
		$topicId = $rows['post_topic'];

		//update
		$postQuery = "UPDATE posts SET post_content = '".mysqli_real_escape_string($link,$postContent)."' WHERE post_id='".
		mysqli_real_escape_string($link,$postId)."'";
		mysqli_query($link, $postQuery);

		header("Location:topic?id=$topicId#post-$postId");
		exit();
	}


	//editTopic
	if (isset($_POST['editTopicDetails']) && $_POST['editTopicDetails'] == 'editTopicDetails')  {
		$topicId = $_POST['topicId'];
		$topicTitle = $_POST['editTopicTitle'];
		$topicContent = $_POST['editTopicContent'];

		//update
		$topicQuery = "UPDATE topics SET topic_title = '".mysqli_real_escape_string($link,$topicTitle)."', 
		topic_content = '".mysqli_real_escape_string($link,$topicContent)."' 
		WHERE topic_id='".mysqli_real_escape_string($link,$topicId)."'";
		mysqli_query($link, $topicQuery);

		header("Location:topic?id=$topicId");
		exit();
	}














}
?>



