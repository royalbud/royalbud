<?php


namespace Okay\Modules\SimplaMarket\MetadataPages\Entities;


use Okay\Core\Entity\Entity;

class MetadataPagesEntity extends Entity
{
    protected static $fields = [
        'id',
        'name',
        'url',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'description',
        'h1_title'
    ];

    protected static $langFields = [
        'name',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'description',
        'h1_title',
    ];

    protected static $defaultOrderFields = [
        'id DESC',
    ];

    protected static $table = '__okaycms__metadata_pages';
    protected static $langObject = 'okaycms__metadata_pages';
    protected static $langTable = 'okaycms__metadata_pages';
    protected static $tableAlias = 'o_mp';
}