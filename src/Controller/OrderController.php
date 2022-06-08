<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Carrier;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Form\OrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $entityManger;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManger = $entityManager;
    }



    /**
     * @Route("/commande", name="app_order")
     */
    public function index(Cart $cart, Request $request)
    {

        if(!$this->getUser()->getAdresses()->getValues()){
            return $this->redirectToRoute('app_acccount_adress_add');
        }

        $form = $this->createForm( OrderType::class, null,[
            'user'=> $this->getUser()
        ]);

               return $this->render('order/index.html.twig',[
               'form' =>$form->createView(),
               'cart' =>$cart->getFull()
        ]);
  }

    /**
     * @Route("/commande/recapitulatif", name="app_order_recap", methods={"POST"})
     */

    public function add(Cart $cart, Request $request)
    {

        $form = $this->createForm( OrderType::class, null,[
            'user'=> $this->getUser()
        ]);

        $form->HandleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $date = new \DateTimeImmutable('now');
            $carriers = $form->get('carriers')->getData();
            $delevry = $form->get('adresses')->getData();
            $delevry_content = $delevry->getFirstname().''.$delevry->getLastname();
            $delevry_content .= '<br/>' .$delevry->getPhone();

            if($delevry->getCompany()){
                $delevry_content .= '<br/>' .$delevry->getCompany();
            }
            $delevry_content .= '<br/>' .$delevry->getAdress();
            $delevry_content .= '<br/>' .$delevry->getPostal().' '.$delevry->getCity();
            $delevry_content .= '<br/>' .$delevry->getConutry();

     //     $delevry_content .= '<br/>' .$delevry->getCompany();

            //enregistrer ma commande order()

            $order = new Order();
            $order->setUser($this->getUser());
            $order->setCreatedAt($date);
            $order->setCarrierName($carriers->getName());
            $order->setCarrierPrice($carriers->getPrice());
            $order->setDelevry($delevry_content);
            $order->setIsPaid(0);

            $this->entityManger->persist($order);

            //enregistrer les produits dans orderdetails

            foreach ($cart->getFull() as $produit){
                $orderDetails = new OrderDetails();
                $orderDetails ->setMyOrder($order);
                $orderDetails->setProduct($produit['produit']->getNom());
                $orderDetails->setQuantite($produit['quantite']);
                $orderDetails->setPrice($produit['produit']->getPrice());
                $orderDetails->setTotal($produit['produit']->getPrice() * $produit['quantite']);
                $this->entityManger->persist($orderDetails);
            }
            $this->entityManger->flush();

            return $this->render('order/add.html.twig',[
                'cart' =>$cart->getFull(),
                'carrier' =>$carriers,
                'delevry' =>$delevry_content
            ]);
        }

        return $this->redirectToRoute('app_cart');

    }
}
