<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** @Route(
 *     "/recette",
 *     name="recipe_",
 *     methods={"GET"}
 *     )
 */
class RecipeController extends AbstractController
{
    /** @Route(
     *     "/",
     *     name="all",
     *     methods={"GET"}
     * )
     * @param RecipeRepository $recipeRepository
     */
    public function index(RecipeRepository $recipeRepository): Response
    {
        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findAll();
        return $this->render('recipe/index.html.twig', ['recipes'=>$recipes]);
    }


}
