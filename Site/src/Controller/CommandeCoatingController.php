<?php

namespace App\Controller;

use App\Entity\CommandeCoating;
use App\Form\CommandeCoatingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandeCoatingController extends AbstractController
{
    /**
     * @var CommandeCoatingRepository
     */
    public function newCommandeCoating(Request $request, EntityManagerInterface $manager) {
        $commande = new CommandeCoating();

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
    /**
     * @Route ("/CoatingConfirm", name="deviscoating")
     */

    public function showDevis() {
       // ajoute les option du pdf
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // création de l'instance de la classe dompdf avec les option crée plus haut
        $dompdf = new Dompdf($pdfOptions);

        // récuperation de rendu twig
        $html = $this->render("front/CoatingConfirm.html.twig", compact('coatingorder    <'));

        //ajout du HTML dans dompdf
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
     * @Route("/deviscoating")
     */
    public function newDevis() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $user = $this->getUser();
            $user->addFriend($id);
        }
        return $this->redirectToRoute('deviscoating');
    }
}
