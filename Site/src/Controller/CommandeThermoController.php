<?php

namespace App\Controller;

use App\Entity\Commande;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\Response;
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
      dump($commandes);
        // ajoute les option du pdf
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // création de l'instance de la classe dompdf avec les option crée plus haut
        $dompdf = new Dompdf($pdfOptions);

        // récuperation de rendu twig
        $html = $this->render("front/TpConfirm.html.twig", ["commandes" => $commandes]);

        // ajout du HTML dans dompdf
        $dompdf->loadHtml($html);

        // set la page en A4 et au format portrait
        $dompdf->setPaper('A4', 'portrait');

        // rendu de la page
        $dompdf->render();

        // stockage du pdf dans un variable
        $output = $dompdf->output();


        // choix de la destination du pdf
        $pdfFilepath = '../devis/devis.pdf';

        // creation du pdf dans la destination choisi
        file_put_contents($pdfFilepath, $output);

        // redirection sur la home page
       return $this->render('front/index.html.twig');
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