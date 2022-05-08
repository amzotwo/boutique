<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Form\AdressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AcccountAdressController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/compte/adress", name="app_acccount_adress")
     */

    public function index()
    {
        return $this->render('acccount/adress.html.twig');
    }

    /**
     * @Route("/compte/ajouter-une-adresse", name="app_acccount_adress_add")
     */

    public function add(Request $request)
    {
        $adress = new Adress();

        $form = $this->createForm(AdressType::class, $adress);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $adress->setUser($this->getUser());
            $this->entityManager->persist($adress);
            $this->entityManager->flush();

           return $this->redirectToRoute('app_acccount_adress');
        }

        return $this->render('acccount/adress_form.html.twig',[
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/compte/modifier-une-adresse/{id}", name="app_acccount_adress_edit")
     */

    public function edit(Request $request, $id)
    {
        $adress = $this->entityManager->getRepository(Adress::class)->findOneById($id);

        if(!$adress || $adress->getUser() != $this->getUser()){
            return $this->redirectToRoute('app_acccount_adress');
        }

        $form = $this->createForm(AdressType::class, $adress);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->flush();
            return $this->redirectToRoute('app_acccount_adress');
        }

        return $this->render('acccount/adress_form.html.twig',[
            'form' =>$form->createView()
        ]);
    }


    /**
     * @Route("/compte/supprimer-une-adresse/{id}", name="app_acccount_adress_delete")
     */

    public function delete($id)
    {
        $adress = $this->entityManager->getRepository(Adress::class)->findOneById($id);

        if($adress && $adress->getUser() == $this->getUser()){
            $this->entityManager->remove($adress);
            $this->entityManager->flush();
        }
            return $this->redirectToRoute('app_acccount_adress');

    }
}
