<?php

namespace Louvre\BookingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class BookingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, array(
                'label' => 'Prénom',
                'attr' => array(
                    'class' => 'form-control')))

            ->add('lastName', TextType::class, array(
                'label' => 'Nom',
                'attr' => array(
                    'class' => 'form-control')))

            ->add('country', CountryType::class, array(
                'label' => 'Pays',
                'attr' => array(
                    'class' => 'form-control'),
                'preferred_choices' => array('FR')))

            ->add('birthdate', BirthdayType::class, array(
                'label' => 'Date d\'anniversaire',
                'format' => 'dd / MM / yyyy',
                'data' => new \DateTime()))
            
            ->add('reducedPrice', CheckboxType::class, array(
                'label' => 'Tarif réduit',
                'required' => false))
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvre\BookingBundle\Entity\Booking'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'louvre_bookingbundle_booking';
    }

}
