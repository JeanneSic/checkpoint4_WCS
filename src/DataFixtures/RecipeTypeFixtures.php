<?php


namespace App\DataFixtures;

use App\Entity\RecipeType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeTypeFixtures extends Fixture
{
    const TYPES = [
        [
            'name' => 'Petit-déjeuner',
            'slug' => 'petit-dejeuner'
        ],
        [
            'name' => 'Apéritif',
            'slug' => 'aperitif'
        ],
        [
            'name' => 'Accompagnement',
            'slug' => 'accompagnement'
        ],
        [
            'name' => 'Dessert',
            'slug' => 'dessert'
        ],
        [
            'name' => 'Entrée',
            'slug' => 'entree'
        ],
        [
            'name' => 'Plat principal',
            'slug' => 'plat-principal'
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TYPES as $key => $recipeTypeCategory) {
            $recipeType = new RecipeType();
            $recipeType->setName($recipeTypeCategory['name']);
            $recipeType->setSlug($recipeTypeCategory['slug']);
            $manager->persist($recipeType);
            $this->addReference('recipeType_'.$key, $recipeType);
        }

        $manager->flush();
    }


}
