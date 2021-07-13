<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Security;

class CommentType extends AbstractType
{

    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('auteur', TextType::class, [
                'label' => 'Votre Prénom',
                'attr' => [
                    'placeholder' => 'Entrez votre Prénom',
                    'class' => 'form-group form-control'
                ],
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Votre commentaire',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre commentaire'
                ]
            ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => ['class' => 'lift btn btn-success btn-block mt-5 form-control'],
            ]);

        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            if ($this->user !== null) {
                $form->get('auteur')->setData($this->user->getUsername());
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}