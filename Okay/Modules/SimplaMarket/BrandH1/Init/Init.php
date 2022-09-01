<?php


namespace Okay\Modules\SimplaMarket\BrandH1\Init;


use Okay\Admin\Requests\BackendBrandsRequest;
use Okay\Entities\BrandsEntity;
use Okay\Core\Modules\EntityField;
use Okay\Core\Modules\AbstractInit;
use Okay\Modules\SimplaMarket\BrandH1\Extensions\BackendBrandsRequestExtension;
use Okay\Modules\SimplaMarket\BrandH1\Extensions\H1Extensions;
use Okay\Helpers\MetadataHelpers\BrandMetadataHelper;


class Init extends AbstractInit
{
    public function install()
    {
        $this->migrateEntityField(BrandsEntity::class,
            (new EntityField('brand_h1'))->setTypeText()->setNullable()->setIsLang(), true);
    }

    public function init()
    {

        $this->registerEntityField(BrandsEntity::class, 'brand_h1', true);

        $this->registerChainExtension(
            [BackendBrandsRequest::class,          'postBrand'],
            [BackendBrandsRequestExtension::class, 'extendPostBrand']);

        $this->registerChainExtension(
            ['class' => BrandMetadataHelper::class,    'method' => 'getH1Template'],
            ['class' => H1Extensions::class,    'method' => 'customH1']);

        $this->addBackendBlock('brand_custom_block', 'brand_h1.tpl');
    }
}