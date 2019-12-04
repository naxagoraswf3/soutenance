<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\CommandeCoating;
use App\Form\CommandeCoatingType;
use App\Repository\CommandeCoatingRepository;

class CommandeCoatingController extends AbstractController
{
    /**
     * @Route("/form2", name="form2")
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
        return $this->render('front/form2.html.twig', [
            "formcoat" => $form->createView(),
            'commandecoat' => $commande
        ]);
    }
}
