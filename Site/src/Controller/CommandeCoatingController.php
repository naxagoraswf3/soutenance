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
     * @var CommandeCoatingRepository
     */
    private $repository;
    public function __construct(CommandeCoatingRepository $repository)
    {
      $this->repository = $repository;
    }

    /**
     * @Route("/devisCoat", name="devisCoat")
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function showCT(CommandeCoatingRepository $repository){
      $commandes= $repository->findLastId("id");
      // dump($commandes);
      return $this->render("front/CoatingConfirm.html.twig", ["commandes" => $commandes]);
    } // le contenu de la variable sera la réponse de la fonction de notre repository


    // l'annotation permet de définir la route http où sera affichée notre page

    /**
     * @Route("/formCoat", name="formCoat")
     */

    // on définit une nouvelle fonction publique
    public function newCommandeCoating(Request $request, EntityManagerInterface $manager)
    {
    	$commande = new CommandeCoating();

    	$form = $this->createForm(CommandeCoatingType::class,$commande); // on crée un formulaire, que l'on lie à l'entité de notre commande
    	$form->handleRequest($request); // le formulaire analyse si il a bien été rempli
    	if($form->isSubmitted() && $form->isValid()){
    		$commande->setCreatedAt(new \DateTime()); // la date de création se génère automatiquement à l'heure où le formulaire est soumit
            $manager->persist($commande);
            $manager->flush();

            return $this->redirectToRoute("devisCoat"); // une fois le formulaire envoyé, l'utilisateur sera redirigé sur cette route http
        }
        return $this->render('front/formCoat.html.twig', [ // la route http affichera le fichier twig correspondant à l'adresse en paramètre du render
            "formcoat" => $form->createView(), // ce paramètre est une variable qui servira à twig pour l'affichage du formulaire
        ]);
    }
}
