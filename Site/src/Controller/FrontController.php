<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\CommandeCoating;
use App\Form\CommandeCoatingType;
use App\Form\CommandeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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

		$commande = new Commande();

		$form = $this->createForm(CommandeType::class, $commande);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$commande->setCreatedAt(new \DateTime());
			$manager->persist($commande);
			$manager->flush();

			//return $this->redirectToRoute("form");
		}
		$commandeCoating = new CommandeCoating();

		$formCoating = $this->createForm(CommandeCoatingType::class, $commandeCoating);
		$formCoating->handleRequest($request);

		if ($formCoating->isSubmitted() && $formCoating->isValid()) {

			$commandeCoating->setCreatedAt(new \DateTime());
			$manager->persist($commandeCoating);
			$manager->flush();

			return $this->redirectToRoute("form");
		}
		return $this->render('test.html.twig', [
			"formcoat" => $formCoating->createView(),
			'commandecoat' => $commandeCoating,
			"form" => $form->createView(),
			'commande' => $commande,
			'controller_name' => 'FrontController',

		]);

	}
}
