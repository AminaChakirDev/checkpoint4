<?php


namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use App\Service\Slugify;


class RecipeFixtures extends Fixture
{

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');
        $slugify = new Slugify();
        for ($i = 0; $i < 6; $i++) {
            $recipeFaker = new Recipe();
            $title = implode(" ", $faker->words($nb = 3, $asText = false));
            $recipeFaker->setRecipeTitle($title);
            $recipeFaker->setRecipePoster($faker->imageUrl(320, 240, 'food'));
            $recipeFaker->setPreparationTime($faker->numberBetween($min = 5, $max = 55));
            $recipeFaker->getCookingTime($faker->numberBetween($min = 5, $max = 55));
            $recipeFaker->setNbParts($faker->numberBetween($min = 1, $max = 12));
            $recipeFaker->setProcess($faker->text($maxNbChars = 500));
            $recipeFaker->setLevel($faker->numberBetween($min = 1, $max = 5));
            $recipeFaker->setOnlineDate($faker->dateTimeThisYear($max = 'now', $timezone = null));
            $recipeFaker->setInstaAccount('@' . $faker->firstName);

            $slug = $slugify->generate($title);
            $recipeFaker->setSlug($slug);

            $manager->persist($recipeFaker);

            $this->addReference('recipe_' . $i, $recipeFaker);
        }

        $manager->flush();
    }
}