<?php
namespace PMS\Bundle\AddressingBundle\Manager;

class AddressManager
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var ObjectManager
     */
    protected $om;

    /**
     * Constructor
     *
     * @param string $class Entity name
     * @param ObjectManager $om Object manager
     */
    public function __construct($class, \Doctrine\Common\Persistence\ObjectManager $om)
    {
        $metadata = $om->getClassMetadata($class);

        $this->class = $metadata->getName();
        $this->om = $om;
    }

    /**
     * Returns an empty address instance
     *
     * @return AbstractAddress
     */
    public function createAddress()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * Updates an address
     *
     * @param AbstractAddress $address
     * @param bool $flush   Whether to flush the changes (default true)
     * @throws \RuntimeException
     */
    public function updateAddress(\PMS\Bundle\AddressBundle\Entity\AbstractAddress $address, $flush = true)
    {
        $this->getStorageManager()->persist($address);
        if ($flush) {
            $this->getStorageManager()->flush();
        }
    }

    /**
     * Deletes an address
     *
     * @param AbstractAddress $address
     */
    public function deleteAddress(\PMS\Bundle\AddressBundle\Entity\AbstractAddress $address)
    {
        $this->getStorageManager()->remove($address);
        $this->getStorageManager()->flush();
    }

    /**
     * Finds one address by the given criteria
     *
     * @param array $criteria
     * @return AbstractAddress
     */
    public function findAddressBy(array $criteria)
    {
        return $this->getRepository()->findOneBy($criteria);
    }

    /**
     * Reloads an address
     *
     * @param AbstractAddress $address
     */
    public function reloadAddress(\PMS\Bundle\AddressBundle\Entity\AbstractAddress $address)
    {
        $this->getStorageManager()->refresh($address);
    }

    /**
     * Returns the address's fully qualified class name.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Return related repository
     *
     * @return ObjectRepository
     */
    public function getRepository()
    {
        return $this->getStorageManager()->getRepository($this->getClass());
    }

    /**
     * Retrieve object manager
     *
     * @return ObjectManager
     */
    public function getStorageManager()
    {
        return $this->om;
    }
}
