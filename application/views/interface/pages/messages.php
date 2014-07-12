<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/../nav.php');
?>

<div class="wrapper container round">
	<div class="col-md-12 md-spacer"></div>
	<h1 class="title"><?=$h1?></h1>
    <p>
    <?php
		if($msg == 'sent_reserved') {
			echo "Room reservation successful. Email has been sent to your email address, please do check it immediately.";
			echo "<br/>";
			echo "You have 24 hours to confirm your reservation(s).";
		}
		if($msg == 'bad_email_reserved') {
			echo "Room reservation successful. Unfortunately we're not able to send you the details through email. Click the link below to resend the email.";
			echo "<br/>";
			echo "<a href='".base_url()."resend/'>Resend</a>";
		}
	?>
    </p>
</div>

<?php include(__DIR__.'/../footer.php'); ?>