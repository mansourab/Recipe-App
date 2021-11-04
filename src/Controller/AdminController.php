<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeFormType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(RecipeRepository $recipeRepository)
    {
        $recipes = $recipeRepository->findAll();

        return $this->render('admin/recipe/recipes.html.twig', compact('recipes'));
    }


    /**
     * Permet d'ajouter un nouveau plat à la liste
     * @Route("/admin/recipe/new", name="app_recipe_new")
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        $recipe = new Recipe();

        $form = $this->createForm(RecipeFormType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($recipe);
            $em->flush();
        }

        return $this->render('admin/recipe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}