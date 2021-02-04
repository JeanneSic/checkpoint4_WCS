<?php

namespace App\Form;

use App\Entity\Complexity;
use App\Entity\Recipe;
use App\Entity\RecipeType;
use App\Repository\ComplexityRepository;
use App\Repository\RecipeTypeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Validator\Constraints\Date;
use Vich\UploaderBundle\Form\Type\VichFileType;

class NewRecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom de la recette',
                ],
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => true,
                'download_label' => false,
                'attr' => [
                    'placeholder' => 'Choisir une image',
                ],
                'help' => 'Ajouter une image pour illustrer votre recette !',
                'allow_delete'  => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
                'asset_helper' => true,
            ])
            ->add('ingredients', TextareaType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Liste des ingrédients et leurs quantités',
                    'rows' => 5
                ],
            ])
            ->add('timeOfPreparation', TimeType::class, [
                'required' => true,
                'widget' => 'choice',
                'input'  => 'datetime',
                'placeholder' => [
                    'hour' => 'Heure',
                    'minute' => 'Minute'
                ],
            ])
            ->add('instruction', TextareaType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Etapes de préparation',
                    'rows' => 8
                ],
            ])
            ->add('kitchenUtensil',TextareaType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Liste des ustensiles nécessaires',
                    'rows' => 5
                ],
            ])
            ->add('numberOfPerson', IntegerType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nombre de parts',
                ],
            ])
            ->add('recipeTypes', EntityType::class, [
                'class' => RecipeType::class,
                'expanded' => false,
                'placeholder' => 'Type de plat',
                'multiple'=> false,
                'required'=> true,
                'choice_label'=> 'name',
                'query_builder' => function (RecipeTypeRepository $recipeTypeRepositoryr) {
                    return $recipeTypeRepositoryr->createQueryBuilder('s')
                        ->orderBy('s.name', 'ASC');
                },
            ])
            ->add('complexity', EntityType::class, [
                'class' => Complexity::class,
                'expanded' => false,
                'multiple'=> false,
                'placeholder' => 'Niveau de difficulté',
                'required'=> true,
                'choice_label'=> 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
