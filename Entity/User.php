<?php

namespace Glavweb\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 * @package Glavweb\UserBundle\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var datetime
     */
    protected $createdAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Represents a string representation
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getUsername() ?: 'n/a';
    }

    /**
     * PrePersist
     */
    public function prePersist()
    {
        $now = new \DateTime('NOW');
        $this->setCreatedAt($now);
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getRealRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRealRoles(array $roles)
    {
        $this->setRoles($roles);
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Ticket
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
