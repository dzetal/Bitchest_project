<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilUserController extends AbstractController
{
    #[Route('/profil/user', name: 'app_profil_user')]
    public function show(): Response
    {
        $user = $this->getUser(); // Récupérer l'utilisateur connecté

        // Afficher les informations du profil dans la vue Twig
        return $this->render('profilUser/show.html.twig', [
            'user' => $user,
        ]);
    }
    #[Route('/profil/user/edit', name: 'app_profil/user_edit')]
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
            return $this->redirectToRoute('app_user_index');
        }

        // Afficher le formulaire dans la vue Twig
        return $this->render('profil/user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
