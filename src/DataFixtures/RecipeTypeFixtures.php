<?php


namespace App\DataFixtures;

use App\Entity\RecipeType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeTypeFixtures extends Fixture
{
    const TYPE = [
        "Petit-déjeuner",
        "Apéritif",
        "Accompagnement",
        "Dessert",
        "Entrée",
        "Plat principal"
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TYPE as $key => $recipeTypeName) {
            $recipeType = new RecipeType();
            $recipeType->setName($recipeTypeName);
            $manager->persist($recipeType);
            $this->addReference('recipeType_'.$key, $recipeType);
        }
        $manager->flush();
    }


}
