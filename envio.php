<?php

	function doMail($to, $subject, $body, $html = FALSE, $debug = FALSE){

			$mail = new PHPMailer;
			if ($debug) $mail->SMTPDebug = 3;
	        $mail->isSMTP();                                      // Set mailer to use SMTP
	        $mail->Host = 'mail.daycohost.com';                                                     // Specify main and backup SMTP servers
	        $mail->Port = 25;                   					// TCP port to connect to
	        $mail->SMTPAuth = false;               // Enable SMTP authentication
	        $mail->From = 'root@localhost';
	        $mail->FromName = 'Carrito';
	        $mail->addAddress($to);
	       // $mail->addCC('pg@daycohost.com');                                                                                                         // 
	        $mail->isHTML($html);                                  // Set email format to HTML
	        $mail->Subject = ($subject);
	        $mail->Body    = $body;
	        $sent = $mail->Send(); 
	        if (!$sent) echo "<pre>" . "Error".$mail->ErrorInfo . "<pre>";  // La propiedad errorinfo contiene el error
  			return $sent; 
    }
