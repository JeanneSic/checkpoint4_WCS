<?php


namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route ("/profil", name="profil_")
 */
class ProfilController extends AbstractController
{
    /**
     * @Route("/", name="show")
     * @param RecipeRepository $recipeRepository
     * @param Request $request
     * @return Response
     */
    public function index(
        RecipeRepository $recipeRepository,
        Request $request
    ): Response {
        /* @phpstan-ignore-next-line */
        $user = $this->getUser();
        $recipes = $recipeRepository->findBy(
        /* @phpstan-ignore-next-line */
            ['createdBy' => $user->getId()]
        );

        return $this->render('profil/show.html.twig', [
            'recipes' => $recipes
        ]);
    }
}
