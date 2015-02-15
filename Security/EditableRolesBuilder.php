<?php

namespace Glavweb\UserBundle\Security;

use Sonata\AdminBundle\Admin\Pool;
use Symfony\Component\Security\Core\SecurityContextInterface;

class EditableRolesBuilder
{
    protected $securityContext;

    protected $pool;

    protected $rolesHierarchy;

    /**
     * @param SecurityContextInterface $securityContext
     * @param Pool $pool
     * @param $translator
     * @param array $rolesHierarchy
     */
    public function __construct(SecurityContextInterface $securityContext, Pool $pool, $translator, array $rolesHierarchy = array())
    {
        $this->securityContext = $securityContext;
        $this->pool            = $pool;
        $this->rolesHierarchy  = $rolesHierarchy;
        $this->translator      = $translator;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        $roles = array();
        $rolesReadOnly = array();

        if (!$this->securityContext->getToken()) {
            return array($roles, $rolesReadOnly);
        }

        // get roles from the Admin classes
        foreach ($this->pool->getAdminServiceIds() as $id) {
            try {
                $admin = $this->pool->getInstance($id);
            } catch (\Exception $e) {
                continue;
            }

            $isMaster = $admin->isGranted('MASTER');
            $securityHandler = $admin->getSecurityHandler();
            // TODO get the base role from the admin or security handler
            $baseRole = $securityHandler->getBaseRole($admin);

            foreach ($admin->getSecurityInformation() as $role => $permissions) {
                $role = sprintf($baseRole, $role);

                if ($isMaster) {
                    // if the user has the MASTER permission, allow to grant access the admin roles to other users
                    $roles[$role] = $role;
                } elseif ($this->securityContext->isGranted($role)) {
                    // although the user has no MASTER permission, allow the currently logged in user to view the role
                    $rolesReadOnly[$role] = $role;
                }
            }
        }

        $isMaster = $this->securityContext->isGranted('ROLE_SUPER_ADMIN');

        // get roles from the service container
        foreach ($this->rolesHierarchy as $name => $rolesHierarchy) {
            if ($this->securityContext->isGranted($name) || $isMaster) {
                $roles[$name] = $this->translator->trans($name) . ' (' . implode(', ', $this->translateRoles($rolesHierarchy)) . ')';

                foreach ($rolesHierarchy as $role) {
                    if (!isset($roles[$role])) {
                        $roles[$role] = $role;
                    }
                }
            }
        }
        asort($roles);
        asort($rolesReadOnly);

        return array(
            $this->translateRoles($roles),
            $this->translateRoles($rolesReadOnly)
        );
    }

    /**
     * Translate roles
     *
     * @param $roles
     * @return array
     */
    protected function translateRoles($roles)
    {
        $translator = $this->translator;
        return array_map(function($role) use ($translator) {
            return $this->translator->trans($role);
        }, $roles);
    }
}