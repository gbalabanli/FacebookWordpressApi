<?php
function mail_for_scheduler_fb($body){
    $emailTo = get_option( 'admin_email' );
	$subject = "Message from SCHEDULE JOB fb download"; 
	$headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $emailTo;
				  
	wp_mail($emailTo, $subject, $body, $headers);
}
?>