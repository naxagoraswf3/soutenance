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
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->render("front/TpConfirm.html.twig", ["commandes" => $commandes]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Store PDF Binary Data
        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory

        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath = '../devis/devis.pdf';

        // Write file to the desired path
        file_put_contents($pdfFilepath, $output);

        // Send some text response
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