<?php


namespace Okay\Modules\DL\ShopReview\Backend\Controllers;


use Okay\Modules\DL\ShopReview\Entities\ShopReviewEntity;
use Okay\Admin\Controllers\IndexAdmin;
use Okay\Core\EntityFactory;

class ShopReviewAdmin extends IndexAdmin
{
    public function fetch(EntityFactory $entityFactory)
    {
        /** @var ShopReviewEntity $ShopReviewEntity */
        $ShopReviewEntity = $entityFactory->get(ShopReviewEntity::class);

        $ShopReview = new \stdClass();
        if ($this->request->method('post')) {
            $ShopReview->id         = $this->request->post('id', 'integer');
            $ShopReview->name       = $this->request->post('name');
            $ShopReview->content    = $this->request->post('content');
            $ShopReview->rating     = $this->request->post('rating', 'integer');
            $ShopReview->date       = $this->request->post('date');
            $ShopReview->link       = $this->request->post('link');
            $ShopReview->from       = $this->request->post('from');
            $ShopReview->visible    = $this->request->post('visible', 'boolean');

            if (empty($ShopReview->id)) {
                $ShopReview->id = $ShopReviewEntity->add($ShopReview);
                $ShopReview = $ShopReviewEntity->get($ShopReview->id);
                $this->design->assign('message_success', 'added');
            } else {
                $ShopReviewEntity->update($ShopReview->id, $ShopReview);
                $ShopReview = $ShopReviewEntity->get($ShopReview->id);
                $this->design->assign('message_success', 'updated');
            }
        } else {
            $ShopReview->id = $this->request->get('id', 'integer');
            $ShopReview = $ShopReviewEntity->get(intval($ShopReview->id));
        }

        $this->design->assign('ShopReview', $ShopReview);
        $this->response->setContent($this->design->fetch('shopreview.tpl'));
    }
}