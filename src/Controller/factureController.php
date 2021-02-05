<?php
namespace App\Controller;
use App\Form\FactureType ;
use App\Entity\Facture;
use App\Form\ClientType;
use App\Entity\Client;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route ;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class factureController extends AbstractController {
/**
 * @Route("/afficherfacture" , name="afficherfacture")
 */
public function index():Response
{
    

$factures= $this->getDoctrine()->getRepository(Facture::class)->findAll();

return $this->render('indexfacture1.html.twig' ,[
    'factures'=> $factures,
   

    
]);
}
/**
 *@Route("/ajoutercfacture" , name="ajouterfacture") 
 */
public function Ajouterfacture (Request $request):Response
{
    $facture = new Facture();
    $form = $this->createForm(FactureType::class,$facture);
    $form->handleRequest($request);

    if($form->isSubmitted()){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($facture);
        $entityManager->flush();
        $this->addFlash('notice','Facture Ajouter!');

return  $this->redirectToRoute('afficherfacture');
    }
    return $this->render('ajouterfr.html.twig',[
        'form' => $form->createView()
    ]);

}
  



/**
     * @Route("/payerfacture/{montant}", name="payerfacture")
     */   
    public function payerfacture ( int $montant , Request $request): Response
    { 
        $factures = $this->getDoctrine()->getRepository(Facture::class)->findBy(array('montant'=> $montant));
        $facture= $factures[0];
        $form = $this-> createForm(FactureType::class ,$facture);
        $facture->setPayee(1);   
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($facture);
            $entityManager->flush();
            $this->addFlash('notice','Facture Payer!');

            return $this->redirectToRoute('afficherfacture');
   
    }

    /**
 * @Route("/statiquefacture" , name="statiquefacture")
 */
public function statiquefacture():Response
{
    
    $factures =$this->getDoctrine()->getRepository(Facture::class)->findAll();
    return $this->render('statiquefacture.html.twig', [
        'factures'=> $factures,
        ]);
}
}

    

?>