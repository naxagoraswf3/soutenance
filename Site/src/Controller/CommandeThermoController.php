<?php

namespace App\Controller;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;

class CommandeThermoController extends AbstractController
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
     * @Route("/devisThermo", name="devisThermo")
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function showTP(CommandeRepository $repository){
      $commandes= $repository->findLastId("id");
      // dump($commandes);
      return $this->render("front/TpConfirm.html.twig", ["commandes" => $commandes]);
    }

// l'annotation permet de définir la route http où sera affichée notre page
    /**
     * @Route("/formThermo", name="formThermo")
     */

    // on définit une nouvelle fonction publique
    public function newCommande(Request $request, EntityManagerInterface $manager)
    {
    	$commande = new Commande();

    	$form = $this->createForm(CommandeType::class,$commande); // on crée un formulaire, que l'on lie à l'entité de notre commande
    	$form->handleRequest($request); // le formulaire analyse si il a bien été rempli
    	if($form->isSubmitted() && $form->isValid()){
    		$commande->setCreatedAt(new \DateTime()); // la date de création se génère automatiquement à l'heure où le formulaire est soumit
            $manager->persist($commande);
            $manager->flush();

            return $this->redirectToRoute("devisThermo"); // une fois le formulaire envoyé, l'utilisateur sera redirigé sur cette route http
        }
        return $this->render('front/formThermo.html.twig', [ // la route http affichera le fichier twig correspondant à l'adresse en paramètre du render
            "form" => $form->createView(), // ce paramètre est une variable qui servira à twig pour son affichage
        ]);
    }

}