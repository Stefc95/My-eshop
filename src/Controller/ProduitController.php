<?php

namespace App\Controller;

use DateTime;
use App\Entity\Produit;
use App\Form\ProduitFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProduitController extends AbstractController
{
    /**
     * @Route("/voir-les-produits", name="show_produits", methods={"GET"})
     */
    public function showProduits(EntityManagerInterface $entityManager): Response
    {
        # Grâce à l'entityManager, récupérez tous les produits et envoyez les à la vue twig : show_produits.html.twig
        return $this->render("admin/produit/show_produits.html.twig", [
           'produits' => $entityManager->getRepository(Produit::class)->findAll()
        ]);
    }

    /**
     * @Route("/ajouter-un-produit", name="create_produit", methods={"GET|POST"})
     */
    public function createProduit(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $produit = new Produit();

        $form = $this->createForm(ProduitFormType::class, $produit)
            ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
           $produit->setCreatedAt(new DateTime());
           $produit->setUpdatedAt(new DateTime());

           $photo = $form->get('photo')->getData();

            # 1 Deconstruire le nom du fichier
            # 2 Variabiliser tous les éléments du nouveau nom de fichier après sécurisation 
            # 3 Reconstruire le nom du fichier
            # 4 Déplacement du fichier temporaire dans un dossier permanent dans notre projet.

        }

        return $this->render("admin/form/form_produit.html.twig", [
            'form' => $form->createView()
        ]);
    }
}
