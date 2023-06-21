<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\MailMaster;
use App\Models\Newsletter;

use Illuminate\Http\Request;

class EmailController extends Controller
{
   public function sendEmail($title, $subject,$body, $email, $name='', $admin='',){
    $formated_body = str_replace('{{$email}}', $email, $body);  
    $mailData = [
          'title' => $title,
          'subject' => $subject,
          'body' => $formated_body,
          'email' => $email
        ];

        Mail::to($email)->send(new MailMaster($mailData)); 
   }

}
