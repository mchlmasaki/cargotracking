<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
 
 public function html_email(){
  $data = array('name'=>"ALLAN KIP");
  Mail::send('mail', $data, function($message) {
   $message->to('kiptalam54@gmail.com', 'Allan Kiptalam')->subject('Laravel HTML Testing Mail');
   $message->from('allankiptalam54@gmail.com','Allan Kiptalam');
  });
  echo "HTML Email Sent. Check your inbox.";
 }
 
}