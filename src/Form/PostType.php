<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Choisir une image de couverture',
                'required' => false,
                'allow_delete' => false,
                'delete_label' => '...',
                'download_label' => '...',
                'download_uri' => false,
                'image_uri' => false,
                'imagine_pattern' => '...',
                'asset_helper' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
