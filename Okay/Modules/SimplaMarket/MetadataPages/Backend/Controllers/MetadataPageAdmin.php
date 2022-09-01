<?php


namespace Okay\Modules\SimplaMarket\MetadataPages\Backend\Controllers;


use Okay\Admin\Controllers\IndexAdmin;
use Okay\Modules\SimplaMarket\MetadataPages\Entities\MetadataPagesEntity;

class MetadataPageAdmin extends IndexAdmin
{
    public function fetch(MetadataPagesEntity $metadataPagesEntity)
    {
        if ($this->request->method('post')) {
            $metadataPage                   = new \stdClass();
            $metadataPage->id               = $this->request->post('id');
            $metadataPage->name             = $this->request->post('name');
            $metadataPage->url              = $this->request->post('url');
            $metadataPage->meta_title       = $this->request->post('meta_title');
            $metadataPage->meta_keywords    = $this->request->post('meta_keywords');
            $metadataPage->meta_description = $this->request->post('meta_description');
            $metadataPage->description      = $this->request->post('description');
            $metadataPage->h1_title         = $this->request->post('h1_title');

            if ($error = $this->getMetadataPagesError($metadataPage)) {
                $this->design->assign('message_error', $error);
            } else {
                if (empty($metadataPage->id)) {
                    unset($metadataPage->id);
                    $metadataPage->id = $metadataPagesEntity->add($metadataPage);

                    $this->postRedirectGet->storeMessageSuccess('added');
                    $this->postRedirectGet->storeNewEntityId($metadataPage->id);
                } else {
                    $metadataPagesEntity->update($metadataPage->id, $metadataPage);

                    $this->postRedirectGet->storeMessageSuccess('updated');
                }

                $this->postRedirectGet->redirect();
            }
        } else {
            $metadataPageId = $this->request->get('id');
            $metadataPage = $metadataPagesEntity->get((int) $metadataPageId);
        }
        
        $this->design->assign('metadata_page', $metadataPage);

        $this->response->setContent($this->design->fetch('metadata_page.tpl'));
    }

    private function getMetadataPagesError($metadataPage)
    {
        return '';
    }
}