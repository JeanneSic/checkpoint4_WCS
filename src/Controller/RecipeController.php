<?php

namespace App\Controller;

use App\Entity\Complexity;
use App\Entity\Recipe;
use App\Entity\RecipeType;
use App\Form\NewRecipeType;
use Symfony\Component\Form\FormTypeInterface;
use App\Repository\ComplexityRepository;
use App\Repository\RecipeRepository;
use App\Repository\RecipeTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

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
        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findBy([],['created_at' => 'desc']);
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
    public function show(
        Recipe $recipe,
        RecipeTypeRepository $recipeTypeRepository,
        ComplexityRepository $complexityRepository
    ): Response
    {
        $recipeTypes = $this->getDoctrine()->getRepository(RecipeType::class)->findAll();
        $complexities = $this->getDoctrine()->getRepository(Complexity::class)->findAll();
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe, 'recipeTypes' => $recipeTypes, 'complexities'=> $complexities
        ]);
    }

    /**
     * @Route(
     *     "/nouveau",
     *     name="new",
     *     methods={"GET", "POST"}
     * )
     * @param RecipeRepository $recipeRepository
     * @param RecipeTypeRepository $recipeTypeRepository
     * @param ComplexityRepository $complexityRepository
     * @param Request $request
     * @return Response
     */
    public function new(
        RecipeRepository $recipeRepository,
        RecipeTypeRepository $recipeTypeRepository,
        ComplexityRepository $complexityRepository,
        Request $request
    ): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $recipeTypes = $recipeTypeRepository->findAll();
        $complexities = $complexityRepository->findAll();
        $recipe = new Recipe();
        $form = $this->createForm(NewRecipeType::class, $recipe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $recipe->setCreatedAt(new DateTime());
            $recipe->setUpdatedAt(new DateTime());
            /* @phpstan-ignore-next-line */
            $recipe->setCreatedBy($this->getUser());
            $entityManager->persist($recipe);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "Votre recette a bien été créée !"
            );

            return $this->redirectToRoute('recipe_all');
        }
        return $this->render('recipe/new.html.twig', [
            'form' => $form->createView(),
            'recipeTypes' => $recipeTypes,
            'complexities' => $complexities
        ]);
    }
}
