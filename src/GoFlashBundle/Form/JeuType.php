<?php

namespace GoFlashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class JeuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description',TextType::class, array(
                                'required'=>false,
                                )
            )
            ->add('file', 'file', array('label' => 'Capture modèle',
                                        'attr' => array('accept' => 'image/*',
                                                        'id' => 'capture',
                                                        'capture' => 'camera',
                                                        )
                                        )
            );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GoFlashBundle\Entity\Jeu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'goflashbundle_jeu';
    }


}
