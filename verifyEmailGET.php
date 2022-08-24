

<?php
$email = $_GET["email"];
$FROM = "dhendik@algostudio.net"; 
$res = [];
$EMAIL_REGEX="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
$TCP_BUFFER_SIZE = 1024;

$result = VerifyMail(trim($email));
if (substr($result[0],0,3) == "250"){
echo 'valid';
}
else 
{
echo 'invalid';
}  


/*
Description:
Verifies email address

Parameters:
$Email - Email address to verify

Returns:
Array containing email verification result.
*/
function VerifyMail($Email) 
{
	global $FROM; // FROM address. See settings section above
	global $EMAIL_REGEX; // Email syntax verification Regex
	global $TCP_BUFFER_SIZE; //TCP buffer size for mail server conversation.

	// $HTTP_HOST gets the host name of the server running the PHP script.
	$HTTP_HOST = $_SERVER["HTTP_HOST"];
	
	// Prep up the function return.
	$Return = array();  

	// Do the syntax validation using simple regex expression.
	// Eliminates basic syntax faults.
	if (!preg_match($EMAIL_REGEX, $Email)) 
	{ 
		$Return[0] = "Bad Syntax";         
		return $Return; 
	}
   
	// load the user and domain name into a local list from email address using string split function.
	list ( $Username, $Domain ) = explode ("@",$Email); 

	// check if domain has MX record(s)
	if ( checkdnsrr ( $Domain, "MX" ) )  
	{ 
		$log .= "MX record for {$Domain} exists.\r"; 
	
		// Get DNS MX records from domain
		if ( getmxrr ($Domain, $MXHost))  
		{            
		} 

		// Get the IP address of first MX record
		$ConnectAddress = $MXHost[0]; 
		// die(var_dump($MXHost));
		// Open TCP connection to IP address on port 25 (default SMTP port)
		$Connect = fsockopen ( $ConnectAddress, 25 );
		
		// Rerun array element index 1 contains the IP address of the target mail server
		$Return[1] = $ConnectAddress;
		  
		// Successful connection to mail server.
		if ($Connect)   
		{

			$log .= "Connection to {$ConnectAddress} SMTP succeeded.\r"; 
			
			// look for a response code of 220 using Regex
 			// die(var_dump(fgets( $Connect, $TCP_BUFFER_SIZE )));
 			$reply = fgets( $Connect, $TCP_BUFFER_SIZE );
			if ( strpos ($reply,"220" ) !== false ) 
			{ 
                 // die(var_dump("ok"));
				$log .= $reply."\r";
				
				// Start SMTP conversation with HELO
				fputs ( $Connect, "HELO ". $HTTP_HOST ."\r\n" ); 
				$log .=  "> HELO ". $HTTP_HOST ."\r"; 
				$reply = fgets ( $Connect, $TCP_BUFFER_SIZE );
				$log .= $reply."\r";                  

				// Next, do MAIL FROM:
				fputs ( $Connect, "MAIL FROM: <". $FROM .">\r\n" ); 
				$log .=  "> MAIL FROM: <". $FROM .">\r"; 
				$reply = fgets ( $Connect, $TCP_BUFFER_SIZE );
				$log .= $reply."\r";    
				
				// Next, do RCPT TO:
				fputs ( $Connect, "RCPT TO: <{$Email}>\r\n" ); 
				$log .= "> RCPT TO: <{$Email}>\r"; 
				$to_reply = fgets ( $Connect, $TCP_BUFFER_SIZE );
				$log .= $to_reply."\r";  
				
				// Quit the SMTP conversation.
				fputs ( $Connect, "QUIT\r\n"); 

				// Close TCP connection
				fclose($Connect); 
			}

		} 
		else 
		{ 
			// Return array element 0 contains a message.
			$Return[0]="500 Can't connect mail server ({$ConnectAddress}).";         
			return $Return; 
		} 
	} 
	else 
	{
		$to_reply = "Domain '{$Domain}' doesn't exist.\r";    
		$log .= "MX record for '{$Domain}' doesn't exist.\r"; 
	}
        
	$Return[0]=$to_reply;
	$Return[2]=$log;

	return $Return;
}
?>