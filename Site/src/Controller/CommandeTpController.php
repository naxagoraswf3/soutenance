<?php

namespace App\Controller;

use App\Repository\CommandeTpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\CommandeTp;
use App\Form\CommandeTpType;

class CommandeTpController extends AbstractController
{
    /**
     * @var CommandeTpRepository
     */

    private $repository;

    public function __construct(CommandeTpRepository $repository)
    {
        $this->repository=$repository;
    }
    /**
     * @Route("/form", name="form")
     */
    public function newCommandeTp(Request $request, EntityManagerInterface $manager)
    {
        $commande = new CommandeTp();

        $form = $this->createForm(CommandeTpType::class,$commande);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $commande->setCreatedAt(new \DateTime());
            $manager->persist($commande);
            $manager->flush();

            $lastId = $commande->getId();

            return $this->redirectToRoute("devisTp");
        }
        return $this->render('front/form.html.twig', [
            "formcoat" => $form->createView(),
            'commandecoat' => $commande
        ]);
    }
    /**
     * @Route ("/TpConfirm", name="devisTp")
     */


    public function  showDevisTp(){

        return $this->render("front/TpConfirm.html.twig", compact('Tporder    <'));
    }

    /**
     * @Route("/devisTp")
     */
    public function newDevis()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $user = $this->getUser();
            $user->addFriend($id);
        }
        return $this->redirectToRoute('devisTp');
    }
}