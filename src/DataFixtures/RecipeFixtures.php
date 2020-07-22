<?php


namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;


class RecipeFixtures extends Fixture
{

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 6; $i++) {
            $recipeFaker = new Recipe();
            $recipeFaker->setRecipeTitle($faker->word);
            $recipeFaker->setRecipePoster($faker->imageUrl(320, 240, 'food'));
            $recipeFaker->setPreparationTime($faker->numberBetween($min = 5, $max = 55));
            $recipeFaker->getCookingTime($faker->numberBetween($min = 5, $max = 55));
            $recipeFaker->setNbParts($faker->numberBetween($min = 1, $max = 12));
            $recipeFaker->setProcess($faker->text($maxNbChars = 500));
            $recipeFaker->setLevel($faker->numberBetween($min = 1, $max = 5));
            $recipeFaker->setOnlineDate($faker->dateTimeThisYear($max = 'now', $timezone = null));
            $recipeFaker->setInstaAccount('@' . $faker->firstName);

            $manager->persist($recipeFaker);

            $this->addReference('recipe_' . $i, $recipeFaker);
        }

        $manager->flush();
    }
}