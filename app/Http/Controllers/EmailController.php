<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    //
    public function sendmail(){
    	$to_name = 'Septiadi';
		$to_email = 'septiadizhuo1@gmail.com';
		$data = array('name'=>"Ogbonna Vitalis(sender_name)", 'body' => "A test mail");
		Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
		$message->to($to_email, $to_name)
		->subject('Laravel Test Mail');
		$message->from('septiadi.testmail@gmail.com','Test Mail');
		});
    }
}
