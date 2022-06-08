<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\ResetPassword;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/mot-de-passe-oublie", name="app_reset_password")
     */
    public function index(Request $request): Response
    {
        if($this->getUser()){
            return $this->redirectToRoute('app_home');
        }
        if($request->get('email')){
            $user = $this->entityManager->getRepository(User::class)->findOneByEmail($request->get('email'));
           if ($user){

               //enregistrer en base la demande de reset password
               $reset_password = new ResetPassword();
               $reset_password->setUser($user);
               $reset_password->setToken(uniqid());
               $reset_password->setCreatedAt(new \DateTimeImmutable());
               $this->entityManager->persist($reset_password);
               $this->entityManager->flush();

               // envoyer un lien lui permettant de mettre a jour son mot de passe

               $url = $this->generateUrl('update_password',[
                   'token' => $reset_password->getToken()
               ]);

               $mail = new Mail();
               $content = "Bonjour,".$user->getPrenom()."<br/> Vous avez demandé à reinitialiser votre mot de passe sur le site DS TECH.<br/>";
               $content .= "Merci de mettre à jour votre mot de passe en cliquant sur ce <a href='".$url."'>lien</a>.";
           //    $mail->send($user->getEmail(),$user->getPrenom(),'Reinitialiser votre mot de passe',$content);
           }
        }

        return $this->render('reset_password/index.html.twig', [
            'controller_name' => 'ResetPasswordController',
        ]);
    }

    /**
     * @Route("/mot-de-passe-oublie/{token}", name="update_password")
     */
    public function update($token){
        $reset_password = $this->entityManager->getRepository(ResetPassword::class)->findOneByToken($token);
        if(!$reset_password){
            return $this->redirectToRoute('reset_password');
        }else{
             dd($reset_password);
        }
    }

}
