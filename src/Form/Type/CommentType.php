<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for handling Comment entity.
 */
class CommentType extends AbstractType
{
    /**
     * Builds the comment form.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array $options The options for the form
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => false,
                'attr' => ['maxlength' => 64],
            ])
            ->add('nickname', TextType::class, [
                'required' => false,
                'attr' => ['maxlength' => 64],
            ])
            ->add('content', TextareaType::class, [
                'required' => false,
            ]);
    }

    /**
     * Configures the options for the comment form.
     *
     * @param OptionsResolver $resolver The resolver for form options
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
