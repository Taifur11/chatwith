<?php 
include_once "classes/User.php";
include_once "classes/Message.php";
include_once "libs/Session.php";
Session::init();
$user=new User();
$msg=new Message();
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ChatWith | Home</title>
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" href="style/font-awesome.min.css">
	<link rel="stylesheet" href="style/style.css">
	<link rel="stylesheet" href="style/home.css">
</head>



<body>
	<div class="container main-section">
	    <div class="row">
	    	<div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
	    		<div class="input-group searchbox">
	    			<div class="input-group-btn" style="margin-left:6px;">
	    				<center>
	    					<a href=""><button class="btn btn-default search-icon">Add New User</button></a>
	    					<a href=""><button name="signout" class="btn btn-danger">Sign Out</button></a>
	    				</center>
	    			</div>
	    		</div>
	    		<div class="left-chat">
	    			<ul>
	    				<?php 
	    				$users=$user->getAllUser();
	    				if($users){
	    					while ($row=$users->fetch_assoc()) { ?>
	    				<li>
							<div class="chat-left-img">
								<img src="<?php echo $row['profile_pic']; ?>" alt="">&nbsp
							</div>
							<div class="chat-left-detail">
								<p><a href="index.php?user_email=<?php echo $row['email']; ?>"><?php echo $row['username']; ?></a></p>
								<?php 
								$login=$row['status'];
								if($login=='online'){
									echo "<span><i class='fa fa-circle' aria-hidden='true'></i>&nbspOnline</span>";
								}
								else{
									echo "<span><i class='fa fa-circle-o' aria-hidden='true'></i>&nbspOffine</span>";
								}
							 ?>
							</div>
	    				</li>
	    				<?php }} ?>
	    			</ul>
	    		</div>
	    	</div>
	    	<div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
	    		<div class="row">
	    			<?php 

	    				$email=Session::get("email");
	    				$singleuser=$user->userByEmail($email);
	    				if($singleuser){
	    					$row=$singleuser->fetch_assoc();
	    				}
	    				$singleuser_id=$row['id'];
	    				$singleuser_username=$row['username'];
	    			?>
					
					<?php 

					if(isset($_GET['user_email'])){
						$get_user_email=$_GET['user_email'];
						$get_user=$user->userByEmail($get_user_email);
	    				if($get_user){
	    					$get_user_row=$get_user->fetch_assoc();
	    				
	    				$get_user_username=$get_user_row['username'];
	    				$get_user_profilepic=$get_user_row['profile_pic'];
	    					}}
					$total_msg=$msg->totalMsg($singleuser_username,$get_user_username);
						
					 ?>
				


				<div class="col-md-12 right-header">
					<div class="right-header-img">
						<img src="<?php echo $get_user_profilepic; ?>" alt="">
					</div>
					<div class="right-header-detail">
						
							<p><?php echo $get_user_username; ?></p>
							<span><?php echo $total_msg; ?> message</span>&nbsp &nbsp
							
					</div>
				</div>
	    		</div>
<script>
		$('#scrolling_to_bottom').animate({
			scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 1000);
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			var height = $(window).height();
			$('.left-chat').css('height', (height - 92) + 'px');
			$('.right-header-contentChat').css('height', (height - 163) + 'px');
		});
</script>
	    		<div class="row">
	    			<div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
	    				
						<?php 

						$msg_update=$msg->upadteMsgStatus($singleuser_username,$get_user_username);
						$get_msg=$msg->getMsg($singleuser_username,$get_user_username);
						if($get_msg){
							while($get_msg_row=$get_msg->fetch_assoc()){
								$sender=$get_msg_row['sender_info'];
								$receiver=$get_msg_row['receiver_info'];
								$content=$get_msg_row['content'];
								$date=$get_msg_row['msg_date'];
						 ?>
						
						<ul>
							<?php 

								if(($singleuser_username==$sender) AND ($get_user_username==$receiver)){
									?>
									<li>
										<div class="rightside-left-chat">
											<span><?php echo $singleuser_username; ?> <small><?php echo $date; ?></small></span><br><br>
											<p><?php echo $content; ?></p>
										</div>
									</li>

							<?php }
	else if(($singleuser_username==$receiver) AND ($get_user_username==$sender)){
									?>
									<li>
										<div class="rightside-right-chat">
											<span><?php echo $get_user_username; ?> <small><?php echo $date; ?></small></span><br><br>
											<p><?php echo $content; ?></p>
										</div>
									</li>

							<?php } ?>

						</ul>
						<?php }} ?>
	    			</div>
	    		</div>
	    		
				
				<div class="row">
					<div class="col-md-10 right-chat-textbox">
						<form method="post">
							<input type="text" name="content" autocomplete="off" placeholder="Write Your Message......">
							<!-- <input type="submit" value="send" name="send"> -->
							<button class="btn" name="send"><i class="fa fa-telegram" ></i></button>
						</form>
					</div>
				</div>

	    	</div>
	    </div>
	</div>
	
	<?php 
					if(isset($_POST['send'])){
						$msg_content=$_POST['content'];
						if($msg_content==""){
							echo "
									<div class='alert alert-danger'><strong><center>Message is unable to send</center></strong></div>
							";
						}
						else{
							$msg_content;
							$insert_msg=$msg->msgInsert($singleuser_username,$get_user_username,$msg_content);
						}
					}
					
				?>






    <script src="inc/js/jquery-3.5.1.slim.min.js"></script>
    <script src="inc/js/popper.min.js"></script>
    <script src="inc/js/bootstrap.min.js"></script>
</body>
</html>