<?php
namespace PMS\Bundle\AddressingBundle\Form\Type;

class AddressCollectionFormType extends \Symfony\Component\Form\AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers(
            array(
                'options' => function (\Symfony\Component\OptionsResolver\Options $options, $options) {
                    if (!$options) {
                        $options = array();
                    }
                    $options['single_form'] = false;
                    return $options;
                }
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'collection';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'address_collection';
    }
}
