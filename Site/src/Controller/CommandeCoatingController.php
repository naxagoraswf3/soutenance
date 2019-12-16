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
     * @Route("/form2", name="form2")
     */
    public function newCommandeCoating(Request $request, EntityManagerInterface $manager)
    {
        $commande = new CommandeCoating();

        $form = $this->createForm(CommandeCoatingType::class, $commande);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commande->setCreatedAt(new \DateTime());
            $manager->persist($commande);
            $manager->flush();









            $url = "https://www.google.com/recaptcha/api/siteverify";
            $data = [
                'secret' => "6Lfcj8cUAAAAAJH7eVqz31CzmjcE049pNr8CLKKx",
                'response' => $_POST['token'],
                // 'remoteip' => $_SERVER['REMOTE_ADDR']
            ];
    
            $options = array(
                'http' => array(
                  'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                  'method'  => 'POST',
                  'content' => http_build_query($data)
                )
              );
    
            $context  = stream_context_create($options);
          $response = file_get_contents($url, false, $context);
    
    






            return $this->redirectToRoute("form");
        }
        return $this->render('front/form2.html.twig', [
            "formcoat" => $form->createView(),
            'commandecoat' => $commande
        ]);
    }
}


