<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, [
                'attr' => [
                    'placeholder' => 'Pseudo',
                ]])
            ->add('email', EmailType::class, [
            'attr' => [
                'placeholder' => 'Mail',
            ]])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Mot de passe'],
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Répéter votre mot de passe'],
                ],
                'invalid_message' => 'Les mots de passe doivent être identiques',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Mot de passe',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Regex([
                        'pattern' => "/\d/",
                        "message" => "Le mot de passe doit contenir au moins un chiffre",
                    ]),
                    new Regex([
                        'pattern' => "/[A-Z]/",
                        "message" => "Le mot de passe doit contenir au moins une majuscule",
                    ]),
                    new Regex([
                        'pattern' => "/[a-z]/",
                        "message" => "Le mot de passe doit contenir au moins une minuscule",
                    ]),
                    new Regex([
                        'pattern' => "/\s/",
                        "message" => "Le mot de passe ne doit pas contenir d'espace",
                        "match" => false,
                    ])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => "Accepter les CGU",
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les CGU.',
                    ]),
                ],
                'attr' => [
                    'class' => 'demo2',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
