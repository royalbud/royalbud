<?php


namespace Okay\Modules\SimplaMarket\MetadataPages\Init;


use Okay\Core\Modules\EntityField;
use Okay\Core\Modules\AbstractInit;
use Okay\Helpers\MetadataHelpers\AllProductsMetadataHelper;
use Okay\Helpers\MetadataHelpers\BestsellersMetadataHelper;
use Okay\Helpers\MetadataHelpers\CartMetadataHelper;
use Okay\Helpers\MetadataHelpers\CategoryMetadataHelper;
use Okay\Helpers\MetadataHelpers\CommonMetadataHelper;
use Okay\Helpers\MetadataHelpers\DiscountedMetadataHelper;
use Okay\Helpers\MetadataHelpers\OrderMetadataHelper;
use Okay\Helpers\MetadataHelpers\PostMetadataHelper;
use Okay\Helpers\MetadataHelpers\ProductMetadataHelper;
use Okay\Modules\SimplaMarket\MetadataPages\Entities\MetadataPagesEntity;
use Okay\Modules\SimplaMarket\MetadataPages\Extensions\CommonMetadataHelperExtension;

class Init extends AbstractInit
{
    public function install()
    {
        $this->setBackendMainController('MetadataPagesAdmin');

        $this->migrateEntityTable(MetadataPagesEntity::class, [
            (new EntityField('id'))->setIndexPrimaryKey()->setTypeInt(11, false)->setAutoIncrement(),
            (new EntityField('name'))->setTypeText()->setIsLang(),
            (new EntityField('url'))->setTypeVarchar(2000)->setIsLang()->setNullable(),
            (new EntityField('meta_title'))->setTypeVarchar(255)->setIsLang()->setNullable(),
            (new EntityField('meta_keywords'))->setTypeVarchar(255)->setIsLang()->setNullable(),
            (new EntityField('meta_description'))->setTypeText()->setIsLang()->setNullable(),
            (new EntityField('description'))->setTypeText()->setIsLang()->setNullable(),
            (new EntityField('h1_title'))->setTypeVarchar(255)->setIsLang()->setNullable(),
        ]);
    }

    public function init()
    {
        $this->addPermission('okaycms__matadata_pages');
        $this->registerBackendController('MetadataPagesAdmin');
        $this->registerBackendController('MetadataPageAdmin');

        $this->addBackendControllerPermission('MetadataPagesAdmin', 'okaycms__matadata_pages');
        $this->addBackendControllerPermission('MetadataPageAdmin', 'okaycms__matadata_pages');

        $this->extendBackendMenu('left_seo', ['left_metadata_pages_title' => ['MetadataPagesAdmin', 'MetadataPageAdmin']]);

        $this->registerExtensionForMetadataHelper(AllProductsMetadataHelper::class);
        $this->registerExtensionForMetadataHelper(BestsellersMetadataHelper::class);
        $this->registerExtensionForMetadataHelper(CartMetadataHelper::class);
        $this->registerExtensionForMetadataHelper(CategoryMetadataHelper::class);
        $this->registerExtensionForMetadataHelper(CommonMetadataHelper::class);
        $this->registerExtensionForMetadataHelper(DiscountedMetadataHelper::class);
        $this->registerExtensionForMetadataHelper(OrderMetadataHelper::class);
        $this->registerExtensionForMetadataHelper(PostMetadataHelper::class);
        $this->registerExtensionForMetadataHelper(ProductMetadataHelper::class);
    }

    private function registerExtensionForMetadataHelper($metadataHelperClass)
    {
        $this->registerChainExtension(
            ['class' => $metadataHelperClass,                 'method' => 'getH1'],
            ['class' => CommonMetadataHelperExtension::class, 'method' => 'getH1']);

        $this->registerChainExtension(
            ['class' => $metadataHelperClass,                 'method' => 'getMetaTitle'],
            ['class' => CommonMetadataHelperExtension::class, 'method' => 'getMetaTitle']);

        $this->registerChainExtension(
            ['class' => $metadataHelperClass,                 'method' => 'getMetaKeywords'],
            ['class' => CommonMetadataHelperExtension::class, 'method' => 'getMetaKeywords']);

        $this->registerChainExtension(
            ['class' => $metadataHelperClass,                 'method' => 'getMetaDescription'],
            ['class' => CommonMetadataHelperExtension::class, 'method' => 'getMetaDescription']);

        $this->registerChainExtension(
            ['class' => $metadataHelperClass,                 'method' => 'getDescription'],
            ['class' => CommonMetadataHelperExtension::class, 'method' => 'getDescription']);
    }
}