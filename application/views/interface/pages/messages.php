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
			$echo .= "Click the link below to resend the email.<br/><a href='".base_url()."room/resend/".$code."'>Resend</a>";
			$echo .= "<br/><br/>Note: Most likely you entered an invalid email address, please feel free to book a new room.";
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
	case 'sent_contact':
			$echo = "Thank you for contacting us. We will get back to you after 24 hours once our management is done reviewing your concerns.";
			break;
	case 'bad_email_contact':
			$echo = "Ooopsss...I think the email you provided is not a valid email or double check your Email address. Thank you!";
			break;
	case '24hours_passed':
			$echo = 'Apologies as your reservation has been expired, feel free to create a new reservation.';
			$echo .= '<br/>Note: Reservation needs to be confirmed within 24 hours.';
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