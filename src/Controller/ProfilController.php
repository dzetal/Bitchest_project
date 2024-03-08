<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ProfilType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class ProfilController extends AbstractController
{

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/profil', name: 'app_profil')]
    public function show(): Response
    {
        $user = $this->getUser(); // Récupérer l'utilisateur connecté

        // Afficher les informations du profil dans la vue Twig
        return $this->render('profil/show.html.twig', [
            'user' => $user,
        ]);
    }
    #[Route('/profil/edit', name: 'app_profil_edit')]
    public function edit(Request $request): Response
    {
        $user = $this->getUser(); // Récupérer l'utilisateur connecté

        // Créer un formulaire pour modifier le profil de l'utilisateur
        $form = $this->createForm(ProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $file = $form->get('ProfilPicture')->getData();

            // if ($file) {
            //     // Génération d'un nom unique pour le fichier
            //     $fileName = uniqid().'.'.$file->guessExtension();
    
            //     // Déplacement du fichier dans le répertoire de destination
            //     $file->move(
            //         $this->getParameter('profil_picture_directory'), // Répertoire de destination (défini dans services.yaml)
            //         $fileName
            //     );
    
            //     // Mise à jour du chemin de l'image dans l'entité User
            //     $user->setProfilPicture($fileName);
            // }

            // Enregistrer les modifications dans la base de données
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // Rediriger l'utilisateur vers la page de profil
            return $this->redirectToRoute('app_admin_index');
        }

        // Afficher le formulaire dans la vue Twig
        return $this->render('profil/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
