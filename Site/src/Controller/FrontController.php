<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\CommandeCoating;
use App\Form\CommandeCoatingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;

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
    public function formCoating(Request $request, EntityManagerInterface $manager) {
        $commandeCoating = new CommandeCoating();

        $formCoating = $this->createForm(CommandeCoatingType::class, $commandeCoating);
        $formCoating->handleRequest($request);

        if ($formCoating->isSubmitted() && $formCoating->isValid()) {

            $commandeCoating->setCreatedAt(new \DateTime());
            $manager->persist($commandeCoating);
            $manager->flush();

            return $this->redirectToRoute("deviscoating");
        }
        return $this->render('front/formCoat.html.twig', [
            "formcoat" => $formCoating->createView(),
            'commandecoat' => $commandeCoating,
            'controller_name' => 'FrontController',

        ]);
    }
     /**
     * @Route("/formThermo", name="formThermo")
     */
    public function formThermo(Request $request, EntityManagerInterface $manager) {
        $commande = new Commande();

        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $commande->setCreatedAt(new \DateTime());
            $manager->persist($commande);
            $manager->flush();

            return $this->redirectToRoute("devisThermo");
        }
        return $this->render('front/formThermo.html.twig', [
            "form" => $form->createView(),
            'commande' => $commande,
            'controller_name' => 'FrontController',

        ]);
    }
   
}

