<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class RecipeController extends AbstractController
{

    /**
     * @Route("/recipe/search", name="recipe_search")
     */
    public function index(RecipeRepository $recipeRepository)
    {
        $recipes = $recipeRepository->searchRecipes();

        return $this->render('recipe/search.html.twig', compact('recipes'));
    }

    /**
     * Permet d'afficher un repas en particulier.
     * 
     * @Route("/recipe/{slug}", name="recipe_show")
     */
    public function show(Recipe $recipe)
    {
        return $this->render('recipe/show.html.twig', compact('recipe'));
    }

}