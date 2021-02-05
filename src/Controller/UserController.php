<?php
namespace App\Controller;
use App\Form\ClientType;
use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationFormType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;


Class UserController extends AbstractController
{

  
        /**
         * @Route("/agent" , name="agent")
         */
        public function index():Response
        {
        $users= $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('indexuser.html.twig' ,[
            'users'=> $users
        ]);
        }


/**
 * @Route("/ajouteagent" , name="ajouteagent")
 */
public function Ajouteragent (Request $request , UserPasswordEncoderInterface $passwordEncoder):Response
{
    $user= new User();
    $form =$this->createform(RegistrationFormType::class,$user);
    $form->handleRequest($request);
    if($form->isSubmitted())
    {
        $user->setPassword(
            $passwordEncoder->encodePassword(
                $user,
                $form->get('plainPassword')->getData()
            )
        );


        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        $this->addFlash('notice','Agent Ajouter!');
        return $this->redirectToRoute('agent');
    }

    return $this->render('ajouteragent.html.twig', [
        'form'=>$form->createView()
    ]);
}   


 /**
     * @Route("/supprimeragent/{email}", name="supprimeragent")
     */   
    public function supprimer (String $email): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->findBy(array('email'=> $email));
        if(!$user){
            throw $this->createNotFoundException('pas de agent a supprimer'  .$email);}
    
                
                $entityManager->remove($user[0]);
                $entityManager->flush();
                $this->addFlash('notice','Agent Supprimer!');
                return $this->redirectToRoute('agent');
    }
/**
     * @Route("/modifieragent/{email}", name="modifieragent")
     */   
    public function modifieer(String $email , Request $request , UserPasswordEncoderInterface $passwordEncoder ): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('email'=> $email));
        if(!$users){
            throw $this->createNotFoundException('pas d agent a modifier '  .$email);}
            $user= $users[0];
            $form = $this-> createForm(RegistrationFormType::class ,$user);
            $form ->handleRequest($request);
            if($form->isSubmitted()){

                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
              
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('notice','Agent Modifier!');
                return $this->redirectToRoute('agent');}
                return $this->render('modifieragent.html.twig', [
                     'form'  =>$form->createView()]);
   
    }
 
}
?>