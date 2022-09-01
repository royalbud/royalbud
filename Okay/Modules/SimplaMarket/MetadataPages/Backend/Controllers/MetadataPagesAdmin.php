<?php


namespace Okay\Modules\SimplaMarket\MetadataPages\Backend\Controllers;


use Okay\Admin\Controllers\IndexAdmin;
use Okay\Modules\SimplaMarket\MetadataPages\Entities\MetadataPagesEntity;

class MetadataPagesAdmin extends IndexAdmin
{
    public function fetch(MetadataPagesEntity $metadataPagesEntity)
    {
        // Обработка действий
        if ($this->request->method('post')) {

            // Действия с выбранными
            $ids = $this->request->post('check');
            if(!empty($ids)) {
                switch($this->request->post('action')) {
                    case 'delete': {
                        $metadataPagesEntity->delete($ids);
                        break;
                    }
                }
            }
        }

        $metadataPages = $metadataPagesEntity->find();

        $this->design->assign('metadata_pages', $metadataPages);

        $this->response->setContent($this->design->fetch('metadata_pages.tpl'));
    }
}