<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i ++) {
            $dateCreation = (new DateTime())->modify('- ' . rand(0, 30) . 'days');
            $timeOfPrep = (new DateTime())->modify('-' . rand(0,6) .'heures');
            $recipe = new Recipe();

            $recipe
                ->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true))
                ->setCreatedAt($dateCreation)
                ->setUpdatedAt($dateCreation)
                ->setImage($faker->imageUrl())
                ->setIngredients($faker->text(100))
                ->setKitchenUtensil($faker->text(20))
                ->setInstruction($faker->text(200))
                ->setNumberOfPerson(rand(1,10))
                ->setTimeOfPreparation($timeOfPrep)
                ->setCreatedBy($this->getReference('user'))
                ->setDifficulty($this->getReference('difficulty_' . rand(0,2)))
                ->setRecipeType($this->getReference('recipeType_' . rand(0,6)));
            $manager->persist($recipe);
            $i++;
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [RecipeTypeFixtures::class];
    }


}
