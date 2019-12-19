<?php

namespace App\Controller;

use App\Entity\CommandeCoating;
use App\Form\CommandeCoatingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandeCoatingController extends AbstractController {
    /*
     * @Route("/form2", name="form2")
     */
    public function newCommandeCoating(Request $request, EntityManagerInterface $manager) {
        $commande = new CommandeCoating();

        $form = $this->createForm(CommandeCoatingType::class, $commande);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $commande->setCreatedAt(new \DateTime());
            $manager->persist($commande);
            $manager->flush();

            return $this->redirectToRoute("form");
        }
        return $this->render('front/form2.html.twig', [
            "formcoat" => $form->createView(),
            'commandecoat' => $commande,
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
