<?php

namespace Glavweb\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class GlavwebUserBundle
 * @package Glavweb\UserBundle
 */
class GlavwebUserBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}