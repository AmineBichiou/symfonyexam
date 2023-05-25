<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index( EntityManagerInterface  $entityManager, Request $request): JsonResponse
    {
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->findAll();
        $utilisateur = new Utilisateur();
        $utilisateur->setNom('Article 1');
        $utilisateur->setAdresse('test');
        $utilisateur->setRole('test');
        $entityManager->persist($utilisateur);
        $entityManager->flush();
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UtilisateurController.php',
        ]);
        
    }
    #[Route('/test', name: 'test', methods: ['POST'] ) ]
    public function new(Request $request, EntityManagerInterface $entityManager) {
    $utilisateur = new Utilisateur();
    $form = $this->createForm(UtilisateurType::class,$utilisateur);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    $utilisateur = $form->getData();
    $entityManager->persist($utilisateur);
    $entityManager->flush();
    return $this->redirectToRoute('page');
   
}
return $this->render('new.html.twig',['form' => $form->createView()]);
}
}
