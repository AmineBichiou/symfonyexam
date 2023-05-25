<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Projet;
use App\Form\ProjetType;
use App\Entity\Tache;
use App\Form\TacheType;

class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'app_projet')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProjetController.php',
        ]);
    }
    #[Route('/tester', name: 'tester',methods: ['POST','GET'] ) ]
    public function new(Request $request, EntityManagerInterface $entityManager) {
    $projet = new Projet();
    $form = $this->createForm(ProjetType::class,$projet);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    $projet = $form->getData();
    $entityManager->persist($projet);
    $entityManager->flush();
    return $this->render('page.html.twig',['form' => $form->createView()]);

    }
    return $this->render('page.html.twig',['form' => $form->createView()]);
    
    
}


 
   
}
