<?php

namespace Zaz\BlogBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ZazBlogBundle extends Bundle
{

    public function getParent ()
    {
        return 'FOSUserBundle';
    }

}
