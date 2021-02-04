<?php

namespace App\Controller;

use App\Entity\Complexity;
use App\Entity\Recipe;
use App\Entity\RecipeSearch;
use App\Entity\RecipeType;
use App\Form\NewRecipeType;
use App\Repository\ComplexityRepository;
use App\Repository\RecipeRepository;
use App\Repository\RecipeTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;
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
     *     methods={"GET", "POST"}
     * )
     * @param PaginatorInterface $paginator
     * @param RecipeRepository $recipeRepository
     * @param RecipeTypeRepository $recipeTypeRepository
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, RecipeRepository $recipeRepository, RecipeTypeRepository $recipeTypeRepository, Request $request): Response
    {
        $queryBuilder = $recipeRepository->findBy([], ['created_at' => 'desc']);
        $types = $recipeTypeRepository->findAll();
        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            32 /*limit per page*/
        );
//        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findBy([],['created_at' => 'desc']);
        return $this->render('recipe/index.html.twig', [
            'pagination' => $pagination,
            'types' => $types
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


    /**
     * @Route(
     *     "/{slug}",
     *     name="type",
     *     methods={"GET"},
     *     requirements={"slug"="^[a-z-]+$"},
     * )
     * @param RecipeRepository $recipeRepository
     * @param Request $request
     * @param RecipeType $recipeType
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function recipeByType(
        RecipeRepository $recipeRepository,
        Request $request,
        RecipeType $recipeType,
        PaginatorInterface $paginator
    ): Response
    {
        $queryBuilder = $recipeRepository->findByType($recipeType->getSlug());
        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );
        return $this->render('recipe/index.html.twig', [
            'pagination' => $pagination,
            'recipeType' => $recipeType,
        ]);
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
            'recipe' => $recipe, 'recipeTypes' => $recipeTypes, 'complexities' => $complexities
        ]);
    }

}
