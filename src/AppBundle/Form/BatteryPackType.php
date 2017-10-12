<?php

namespace AppBundle\Form;

use AppBundle\Entity\BatteryPack;
use AppBundle\Entity\Enum\BatteryTypeEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BatteryPackType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name')
            ->add('count', NumberType::class)
            ->add('type', ChoiceType::class,
                [
                    'choices' => BatteryTypeEnum::ELEMENTS,
                    'placeholder' => 'select',
                ]
            );

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BatteryPack::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_batterypack';
    }


}
