<?php
namespace PMS\Bundle\AddressingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

use \PMS\Bundle\CoreBundle\Traits\SluggableTrait;
use \PMS\Bundle\CoreBundle\Traits\GeolocatableTrait;
use \PMS\Bundle\CoreBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity(repositoryClass="\PMS\Bundle\AddressingBundle\Repository\AddressRepository")
 * @ORM\Table(name="address_book")
 */
class Address extends \PMS\Bundle\AddressingBundle\Entity\AbstractAddress
{
    use GeolocatableTrait;
    use TimestampableTrait;
    use SluggableTrait;

    /**
     * Formats an address in an array form
     *
     * @param array  $address The address array (required keys: firstname, lastname, address1, postcode, city, country_code)
     * @param string $sep     The address separator
     *
     * @return string
     */
    public static function formatAddress(array $address, $sep = ", ")
    {
        $values = array_map(
            'trim',
            array(
                sprintf("%s %s", $address['first_name'], $address['last_name']),
                $address['address'],
                $address['postal_code'],
                $address['city']
            )
        );

        foreach ($values as $key => $val) {
            if (!$val) {
                unset($values[$key]);
            }
        }

        $fullAddress = implode($sep, $values);

        if ($countryCode = trim($address['country_code'])) {
            if ($fullAddress) {
                $fullAddress .= " ";
            }

            $fullAddress .= sprintf("(%s)", $countryCode);
        }

        return $fullAddress;
    }
}
