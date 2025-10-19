<?php

namespace Casbin\Admin\Form\Field;

use Casbin\Admin\Form\Field;

class Nullable extends Field
{
    public function __construct()
    {
    }

    public function __call($method, $parameters)
    {
        return $this;
    }
}
