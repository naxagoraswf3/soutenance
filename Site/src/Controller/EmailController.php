<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailController extends AbstractController
{


     /**
     * @var Environment
     */
    private $renderer;
    
    public function __construct(Environment $renderer){


        $this->renderer = $renderer;


    }

    /**
     * @Route("/email", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
       // $form = $this->createForm(ContactType::class);
       // $form->handleRequest($request);


       // if ($form->isSubmitted() && $form->isValid()) {


            $email = (new Email())
            ->from('client@email.com')
            ->to('naxagoras@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Requete de devis')
            ->html('<p>Ouvrire la pj !</p>')
            ->attachFromPath('../public/wf3.pdf');
            

        $mailer->send($email);
        $this->addFlash('success', 'Message Envoyé');

        //return $this->redirectToRoute('contact');
       // }



        return $this->render('email/index.html.twig', [
           // 'form' => $form->createView(),
        ]);
    }
}

