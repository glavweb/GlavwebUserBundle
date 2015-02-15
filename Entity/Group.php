<?php

namespace Application\UserBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;

/**
 * Class Group
 * @package Application\UserBundle\Entity
 */
class Group extends BaseGroup
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * Represents a string representation
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName() ?: 'n/a';
    }
}