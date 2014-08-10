<?php
namespace PMS\Bundle\AddressingBundle\Form\Handler;

class AddressHandler
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     *
     * @param FormInterface $form
     * @param Request       $request
     * @param ObjectManager $manager
     */
    public function __construct(\Symfony\Component\Form\FormInterface $form, \Symfony\Component\HttpFoundation\Request $request, \Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $this->form    = $form;
        $this->request = $request;
        $this->manager = $manager;
    }

    /**
     * Process form
     *
     * @param AbstractAddress $entity
     * @return bool True on successful processing, false otherwise
     */
    public function process(\PMS\Bundle\AddressingBundle\Entity\AbstractAddress $entity)
    {
        $this->form->setData($entity);

        if (in_array($this->request->getMethod(), array('POST', 'PUT'))) {
            $this->form->submit($this->request);
            if ($this->form->isValid()) {
                $this->onSuccess($entity);

                return true;
            }
        }

        return false;
    }

    /**
     * "Success" form handler
     *
     * @param AbstractAddress $address
     */
    protected function onSuccess(\PMS\Bundle\AddressingBundle\Entity\AbstractAddress $address)
    {
        $this->manager->persist($address);
        $this->manager->flush();
    }
}
