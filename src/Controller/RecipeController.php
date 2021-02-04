<?php

namespace App\Controller;

use App\Entity\Complexity;
use App\Entity\Recipe;
use App\Entity\RecipeType;
use App\Repository\ComplexityRepository;
use App\Repository\RecipeRepository;
use App\Repository\RecipeTypeRepository;
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


    /**
     * @Route(
     *     "/{id}",
     *     name="show",
     *     methods={"GET"},
     *     requirements={"id"="^\d+$"},
     * )
     * @param Recipe $recipe
     * @return Response
     */
    public function show(Recipe $recipe, RecipeTypeRepository $recipeTypeRepository, ComplexityRepository $complexityRepository): Response
    {
        $recipeTypes = $this->getDoctrine()->getRepository(RecipeType::class)->findAll();
        $complexities = $this->getDoctrine()->getRepository(Complexity::class)->findAll();
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe, 'recipeTypes' => $recipeTypes, 'complexities'=> $complexities
        ]);
    }

}
