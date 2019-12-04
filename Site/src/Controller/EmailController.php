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
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            $email = (new Email())
            ->from('client@email.com')
            ->to('wardog67435@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Nouvelle demande de devis')
            ->text('Une nouvelle demande de devis a été remplie sur le site Naxagoras-Technology!')
            ->html('<a href="/admin">Vous pouvez également y accéder depuis l interface administrateur du site.</a>')
            ->attachFromPath('../devis/devis.pdf');
            

        $mailer->send($email);
        $this->addFlash('success', 'Message Envoyé');

        return $this->redirectToRoute('contact');
        }



        return $this->render('email/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

