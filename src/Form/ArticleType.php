<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\DataTransformer\ChoicesToValuesTransformer;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Donnez un titre a votre article',
                    'class' => 'form-group form-control'
                ],
            ])
            // ->add('mainPicture', UrlType::class, [
            //     'label' => 'Image principale',
            //     'attr' => [
            //         'placeholder' => 'Image à la une',
            //         'class' => 'form-group form-control'
            //     ]
            // ])
            ->add('articleFile', VichFileType::class, [
                'attr' => [
                    'class' => 'form-group form-control mt-4'
                ],
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'class' => 'form-control mb-4',
                    'placeholder' => 'Contenu dre votre article'
                ]
            ])
            // ->add('dateCreation', null, [
            //     'widget' => 'single_text'
            // ])
            ->add('update_at', null, [
                'label' => 'Modifié le: ',
                'widget' => 'single_text'
            ])
            // ->add('slug')
            ->add('auteur', TextType::class, [
                'label' => 'Auteur',
                'attr' => [
                    'placeholder' => 'Auteur de l\'article',
                    'class' => 'form-group form-control'
                ],
            ])

            ->add('Envoyer', SubmitType::class, [
                'label' => 'A publier',
                'attr' => ['class' => 'lift btn btn-success form-control mt-5'],
            ])
            ->add('Brouillon', SubmitType::class, [
                'attr' => ['class' => 'lift btn btn-info form-control mt-5'],
            ])
            // ->add('best', CheckboxType::class, [
            //     'label' => 'Article à la une',
            //     'required' => false,
            //     'attr' => [
            //         'class' => 'form-check form-check-input'
            //     ],
            // ])
            // ->add('categories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}