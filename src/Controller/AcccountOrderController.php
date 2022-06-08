<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcccountOrderController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
         $this->entityManager = $entityManager;
    }
    /**
     * @Route("/compte/mes-commandes", name="app_acccount_order")
     */
    public function index(): Response
    {

        $orders =  $this->entityManager->getRepository(Order::class)->findSuccessOrders($this->getUser());
        return $this->render('acccount/order.html.twig',[
            'orders'=> $orders
        ]);
    }

    /**
     * @Route("/compte/mes-commandes/{id}", name="app_acccount_order_show")
     */
    public function show($id): Response
    {

        $order =  $this->entityManager->getRepository(Order::class)->findOneById($id);
        if (!$order || $order->getUser() !=  $this->getUser()){
            return $this->redirectToRoute('app_acccount_order');
        }

        return $this->render('acccount/show.html.twig',[
            'order'=> $order
        ]);
    }
}
