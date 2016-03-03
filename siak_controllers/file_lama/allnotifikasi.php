<?php

/* Siak dashboard controller class */

class Allnotifikasi extends Siak_controller{
	public function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->id_user = Siak_session::siak_get('id'); 
		
		$this->rolePage = $this->siak_session->siak_getAll();
		
	}
	
	function index(){
		//Hak Akses
		$method_or_uri = $this->uri->getUri(1);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
	
		$this->data();
		$this->siak_view->siak_render('notifikasi/index', false);
	}
	
	function data(){
		$id = $this->id_user;
		$sql = "
			SELECT
				a.id,
				a.url,
				a.description,
				a.datetime2,
				b.table_name,
				b.table_field,
				b.table_value,
				b.isread
			FROM
				notification as a,
				notification_detail as b
			WHERE
				a.id = b.id_notif AND
				b.table_value = '$id'
			ORDER BY a.id DESC
			  ";
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		
	}
	
	function kirimEmail(){
		
		/*
		* Untuk settingan ini
		* Mail Server menggunakan Ms.Exchange punya IDU
		* Untuk mail server biasa (gmail, yahoo)
		* Settingan sedikit berbeda
		*/
		
		$server = "gmail";
		
		$mail = $this->sendmail;
		
		$mail->isSMTP();
		$mail->SMTPDebug = 2; // 0 => Production , 1 => Development(client messages), 2 => Development(client & server messages)
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		
		$mail->SMTPSecure = 'tls'; // Encryption type (this use for port 587)
		
		$mail->SMTPAuth = true; //
		
		
		if($server=="gmail"){
		// --------------------------------------------------------------------------
		// GMAIL
		// --------------------------------------------------------------------------
		$mail->Host = 'smtp.gmail.com'; // Ms. Exchange Hostname
		
		$mail->Port = 587; // Port

		$mail->Username = "hari.nube@gmail.com"; // Username / Email Addrs
		
		$mail->Password = "nubelikesunix"; // Password
		
		$mail->setFrom('hari.nube@gmail.com', 'Panitia PMB'); // Email Pengirim
		// --------------------------------------------------------------------------
		}else{
		// --------------------------------------------------------------------------
		// MS. Exchange
		// --------------------------------------------------------------------------
		$mail->Host = 'mail.idu.ac.id'; // Ms. Exchange Hostname
		
		$mail->Port = 587; // Port

		$mail->AuthType = 'NTLM'; // Ms. Exchange Auth

		$mail->Username = "pendaftaran"; // Username
		
		$mail->Password = "unhan"; // Password
		
		$mail->setFrom('pendaftaran@idu.ac.id', 'Panitia PMB'); // Email Pengirim
		// --------------------------------------------------------------------------
		}
		
		//Set an alternative reply-to address
		// $mail->addReplyTo('hari.nube@gmail.com', 'Hari jadi'); // Optional
		
// 		$mail->addAddress('hari.nube@gmail.com', 'Hari'); // Email Tujuan
		$mail->addAddress('harijadi_13@yahoo.com', 'Hari Jadi'); // Email Tujuan
		
		$mail->Subject = 'PHPMailer Using Ms. Exchange Mail Server'; // Mail Subject
		
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$pesan = "Helloooo<br>Kamprettt :p";
		$mail->msgHTML($pesan);
		
		//Replace the plain text body with one created manually
		$mail->AltBody = 'Huuuu emailnya ga support HTML tuh :p';

		// $mail->addAttachment('cosplay.jpg'); // Buat lampiran

		//send the message, check for errors
		if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		echo "Message sent!";
		}
		
	}
}