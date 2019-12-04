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



class FrontController extends AbstractController
{

    /**
     * @var CommandeRepository
     */
    private $repository;
    public function __construct(CommandeRepository $repository)
    {
      $this->repository = $repository;
    }

    /**
     * @Route("/devistp", name="devistp")
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function showTP(CommandeRepository $repository){
      $commandes= $repository->findLastId("id");
      dump($commandes);
      return $this->render("front/TpConfirm.html.twig", ["commandes" => $commandes]);
    }




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

            return $this->redirectToRoute("devistp");
        }
        return $this->render('front/form.html.twig', [
            "form" => $form->createView(),
             "formcoat" => $form->createView()
        ]);
    }


}
