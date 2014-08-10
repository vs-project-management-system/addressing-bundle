<?php

namespace PMS\Bundle\AddressingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

use JMS\Serializer\Annotation as JMS;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

/**
 * Country
 * @ORM\Entity(repositoryClass="\PMS\Bundle\AddressingBundle\Repository\CountryRepository")
 * @ORM\Table(name="country")
 */
class Country implements Translatable
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="iso2_code", type="string", length=2)
     */
    protected $iso2Code;

    /**
     * @var string
     * @ORM\Column(name="iso3_code", type="string", length=3)
     */
    protected $iso3Code;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="PMS\Bundle\AddressingBundle\Entity\Zone",
     *     mappedBy="country",
     *     cascade={"ALL"},
     *     fetch="EXTRA_LAZY"
     * )
     */
    protected $zones;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @param string $iso2Code ISO2 country code
     */
    public function __construct($iso2Code)
    {
        $this->iso2Code = $iso2Code;
        $this->zones  = new ArrayCollection();
    }

    /**
     * Get iso2_code
     * @return string
     */
    public function getIso2Code()
    {
        return $this->iso2Code;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $zones
     * @return $this
     */
    public function setZones($zones)
    {
        $this->zones = $zones;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getZones()
    {
        return $this->zones;
    }

    /**
     * @param Zone $zone
     * @return Country
     */
    public function addZone(Zone $zone)
    {
        if (!$this->zones->contains($zone)) {
            $this->zones->add($zone);
            $zone->setCountry($this);
        }

        return $this;
    }

    /**
     * @param Zone $zone
     * @return Country
     */
    public function removeZone(Zone $zone)
    {
        if ($this->zones->contains($zone)) {
            $this->zones->removeElement($zone);
            $zone->setCountry(null);
        }

        return $this;
    }

    /**
     * Check if country contains zones
     * @return bool
     */
    public function hasZones()
    {
        return count($this->zones) > 0;
    }

    /**
     * Set iso3_code
     * @param  string  $iso3Code
     * @return Country
     */
    public function setIso3Code($iso3Code)
    {
        $this->iso3Code = $iso3Code;

        return $this;
    }

    /**
     * Get iso3_code
     * @return string
     */
    public function getIso3Code()
    {
        return $this->iso3Code;
    }

    /**
     * Set country name
     * @param  string  $name
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get country name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set locale
     * @param string $locale
     * @return Country
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Returns locale code
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getName();
    }
}
