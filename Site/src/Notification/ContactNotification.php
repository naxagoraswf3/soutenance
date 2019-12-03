<?php
namespace App\Notification;

use autoload;
use Twig\Environment;
use App\Entity\Contact;

class ContactNotification {

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;
    
    public function __construct(\Swift_Mailer $mailer, Environment $renderer){

        $this->mailer = $mailer;
        $this->renderer = $renderer;


    }

   public function notify(Contact $contact){
       //new \Swift_Message('agence : ' . $contact->getProperty()->getTitle())
    $message = (new Swift_Message())

    ->setFrom('noreply@agence.fr')
    ->setTo('contact@agence.fr')
    ->setReplyTo($contact->getEmail())
    ->setBody($this->renderer->render('emails/email.html.twig',[
        'contact' => $contact
    ]), 'text/html')
    //->attachFromPath('../public/wf3.pdf');
    ->attach(Swift_Attachment::fromPath('../public/wf3.pdf'));

    $this->mailer->send($message);


 }
}