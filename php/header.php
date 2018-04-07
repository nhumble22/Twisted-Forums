<header>
	<a name="top"></a>
		<div class="bar"></div>
		<div class="center logo-container">
			<div>
				<a href="index"><h1>TWISTED</h1></a>
			</div>		
			<div>
				<a href="index"><h1>TWISTED</h1></a>
			</div>		
			<img src="img/dog.png">		
		</div>
		<nav class="center">
			<a href="index"><h4>Discussion Board Index</h4></a>
			<?php
			if (!isset($_SESSION['user'])) {
			?>
			<ul class="dropdown-labels">
				<label for="register-checkbox"><li class="register-button <?php echo $registerSelected; ?>"><h4>Register</h4></li></label>
				<label for="login-checkbox" ><li class="login-button <?php echo $loginSelected; ?>"><h4>Login</h4></li></label>
			</ul>
			<?php
			} else {
			?>
			<label for="add-page-checkbox" onclick="addPage()" ><h4 id="add-page-button" class="<?php echo $topicSelected; ?>">Add new topic</h4></label>
			<ul>
				<h4>Welcome <?php echo $_SESSION['user']['user_name']; ?></h4>
				<label for="logout-checkbox" onclick="logout()" ><h4 id="logout-button">Logout</h4></label>
			</ul>
			
			<?php
			}
		?>
		</nav>
	</header>
	<?php
	if (!isset($_SESSION['user'])) {
	?>
	<div class="center dropdown-box">
		<div class="intro">
			<h3>Welcome to Auckland's balloon twisting forums, Twisted!</h3>
			<p>Here you can discuss gigs, twists, and everything inbetween.<br>To participate, please <span onclick="login()">login</span> or <span onclick="register()">register</span></p>
		</div>
		<input type="checkbox" id="register-checkbox" <?php echo $registerCheckbox; ?>>
		<div class="register dropdown">
				<form method="POST" class="form registerForm">
					<input type="hidden" name="register" id="register" value="register">
				<ul>
					<li>
						<label for="registerEmail"><h4>Email address</h4></label>
						<input type='text' name='registerEmail' id='registerEmail' value="<?php if(isset($_POST['registerEmail'])){ echo $_POST['registerEmail'];}?>" class="input <?php echo $registerEmailClass; ?>">
						<div class="error-box"><h4 class="error" id="registerEmailError"><?php echo $registerEmailError ?></h4></div>
					</li>
					<li>
						<label for="registerUsername"><h4>Username</h4></label>
						<input type='text' name='registerUsername' id='registerUsername' value="<?php if(isset($_POST['registerUsername'])){ echo $_POST['registerUsername'];}?>" class="input <?php echo $registerUsernameClass; ?>">
						<div class="error-box"><h4 class="error" id="registerUsernameError"><?php echo $registerUsernameError ?></h4></div>
					</li>
					<li>
						<label for="registerPassword"><h4>Password</h4></label>
						<input type='password' name='registerPassword' id='registerPassword' class="input  <?php echo $registerPasswordClass; ?>">
						<div class="error-box"><h4 class="error" id="registerPasswordError"><?php echo $registerPasswordError ?></h4></div>
					</li>
					<li>
						<input type="submit" name="submit" value="Submit">
					</li>
				</ul>
				</form>
			</div>
			<input type="checkbox" id="login-checkbox" <?php echo $loginCheckbox; ?>>
			<div class="login dropdown">
				<form method="POST"  class="form loginForm">
					<input type="hidden" name="login" id="login" value="login">
				<ul>
					<li>
						<label for="loginEmail"><h4>Email address</h4></label>
						<input type='text' name="loginEmail" id='loginEmail'  value="<?php if(isset($_POST['loginEmail'])){ echo $_POST['loginEmail'];}?>" class="input <?php echo $loginEmailClass; ?>">
						<div class="error-box"><h4 class="error" id="loginEmailError"><?php echo $loginEmailError ?></h4></div>
					</li>
					<li>
						<label for="loginPassword"><h4>Password</h4></label>
						<input type='password' name="loginPassword" id='loginPassword'  class="input <?php echo $loginPasswordClass; ?>">
						<div class="error-box"><h4 class="error" id="loginPasswordError"><?php echo $loginPasswordError ?></h4></div>
					</li>
					<li>
						<input type="submit" name="submit" value="Submit">
					</li>
				</ul>
				</form>
			</div>
	</div>
	<?php
	} else {
	?>

	<input type="checkbox" id="logout-checkbox">
	<div class="center wrapper">
		<div class="center logout-box">
			<h4>Are you sure you want to logout?</h4> <a href="logout">Yes</a><label for="logout-checkbox" onclick="logout()" ><h4>Cancel</h4></label>
		</div>
	</div>
	<input type="checkbox" id="add-page-checkbox" <?php echo $topicCheckbox; ?>>
	<div class="center wrapper">
		<div class="center add-page">
			<h3>Add new topic</h3>
			<form method="POST" class="form topicForm">
				<input type="hidden" name="topic" id="topic" value="topic">
				<label for="topicTitle"><h4>Subject</h4></label>
				<input type="text" name="topicTitle" id="topicTitle" value="<?php if(isset($_POST['topicTitle'])){ echo $_POST['topicTitle'];}?>" class="input <?php echo $topicTitleClass; ?>">
				<label for="topicContent"><h4>Message</h4></label>
				<textarea name="topicContent" id="topicContent" class="input <?php echo $topicContentClass; ?>"><?php if(isset($_POST['topicContent'])){ echo $_POST['topicContent'];}?></textarea>
				<input type="checkbox" name="emailTopic" id="emailTopic" value="yes" <?php echo $emailTopic; ?>>
				<label for="emailTopic"><h4>Email me a copy of my topic</h4></label>
				<input type="submit" name="submit" value="Submit">
				<div class="error-box"><h4 class="error" id="topicError"><?php echo $topicError ?></h4></div>
				
			</form>
		</div>
	</div>
	<?php
	}
	?>