<?php


namespace Okay\Modules\DL\ShopReview\Entities;


use Okay\Core\Entity\Entity;

class ShopReviewEntity extends Entity
{
    protected static $fields = [
        'id',
        'name',
        'content',
        'rating',
        'date',
        'link',
        'from',
        'position',
    ];

    protected static $langFields = [
        'name',
        'content',
    ];

    protected static $defaultOrderFields = [
        'position',
    ];

    protected static $table = '__dl_agency__ShopReview__ShopReview';
    protected static $langTable = 'dl_agency__ShopReview__ShopReview';
    protected static $langObject = 'ShopReview';
    protected static $tableAlias = 'sr';
}