<?php
namespace Siplo\MediaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('videoFile', 'vich_file');
//        $builder->add('VideoName', 'text');
        $builder->add('VideoTitle', 'text');
        $builder->add('thumbnail', 'vich_file');
        $builder->add('country', 'entity', array(
            'class' => 'SiploMediaBundle:Country',
            'choice_label' => 'name',
        ));
        $builder->add('category', 'entity', array(
            'class' => 'SiploMediaBundle:Category',
            'choice_label' => 'title',
        ));
        $builder->add('upload', 'submit');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Siplo\MediaBundle\Entity\Video'
        ));
    }

    public function getName()
    {
        return 'siplo_mediabundle_video';
    }
}