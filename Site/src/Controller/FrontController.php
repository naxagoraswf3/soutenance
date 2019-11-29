<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Entity\CommandeCoating;
use App\Form\CommandeCoatingType;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front")
     */
    public function index()
    {
        return $this->render('front/index.html.twig');
    }

    /**
     * @Route("/form", name="form")
     */
    public function newCommande(Request $request, EntityManagerInterface $manager)
    {
    	$commande = new Commande();

    	$form = $this->createForm(CommandeType::class,$commande);
    	$form->handleRequest($request);
    	if($form->isSubmitted() && $form->isValid()){
    		$commande->setCreatedAt(new \DateTime());
            $manager->persist($commande);
            $manager->flush();

            return $this->redirectToRoute("form");
        }
        return $this->render('front/form.html.twig', [
            "form" => $form->createView(),
            'commande' => $commande,
        ]);
    }

    /**
     * @Route("/form", name="form")
     */
    public function newCommandeCoating(Request $request, EntityManagerInterface $manager)
    {
    	$commande = new CommandeCoating();

    	$form = $this->createForm(CommandeCoatingType::class,$commande);
    	$form->handleRequest($request);
    	if($form->isSubmitted() && $form->isValid()){
    		$commande->setCreatedAt(new \DateTime());
            $manager->persist($commande);
            $manager->flush();

            return $this->redirectToRoute("form");
        }
        return $this->render('front/form.html.twig', [
            "formcoat" => $form->createView(),
            'commandecoat' => $commande,
        ]);
    }
}
