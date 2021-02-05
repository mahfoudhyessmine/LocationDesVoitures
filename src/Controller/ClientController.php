<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ClientType;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;


Class ClientController extends AbstractController
{


/**
 * @Route("/ajouteclient" , name="ajouteclient")
 */
public function Ajouterclient (Request $request):Response
{
    $client= new Client();
    $form =$this->createform(ClientType::class,$client);
    $form->handleRequest($request);
    if($form->isSubmitted())
    {
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($client);
        $entityManager->flush();
        $this->addFlash('notice','Client Ajouter!');
        return $this->redirectToRoute('client');
    }

    return $this->render('ajoutercl.html.twig', [
        'form'=>$form->createView()
    ]);
}   

/**
 * @Route("/client" , name="client")
 */
public function Afficheclient ():Response
{
    $Clients=$this->getDoctrine()->getRepository(Client::class)->findAll();
    return $this->render('indexcl.html.twig' , [
        'Clients' => $Clients
    ]);
}

  /**
     * @Route("/suppclient/{n_permi}" , name="suppclient")
     */   
    public function supprimeragence (String $n_permi): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $Client = $this->getDoctrine()->getRepository(Client::class)->findBy(array('n_permi'=> $n_permi));
        if(!$Client){
            throw $this->createNotFoundException('pas de client avec le n_permi'  .$n_permi);}
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($Client[0]);
                $entityManager->flush();
                $this->addFlash('notice','Client Supprimer!');
                return $this->redirectToRoute('client');
    }

    /**
     * @Route("/modifierclient/{n_permi}", name="modifierclient")
     */   
    public function modifieeraence(String $n_permi , Request $request): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $clients = $this->getDoctrine()->getRepository(Client::class)->findBy(array('n_permi'=> $n_permi));
        if(!$clients){
            throw $this->createNotFoundException('pas de agance avec le tel'  .$n_permi);}
            $client= $clients[0];
            $form = $this-> createForm(ClientType::class ,$client);
            $form ->handleRequest($request);
            if($form->isSubmitted()){
              
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($client);
                $entityManager->flush();
                $this->addFlash('notice','Client Modifier!');
                return $this->redirectToRoute('client');}
                return $this->render('modifiercl.html.twig', [ 'form'  =>$form->createView()]);
   
    }

}
?>