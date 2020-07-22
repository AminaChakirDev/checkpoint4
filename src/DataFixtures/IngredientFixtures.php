<?php


namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class IngredientFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [RecipeFixtures::class];
    }

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 6; $i++) {
            $ingredientFaker = new Ingredient();
            $ingredientFaker->setIngredientName($faker->word);
            $ingredientFaker->setIngredientPoster($faker->imageUrl(320, 240, 'food'));

            $manager->persist($ingredientFaker);

            $ingredientFaker->addRecipe($this->getReference('recipe_'. rand(0,5)));
            $this->setReference('ingredient_' . $i, $ingredientFaker);
        }

        $manager->flush();
    }
}