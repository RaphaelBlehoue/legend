<?php

namespace Labs\UsersBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LabsUsersBundle extends Bundle
{

    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
