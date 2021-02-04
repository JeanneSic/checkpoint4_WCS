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
    const IMAGE = [
        'meal.jpg',
        'meal2.jpg',
        'meal4.jpg',
        'meal5.jpg',
        'meal7.jpg',
    ];

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');
        foreach (self::IMAGE as $key => $image) {
            for ($i = 0; $i < 5; $i++) {
                $dateCreation = (new DateTime())->modify('- ' . rand(0, 30) . 'days');
                $timeOfPrep = (new DateTime())->modify('-' . rand(0, 6) . 'heures');
                $recipe = new Recipe();

                $recipe
                    ->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true))
                    ->setCreatedAt($dateCreation)
                    ->setUpdatedAt($dateCreation)
                    ->setIngredients($faker->text(100))
                    ->setKitchenUtensil($faker->text(20))
                    ->setInstruction($faker->text(200))
                    ->setNumberOfPerson(rand(1, 10))
                    ->setTimeOfPreparation($timeOfPrep)
                    ->setCreatedBy($this->getReference('user'))
                    ->setComplexity($this->getReference('difficulty_' . rand(0, 2)))
                    ->setRecipeTypes($this->getReference('recipeType_' . rand(0, 5)));
                $recipe->setImage($image);
                $manager->persist($recipe);
                $i++;
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [RecipeTypeFixtures::class];
    }


}
