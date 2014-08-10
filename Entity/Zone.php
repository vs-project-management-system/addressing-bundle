<?php
namespace PMS\Bundle\AddressingBundle\Entity;

use \Doctrine\ORM\Mapping as ORM;
use \Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="\PMS\Bundle\ZoneingBundle\Repository\ZoneRepository")
 * @ORM\Table(name="zone")
 */
class Zone
{
    const SEPARATOR = '-';

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="combined_code", type="string", length=16)
     */
    protected $combinedCode;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="zones", cascade={"persist"})
     * @ORM\JoinColumn(name="country_code", referencedColumnName="iso2_code")
     */
    protected $country;

    /**
     * @var string
     * @ORM\Column(name="code", type="string", length=32)
     */
    protected $code;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @param string $combinedCode
     */
    public function __construct($combinedCode)
    {
        $this->combinedCode = $combinedCode;
    }

    /**
     * @param string $combinedCode
     * @return $this
     */
    public function setCombinedCode($combinedCode)
    {
        $this->combinedCode = $combinedCode;

        return $this;
    }

    /**
     * Get id
     * @return integer
     */
    public function getCombinedCode()
    {
        return $this->combinedCode;
    }

    /**
     * Set country
     * @param  Country $country
     * @return Zone
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
     * Get country ISO2 code
     * @return Country
     */
    public function getCountryIso2Code()
    {
        return $this->country ? $this->country->getIso2Code() : null;
    }

    /**
     * Set code
     * @param  string $code
     * @return Zone
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     * @param  string $name
     * @return Zone
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set locale
     * @param string $locale
     * @return Zone
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

    /**
     * Get combined zone code.
     * @param string $country Country ISO2 code
     * @param string $zone Zone ISO2 code
     * @return string
     */
    public static function getZoneCombinedCode($country, $zone)
    {
        return $country . self::SEPARATOR . $zone;
    }
}
