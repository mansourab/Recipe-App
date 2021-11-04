<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="app_home")
     */
    public function index(RecipeRepository $recipeRepository)
    {
        $recipes = $recipeRepository->homeRecipes();

        return $this->render('home/index.html.twig', [
            'recipes' => $recipes
        ]);
    }

    /**
     * @Route("/recipe", name="recipe_index")
     */
    public function recipe()
    {
        return $this->render('home/recipe.html.twig');
    }

    /**
     * @Route("/search", name="search_index")
     */
    public function search()
    {
        return $this->render('home/search.html.twig');
    }
}