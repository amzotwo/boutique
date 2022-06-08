<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Header;
use App\Entity\Produits;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController

{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="app_home")
     */
    public function index()
    {
       // $mail = new Mail();
    //    $mail->sendMail('sonedafrique@gmail.com','Amadou Moussa SENGHOR','1er envoie',"Bonjour Amadou, j'espere que tu vas bien");

        $Produits = $this->entityManager->getRepository(Produits::class)->findByIsBest(1);
        $Headers = $this->entityManager->getRepository(Header::class)->findAll();

        return $this->render('home/index.html.twig', [
            'Produits'=> $Produits,
            'headers'=> $Headers
        ]);
    }
}
