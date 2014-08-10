<?php
namespace PMS\Bundle\AddressingBundle\Form\Type;

class CountryFormType extends \Symfony\Component\Form\AbstractType
{
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'label' => 'country',
                'class' => 'PMSAddressingBundle:Country',
                'random_id' => true,
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'configs' => array(
                    'allowClear' => true,
                    'placeholder'   => 'choose a country'
                ),
                'empty_value' => '',
                'empty_data'  => null
            )
        );
    }

    public function getParent()
    {
        return 'genemu_jqueryselect2_translatable_entity';
    }

    public function getName()
    {
        return 'country';
    }
}
