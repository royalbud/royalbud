<?php


use Okay\Core\Request;
use Okay\Core\EntityFactory;
use Okay\Core\Design;
use Okay\Core\OkayContainer\Reference\ServiceReference as SR;
use Okay\Core\OkayContainer\Reference\ParameterReference as PR;
use Okay\Modules\SimplaMarket\MetadataPages\Extensions\CommonMetadataHelperExtension;

return [
    CommonMetadataHelperExtension::class => [
        'class' => CommonMetadataHelperExtension::class,
        'arguments' => [
            new SR(Request::class),
            new SR(EntityFactory::class),
			new SR(Design::class),
        ],
    ],
];