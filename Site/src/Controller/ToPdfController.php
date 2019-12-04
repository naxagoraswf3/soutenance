<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToPdfController extends AbstractController {

	/**
	 * @Route("/pdf", name="pdf")
	 */
	public function index() {
		return $this->topdf();
	}

	public function topdf() {
		// Configure Dompdf according to your needs
		$pdfOptions = new Options();
		$pdfOptions->set('defaultFont', 'Arial');

		// Instantiate Dompdf with our options
		$dompdf = new Dompdf($pdfOptions);

		// Retrieve the HTML generated in our twig file
		$html = $this->renderView('front/index.html.twig', [
			'title' => "Welcome to our PDF Test",
		]);

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
		$pdfFilepath = '../devis/mypdf.pdf';

		// Write file to the desired path
		file_put_contents($pdfFilepath, $output);

		// Send some text response
		return new Response("Votre demmande de devis a bien été transmise");
	}

}
