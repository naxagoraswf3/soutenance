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
     * @var CommandeRepository
     */
    private $repository;
    public function __construct(CommandeCoatingRepository $repository)
    {
      $this->repository = $repository;
    }

    /**
     * @Route("/deviscp", name="deviscp")
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function showCT(CommandeCoatingRepository $repository){
      $commandes= $repository->findLastId("id");
      dump($commandes);
      return $this->render("front/CoatingConfirm.html.twig", ["commandes" => $commandes]);
    }

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

            return $this->redirectToRoute("deviscp");
        }
        return $this->render('front/form2.html.twig', [
            "formcoat" => $form->createView(),
            'commandecoat' => $commande
        ]);
    }
}
