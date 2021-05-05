<?php
require "PHPMailer/PHPMailerAutoload.php";

function smtpmailer($to, $from, $name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
 
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = 'mail.partnersnewhaven.com';
        $mail->Port = 465;  
        $mail->Username = getenv('SMTP_USERNAME');
        $mail->Password = getenv('SMTP_PASSWORD');
        $mail->IsHTML(true);
        $mail->To= getenv('SMTP_USERNAME');
        $mail->FromName=$name;
        $mail->Sender=$from;
        $mail->AddReplyTo($from, $name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->Send())
        {
            $error ="Please try Later, Error Occured while Processing...";
            return $error; 
        }
        else 
        {
            $error = "Your email has been sent. Partners Bar &amp; Nightclub will get back to you shortly!";  
            return $error;
        }
    }
        
    $to =  getenv('SMTP_USERNAME');
    $from =  $_POST['mail'];
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $subj =  $_POST['subject'];
    $body =  $_POST['body'];
    $txt.= "Content-type:text/html; charset=UTF-8" . "\r\n";
	$txt = "You have received an e-mail from ".$name." - ".$email.":\r\n".$body;


    $error=smtpmailer($to, $from, $name ,$subj, $txt, $body);
    
?>

<html lang="en">    <head>		<title>Email Us | Partners Bar and Nightclub</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
		
		<!-- Stylesheets -->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/partners.css" />
		<link rel="stylesheet" href="../assets/css/slideshow.css" />
    </head>    <body>		<div id="page-wrap">
			<ul class="cb-slideshow">
				<li><span>Image 01</span><div></div></li>
				<li><span>Image 02</span><div></div></li>
				<li><span>Image 03</span><div></div></li>
				<li><span>Image 04</span><div></div></li>
				<li><span>Image 05</span><div></div></li>
				<li><span>Image 07</span><div></div></li>
				<li><span>Image 08</span><div></div></li>
				<li><span>Image 09</span><div></div></li>
				<li><span>Image 10</span><div></div></li>
				<li><span>Image 11</span><div></div></li>
				<li><span>Image 12</span><div></div></li>
				<li><span>Image 13</span><div></div></li>
				<li><span>Image 14</span><div></div></li>
				<li><span>Image 15</span><div></div></li>
				<li><span>Image 16</span><div></div></li>
				<li><span>Image 17</span><div></div></li>
			</ul			<div id="page-wrapper">
				<!-- Header -->
					<div id="header" style="padding: 0; min-height: 50%;">
						<!-- Inner -->
						<div class="inner">
							<header>
								<a href="/" title="Return to Partners Homepage"><h1><img class="logo-img" draggable="false" src="../assets/images/logo.png"/></h1></a>
							</header>
						</div>
					</div>
					<!-- Banner -->
					<section id="banner">
						<header>
							<p><?php echo $error; ?></p>
							<br><br>
							<a class="button rainbow" title="Return to our Homepage" href="../index.php">Return to our Homepage</a>
						</header>
					</section>				</div>    </body></html>