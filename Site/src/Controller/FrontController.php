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
		/*$commande = new Commande();

			$form = $this->createForm(CommandeType::class, $commande);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$commande->setCreatedAt(new \DateTime());
				$manager->persist($commande);
				$manager->flush();

				return $this->redirectToRoute("form");
			}
			return $this->render('front/form.html.twig', [
				"form" => $form->createView(),
				'commande' => $commande,
		*/
		$commande = new Commande();

		$form = $this->createForm(CommandeType::class, $commande);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$commande->setCreatedAt(new \DateTime());
			$manager->persist($commande);
			$manager->flush();

			return $this->redirectToRoute("form");
		}
		$commande1 = new CommandeCoating();

		$form1 = $this->createForm(CommandeCoatingType::class, $commande1);
		$form1->handleRequest($request);
		if ($form1->isSubmitted() && $form1->isValid()) {
			$commande1->setCreatedAt(new \DateTime());
			$manager->persist($commande1);
			$manager->flush();
		}
		return $this->render('test.html.twig', [
			"formcoat" => $form1->createView(),
			'commandecoat' => $commande1,
			"form" => $form->createView(),
			'controller_name' => 'FrontController',
			'commande' => $commande,
		]);

	}

}
