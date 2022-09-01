<?php


use Okay\Core\Request;
use Okay\Core\Design;
use Okay\Core\EntityFactory;
use Okay\Core\OkayContainer\Reference\ServiceReference as SR;
use Okay\Modules\SimplaMarket\BrandH1\Extensions\BackendBrandsRequestExtension;
use Okay\Modules\SimplaMarket\BrandH1\Extensions\H1Extensions;

return [
    BackendBrandsRequestExtension::class => [
        'class' => BackendBrandsRequestExtension::class,
        'arguments' => [
            new SR(Request::class),
            new SR(EntityFactory::class),
        ],
    ],
    H1Extensions::class => [
        'class' => H1Extensions::class,
        'arguments' => [
            new SR(Design::class),
        ],
    ],
];