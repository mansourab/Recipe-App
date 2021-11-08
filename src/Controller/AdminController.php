<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeFormType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(RecipeRepository $recipeRepository, PaginatorInterface $paginator, Request $request)
    {
        // $recipes = $recipeRepository->findAll();

        $recipes = $paginator->paginate(
            $recipeRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

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

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/recipe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * Permet d'editer un plat en prennant en parametre son slug
     * @Route("admin/recipe/{slug}/edit", name="app_recipe_edit")
     */
    public function edit(Recipe $recipe, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(RecipeFormType::class, $recipe);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/recipe/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Permet de supprimer un plat dans la liste
     * @Route("admin/recipe/delete/{id}", name="app_recipe_delete", methods={"POST"})
     */
    public function delete(Request $request, Recipe $recipe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->request->get('_token'))) {

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->remove($recipe);
            
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }

}