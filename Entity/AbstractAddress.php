<?php
namespace PMS\Bundle\AddressingBundle\Entity;

use \Doctrine\Common\Util\ClassUtils;
use \Doctrine\ORM\Mapping as ORM;

/**
 * Address
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 */
abstract class AbstractAddress implements \PMS\Component\Address\Interfaces\AddressInterface
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="label", type="string", length=255, nullable=true)
     */
    protected $label;

    /**
     * @var string
     * @ORM\Column(name="street", type="string", length=500, nullable=true)
     */
    protected $street;

    /**
     * @var string
     * @ORM\Column(name="suburb", type="string", length=500, nullable=true)
     */
    protected $suburb;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @var string
     * @ORM\Column(name="postal_code", type="string", length=20, nullable=true)
     */
    protected $postalCode;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="\PMS\Bundle\AddressingBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_code", referencedColumnName="iso2_code")
     */
    protected $country;

    /**
     * @var Region
     * @ORM\ManyToOne(targetEntity="\PMS\Bundle\AddressingBundle\Entity\Region")
     * @ORM\JoinColumn(name="region_code", referencedColumnName="combined_code")
     */
    protected $region;

    /**
     * @var string
     * @ORM\Column(name="name_prefix", type="string", length=255, nullable=true)
     */
    protected $namePrefix;

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(name="middle_name", type="string", length=255, nullable=true)
     */
    protected $middleName;

    /**
     * @var string
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    protected $lastName;

    /**
     * @var string
     * @ORM\Column(name="name_suffix", type="string", length=255, nullable=true)
     */
    protected $nameSuffix;

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     * @param int $id
     * @return AbstractAddress
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return AbstractAddress
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set street
     * @param string $street
     * @return AbstractAddress
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set suburb
     * @param string $suburb
     * @return AbstractAddress
     */
    public function setSuburb($suburb)
    {
        $this->suburb = $suburb;

        return $this;
    }

    /**
     * Get suburb
     * @return string
     */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
     * Set city
     * @param string $city
     * @return AbstractAddress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set region
     * @param Region $region
     * @return AbstractAddress
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     * @return Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Get name of region
     * @return string
     */
    public function getRegionName()
    {
        return $this->getRegion()->getName();
    }

    /**
     * Get code of region
     * @return string
     */
    public function getRegionCode()
    {
        return $this->getRegion() ? $this->getRegion()->getCode() : '';
    }

    /**
     * Set postal_code
     * @param string $postalCode
     * @return AbstractAddress
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postal_code
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set country
     * @param Country $country
     * @return AbstractAddress
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get name of country
     * @return string
     */
    public function getCountryName()
    {
        return $this->getCountry() ? $this->getCountry()->getName() : '';
    }

    /**
     * Get country ISO3 code
     * @return string
     */
    public function getCountryIso3()
    {
        return $this->getCountry() ? $this->getCountry()->getIso3Code() : '';
    }

    /**
     * Get country ISO2 code
     * @return string
     */
    public function getCountryIso2()
    {
        return $this->getCountry() ? $this->getCountry()->getIso2Code() : '';
    }

    /**

     * Set name prefix
     * @param string $namePrefix
     * @return AbstractAddress
     */
    public function setNamePrefix($namePrefix)
    {
        $this->namePrefix = $namePrefix;

        return $this;
    }

    /**
     * Get name prefix
     * @return string
     */
    public function getNamePrefix()
    {
        return $this->namePrefix;
    }

    /**

     * Set first name
     * @param string $firstName
     * @return AbstractAddress
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get first name
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**

     * Set middle name
     * @param string $middleName
     * @return AbstractAddress
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get middle name
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set last name
     * @param string $lastName
     * @return AbstractAddress
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get last name
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set name suffix
     * @param string $nameSuffix
     * @return AbstractAddress
     */
    public function setNameSuffix($nameSuffix)
    {
        $this->nameSuffix = $nameSuffix;

        return $this;
    }

    /**
     * Get name suffix
     * @return string
     */
    public function getNameSuffix()
    {
        return $this->nameSuffix;
    }

    /**
     * Is region valid
     * @param \Symfony\Component\Validator\ExecutionContext $context
     */
    public function isRegionValid(\Symfony\Component\Validator\ExecutionContext $context)
    {
        if ($this->getCountry() && $this->getCountry()->hasRegions() && !$this->region) {
            $propertyPath = $context->getPropertyPath() . '.region';
            $context->addViolationAt(
                $propertyPath,
                'Region is required for country %country%',
                array('%country%' => $this->getCountry()->getName())
            );
        }
    }

    /**
     * Convert address to string
     * @todo: Address format must be used here
     * @return string
     */
    public function __toString()
    {
        $data = array(
            $this->getFirstName(),
            $this->getLastName(),
            ',',
            $this->getStreet(),
            $this->getSuburb(),
            $this->getCity(),
            $this->getUniversalRegion(),
            ',',
            $this->getCountry(),
            $this->getPostalCode(),
        );

        $str = implode(' ', $data);
        $check = trim(str_replace(',', '', $str));
        return empty($check) ? '' : $str;
    }

    /**
     * Check if entity is empty.
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->label)
            && empty($this->firstName)
            && empty($this->lastName)
            && empty($this->street)
            && empty($this->suburb)
            && empty($this->city)
            && empty($this->region)
            && empty($this->country)
            && empty($this->postalCode);
    }

    /**
     * @param mixed $other
     * @return bool
     */
    public function isEqual($other)
    {
        $class = ClassUtils::getClass($this);

        if (!$other instanceof $class) {
            return false;
        }

        /** @var AbstractAddress $other */
        if ($this->getId() && $other->getId()) {
            return $this->getId() == $other->getId();
        }

        if ($this->getId() || $other->getId()) {
            return false;
        }

        return $this === $other;
    }
}
