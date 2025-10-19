<?php

namespace Casbin\Admin\Grid\Filter;

class StartsWith extends Like
{
    protected $exprFormat = '{value}%';
}
