<?php
namespace PMS\Bundle\AddressingBundle\Repository;

use \Doctrine\ORM\Query;
use \Doctrine\ORM\QueryBuilder;

use \PMS\Bundle\AddressingBundle\Entity\Zone;

class ZoneRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param Country $country
     * @return QueryBuilder
     */
    public function getCountryZonesQueryBuilder(\PMS\Bundle\AddressingBundle\Entity\Country $country)
    {
        return $this->createQueryBuilder('r')
            ->where('r.country = :country')
            ->orderBy('r.name', 'ASC')
            ->setParameter('country', $country);
    }

    /**
     * @param Country $country
     * @return Zone[]
     */
    public function getCountryZones(\PMS\Bundle\AddressingBundle\Entity\Country $country)
    {
        $query = $this->getCountryZonesQueryBuilder($country)->getQuery();
        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->execute();
    }
}
