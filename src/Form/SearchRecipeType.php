<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\RecipeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchRecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('numberOfPerson', IntegerType::class);
            ->add('recipeType',EntityType::class, [
                'placeholder' => 'Tous les types',
                'class' => RecipeType::class,
                'label' => false,
                'choice_label' => 'name',
                'required' => false,
                'choice_value' => function (?RecipeType $recipeType) {
                    return $recipeType ? $recipeType->getName() : '';
                }]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
