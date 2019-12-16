<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\CommandeCoating;
use App\Form\CommandeCoatingType;
use App\Form\CommandeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front")
     */
    public function index()
    {
        return $this->render('front/index.html.twig');
    }

    /**
     * @Route("/form", name="form")
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
            return $this->redirectToRoute("form");
        
        
        
        
        


         ////////////// CAPTCHA V3  		
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

       
        
        }
        return $this->render('front/form.html.twig', [
            "form" => $form->createView(),
            'commande' => $commande,
        ]);
    }

      /**
     * @Route("/choice", name="choix")
     */
    public function choice()
    {
        return $this->render('front/select.html.twig');
    }
}
