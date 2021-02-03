<?php

namespace App\DataFixtures;

use App\Entity\Difficulty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DifficultyFixtures extends Fixture
{
    const LEVEL = [
        "Facile",
        "Moyen",
        "Difficile",
    ];

        public function load(ObjectManager $manager)
    {
        foreach (self::LEVEL as $key => $levelName) {
            $difficulty = new Difficulty();
            $difficulty->setName($levelName);
            $manager->persist($difficulty);
            $this->addReference('difficulty_'.$key, $difficulty);
        }
        $manager->flush();
    }
}
