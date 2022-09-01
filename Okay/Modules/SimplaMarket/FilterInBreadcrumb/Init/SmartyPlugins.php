<?php

use Okay\Core\Design;
use Okay\Core\OkayContainer\Reference\ParameterReference as PR;
use Okay\Core\OkayContainer\Reference\ServiceReference as SR;
use Okay\Modules\SimplaMarket\FilterInBreadcrumb\Plugins\FilterInBreadcrumbPlugin;

return [
    FilterInBreadcrumbPlugin::class => [
        'class' => FilterInBreadcrumbPlugin::class,
        'arguments' => [
            new SR(Design::class)
        ],
    ],
];