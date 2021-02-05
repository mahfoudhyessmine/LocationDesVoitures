<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\VoitureType;
use App\Entity\Voiture;
use App\Form\AgenceType;
use App\Entity\Agence;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
class voiturecontroller extends AbstractController
{
    /**
     * @Route("/" )
     */   
    public function index(): Response
    { 
        return $this->render('base.html.twig');
    }

     /**
     * @Route("/ajoutvoiture" , name="ajoutvoiture")
     */
    public function ajoutervoiture(Request $request  ): Response
    {
        
        $voiture=new Voiture();
        $form =$this->createForm(VoitureType::class,$voiture);

        $form->handleRequest($request);
        if ($form->isSubmitted())
        {

$entityManager=$this->getDoctrine()->getManager();
$entityManager->persist($voiture);
$entityManager->flush();
$this->addFlash('notice','voiture ajouter');
return $this->redirectToRoute('voiture');



        }
        return $this->render('ajouter.html.twig', [
             'form' => $form ->createView()
             ]);
    }

    /**
     * @Route("/voiture" , name="voiture")
     */
    public function affichevoiture(): Response
    {
        
       $voitures=$this->getDoctrine()->getRepository(Voiture::class)->findAll();

       
        return $this->render('index.html.twig', [
             'voitures'=> $voitures,
             ]);

}

 /**
     * @Route("/voiture1" , name="voiture1")
     */
    public function affichevoi(): Response
    {
        
       $voitures=$this->getDoctrine()->getRepository(Voiture::class)->findAll();

       
        return $this->render('index1.html.twig', [
             'voitures'=> $voitures,
             ]);

}

 /**
     * @Route("/modifiervoiture/{mat}", name="modifiervoiture")
     */   
    public function modifieer(String $mat , Request $request): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findBy(array('Matricule'=> $mat));
        if(!$voitures){
            throw $this->createNotFoundException('pas de voiture avec la Matricule'  .$mat);}
            $voiture= $voitures[0];
            $form = $this-> createForm(VoitureType::class ,$voiture);
            $form ->handleRequest($request);
            if($form->isSubmitted()){
              
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($voiture);
                $entityManager->flush();
                $this->addFlash('notice','voiture modifier!');
                return $this->redirectToRoute('voiture');}
               
                return $this->render('modifier.html.twig', [ 'form'  =>$form->createView()]);
   
    }

    /**
     * @Route("/supprimervoiture/{mat}", name="supprimervoiture")
     */   
    public function supprimer (String $mat): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $voiture = $this->getDoctrine()->getRepository(Voiture::class)->findBy(array('Matricule'=> $mat));
        if(!$voiture){
            throw $this->createNotFoundException('pas de voiture avec la Matricule'  .$mat);}
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($voiture[0]);
                $entityManager->flush();
                $this->addFlash('notice','voiture supprimer!');

                return $this->redirectToRoute('voiture');
    }
     /**
     * @Route("/louervoiture/{mat}", name="louervoiture")
     */   
    public function louervoiture (String $mat , Request $request): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findBy(array('Matricule'=> $mat));
        $voiture= $voitures[0];
        $form = $this-> createForm(VoitureType::class ,$voiture);
        $voiture->setDisponiibilite(1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voiture);
            $entityManager->flush();
            $this->addFlash('notice','voiture louer! ');

            return $this->redirectToRoute('voiture1');     
        
    
   
    }

    /**
     * @Route("/rendrevoiture/{mat}", name="rendrevoiture")
     */   
    public function rendrevoiture (String $mat , Request $request): Response
    {   
        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findBy(array('Matricule'=> $mat));
        $voiture= $voitures[0];
        $form = $this-> createForm(VoitureType::class ,$voiture);
        $voiture->setDisponiibilite(0);   
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voiture);
            $entityManager->flush();
            $this->addFlash('notice','voiture rendu! ');
            return $this->redirectToRoute('voiture1');
       
    
   
    }
    /**
 * @Route("/statiquevoiture" , name="statiquevoiture")
 */
public function statiquevoiture():Response
{
    
    $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findAll();
    return $this->render('affichestatistique.html.twig', [
        'voitures'=> $voitures,
        ]);
}

}

?>