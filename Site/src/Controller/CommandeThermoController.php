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

        // redirection su la home page
       return $this->render('front/index.html.twig');
    }

    /**
     * @Route("/formThermo", name="formThermo")
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

            return $this->redirectToRoute("devisThermo");
        }
        return $this->render('front/formThermo.html.twig', [
            "form" => $form->createView(),
             "formcoat" => $form->createView()
        ]);
    }

}