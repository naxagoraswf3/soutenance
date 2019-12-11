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
     * @Route("/", name="front")
     */
    public function index()
    {
        return $this->render('front/index.html.twig');
    }


}
