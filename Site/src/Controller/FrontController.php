<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Entity\CommandeCoating;
use App\Form\CommandeCoatingType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController {
	/**
	 * @Route("/", name="front")
	 */
	public function index() {
		return $this->render('front/index.html.twig');
	}

	/**
	 * @Route("/form", name="form")
	 */
	public function newCommande(Request $request, EntityManagerInterface $manager) {
	
		return $this->render('choixForm.html.twig', [
			'controller_name' => 'FrontController',

		]);
    }
    /**
     * @Route("/formCoating", name="formCoating")
     */
    public function formCoating(Request $request, EntityManagerInterface $manager, MailerInterface $mailer) {
        $commandeCoating = new CommandeCoating();

        $formCoating = $this->createForm(CommandeCoatingType::class, $commandeCoating);
        $formCoating->handleRequest($request);

        if ($formCoating->isSubmitted() && $formCoating->isValid()) {

            $commandeCoating->setCreatedAt(new \DateTime());
            $manager->persist($commandeCoating);
            $manager->flush();


            $email = (new Email())
            ->from('client@email.com')
            ->to('naxagoras@gmail.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Requete de devis')
            ->text('voila votre commande!')
            ->html('<p>Ouvrire la pj !</p>')
            ->attachFromPath('../devis/mypdf.pdf');
            

        $mailer->send($email);
        $this->addFlash('success', 'Message Envoyé');

            return $this->redirectToRoute("form");
        }
        return $this->render('front/form2.html.twig', [
            "formcoat" => $formCoating->createView(),
            'commandecoat' => $commandeCoating,
            'controller_name' => 'FrontController',

        ]);
    }
     /**
     * @Route("/formThermo", name="formThermo")
     */
    public function formThermo(Request $request, EntityManagerInterface $manager, MailerInterface $mailer) {
        $commande = new Commande();

        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $commande->setCreatedAt(new \DateTime());
            $manager->persist($commande);
            $manager->flush();

            $email = (new Email())
            ->from('client@email.com')
            ->to('naxagoras@gmail.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Requete de devis')
            ->text('voila votre commande!')
            ->html('<p>Ouvrire la pj !</p>')
            ->attachFromPath('../devis/mypdf.pdf');
            

        $mailer->send($email);
        $this->addFlash('success', 'Message Envoyé');


            return $this->redirectToRoute("form");
        }
        return $this->render('front/form.html.twig', [
            "form" => $form->createView(),
            'commande' => $commande,
            'controller_name' => 'FrontController',

        ]);
    }
}
