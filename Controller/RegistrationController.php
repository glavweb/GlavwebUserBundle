<?php

namespace Glavweb\UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseRegistrationController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegistrationController extends BaseRegistrationController
{
    /**
     * @throws NotFoundHttpException
     */
    public function checkAdminAction()
    {
        $view = 'GlavwebUserBundle:Registration:check_admin.html.twig';
        return $this->container->get('templating')->renderResponse($view);
    }
}
