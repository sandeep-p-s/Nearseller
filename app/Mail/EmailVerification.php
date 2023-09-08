<?php
namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationToken;
    public $userName;
    public $userEmail;
    public $mailContent;
    public $checkval;
    public $otpMessage;
    public $passwdVal;
    public $refidId;
    public $ApprovedTime;
    public $ApprovedMessage;


    public function __construct($verificationToken, $userName, $userEmail,$checkval,$otpMessage)
    {
        $typevals = urldecode($verificationToken);
        $verificationTkn = base64_decode($typevals);
        $verifcatnval=explode('-',$verificationTkn);
        $this->passwdVal = $verifcatnval[2];
        $this->refidId = $verifcatnval[3];
        $this->verificationToken = $verificationToken;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->checkval = $checkval;
        $this->otpMessage = $otpMessage;
        $this->ApprovedTime = $verifcatnval[2];
        $this->ApprovedMessage = $otpMessage;
    }


    public function build()
    {

        if($this->checkval==1)
        {
            $subject = 'Email ID Verification';
            return $this->from('itsuportshyzventures@gmail.com', 'NEAR SELLERS')->subject($subject)->view('emails.email_verification');
        }
        else if($this->checkval==2)
        {
            $subject = 'One Time Password';
            return $this->from('itsuportshyzventures@gmail.com', 'NEAR SELLERS')->subject($subject)->view('emails.otp_verification');
        }
        else if($this->checkval==3)
        {
            $subject = 'Reset Password';
            return $this->from('itsuportshyzventures@gmail.com', 'NEAR SELLERS')->subject($subject)->view('emails.resetpasswd_verification');
        }
        else if($this->checkval==4)
        {
            $subject = 'Email ID Verification';
            return $this->from('itsuportshyzventures@gmail.com', 'NEAR SELLERS')->subject($subject)->view('emails.admemail_verification');
        }
        else if($this->checkval==5)
        {
            $subject = 'Approved Registered Shop';
            return $this->from('itsuportshyzventures@gmail.com', 'NEAR SELLERS')->subject($subject)->view('emails.admshop_approved');
        }
        else if($this->checkval==6)
        {
            $subject = 'Email ID Verification';
            return $this->from('itsuportshyzventures@gmail.com', 'NEAR SELLERS')->subject($subject)->view('emails.admaffliteemail_verification');
        }

        else if($this->checkval==7)
        {
            $subject = 'Approved Registered Affiliate';
            return $this->from('itsuportshyzventures@gmail.com', 'NEAR SELLERS')->subject($subject)->view('emails.admaffilate_approved');
        }



    }




}
