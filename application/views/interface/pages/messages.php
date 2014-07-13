<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/../nav.php');
switch($msg) {
	case 'sent_reserved':
			$echo = "Room reservation successful. Email has been sent to your email address, please do check it immediately.<br/>";
			$echo .= "You have 24 hours to confirm your reservation(s).";
			break;
	case 'bad_email_reserved':
			$echo = "Room reservation successful. Unfortunately we're not able to send you the details through email.";
			$echo .= "Click the link below to resend the email.<br/><a href='".base_url()."resend/'>Resend</a>";
			break;
	case 'max_person_error':
			$echo = "Max persons limit reached.";
			break;
	case 'date_error':
			$echo = "Check in should not be lower than the date today and check out should be higher than check in.";
			break;
	case 'invalid_room_id':
			$echo = "Invalid Room ID.";
			break;
	case 'invalid_email':
			$echo = "Email might be empty or email does not match.";
			break;
	case 'success_payment':
			$echo = "Thank you for choosing ".$this->config->item('website_name').". We've notified the management regarding your payment and they'll review your payment with in 24 hours. We will notify you via email with the status of your reservation after 24 hours.";
			break;
	case 'code_invalid':
			$echo = "The reservation code you input is not valid. Try again.";
			break;
	default:
			$echo = $msg;
		break;
}
?>

<div class="wrapper container round">
	<div class="col-md-12 md-spacer"></div>
	<h1><?=$h1?></h1>
    <p><?=$echo?></p>
</div>

<?php include(__DIR__.'/../footer.php'); ?>