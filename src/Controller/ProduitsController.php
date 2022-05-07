<?php

namespace App\Controller;

use App\Classe\Search;
use App\Form\SearchType;
use App\Entity\Produits;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/nos-produits", name="app_produits")
     */
    public function index(Request $request)
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class , $search);
        $form->HandleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $Produits = $this->entityManager->getRepository(Produits::class)->findWithSearch($search);
        } else {
            $Produits = $this->entityManager->getRepository(Produits::class)->findAll();
        }

        return $this->render('produits/index.html.twig', [
                'Produits'=> $Produits,
                'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/produit/{slug}", name="app_produit")
     */
    public function show($slug)
    {
        $produit = $this->entityManager->getRepository(Produits::class)->findOneByslug($slug);

        return $this->render('produits/show.html.twig', [
            'produit'=> $produit
        ]);
    }
}
