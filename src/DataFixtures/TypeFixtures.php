<?php


namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class TypeFixtures extends Fixture
{
    const TYPES= [
        'Petit-Déjeuner',
        'Déjeuner',
        'Goûter',
        'Diner',
        'Healthy',
        'Réception',
        'Sans gluten',
        'Végétarien',
        'Kid Cooks'
    ];

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        foreach (self::TYPES as $key => $typeName){
            $type = new Type();
            $type->setTypeName($typeName);

            $manager->persist($type);

            $type->addRecipe($this->getReference('recipe_'. rand(0,5)));
            $this->setReference('type_' . $key, $type);
        }

        $manager->flush();
    }
}