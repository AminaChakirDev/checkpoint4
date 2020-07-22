<?php

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('RecipeTitle')
            ->add('RecipePoster')
            ->add('PreparationTime')
            ->add('CookingTime')
            ->add('NbParts')
            ->add('Process')
            ->add('OnlineDate')
            ->add('Level')
            ->add('InstaAccount')
            ->add('Slug')
            ->add('Types')
            ->add('Ingredients')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
