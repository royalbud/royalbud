<?php


namespace Okay\Modules\DL\ShopReview\Init;


use Okay\Core\Modules\EntityField;
use Okay\Core\Modules\AbstractInit;
use Okay\Modules\DL\ShopReview\Entities\ShopReviewEntity;

class Init extends AbstractInit
{
    public function install()
    {
        $this->setBackendMainController('ShopReviewsAdmin');
        $this->migrateEntityTable(ShopReviewEntity::class, [
            (new EntityField('id'))->setIndexPrimaryKey()->setTypeInt(11, false)->setAutoIncrement(),
            (new EntityField('name'))->setTypeText()->setIsLang(),
            (new EntityField('content'))->setTypeText()->setIsLang()->setNullable(),
            (new EntityField('rating'))->setTypeInt(11),
            (new EntityField('date'))->setTypeText(),
            (new EntityField('link'))->setTypeText(),
            (new EntityField('from'))->setTypeText(),
            (new EntityField('visible'))->setTypeTinyInt(1),
            (new EntityField('position'))->setTypeInt(11),
        ]);
    }
    
    public function init()
    {
        $this->registerBackendController('ShopReviewsAdmin');
        $this->addBackendControllerPermission('ShopReviewsAdmin', 'dl_agency__ShopReview__ShopReview');

        $this->registerBackendController('ShopReviewAdmin');
        $this->addBackendControllerPermission('ShopReviewAdmin', 'dl_agency__ShopReview__ShopReview');

        $this->extendUpdateObject('DL.ShopReview.ShopReviewEntity', 'dl_agency__ShopReview__ShopReview', ShopReviewEntity::class);

        $this->extendBackendMenu('left_ShopReview_title', [
            'left_ShopReview_title' => ['ShopReviewsAdmin', 'ShopReviewAdmin'],
        ]);
    }
}