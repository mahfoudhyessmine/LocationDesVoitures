<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AgenceType;
use App\Entity\Agence;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;


Class AgenceController extends AbstractController
{


/**
 * @Route("/ajouteagence" , name="ajouteagence")
 */
public function AjouterAgence (Request $request):Response
{
    $agence= new Agence();
    $form =$this->createform(AgenceType::class,$agence);
    $form->handleRequest($request);
    if($form->isSubmitted())
    {
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($agence);
        $entityManager->flush();
        $this->addFlash('notice','Agence Ajouter!');

        return $this->redirectToRoute('agence');
    }

    return $this->render('ajouterag.html.twig', [
        'form'=>$form->createView()
    ]);
}   

/**
 * @Route("/agence" , name="agence")
 */
public function AfficheAgence ():Response
{
    $Agences=$this->getDoctrine()->getRepository(Agence::class)->findAll();
    return $this->render('indexag.html.twig' , [
        'Agences' => $Agences
    ]);
}

  /**
     * @Route("/suppagence/{tel}" , name="suppagence")
     */   
    public function supprimeragence (String $tel): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $Agence = $this->getDoctrine()->getRepository(Agence::class)->findBy(array('tel'=> $tel));
        if(!$Agence){
            throw $this->createNotFoundException('pas de agence avec le telephonr'  .$tel);}
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($Agence[0]);
                $entityManager->flush();
                $this->addFlash('notice','Agence Supprimer!');

                return $this->redirectToRoute('agence');
    }

    /**
     * @Route("/modifieragance/{tel}", name="modifieragance")
     */   
    public function modifieeraence(String $tel , Request $request): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $agences = $this->getDoctrine()->getRepository(Agence::class)->findBy(array('tel'=> $tel));
        if(!$agences){
            throw $this->createNotFoundException('pas de agance avec le tel'  .$tel);}
            $agence= $agences[0];
            $form = $this-> createForm(AgenceType::class ,$agence);
            $form ->handleRequest($request);
            if($form->isSubmitted()){
              
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($agence);
                $entityManager->flush();
                $this->addFlash('notice','Agence Modifier!');

                return $this->redirectToRoute('agence');}
                return $this->render('modifierag.html.twig', [ 'form'  =>$form->createView()]);
   
    }

}
?>