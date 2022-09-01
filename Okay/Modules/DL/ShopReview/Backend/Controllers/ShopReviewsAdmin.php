<?php


namespace Okay\Modules\DL\ShopReview\Backend\Controllers;


use Okay\Modules\DL\ShopReview\Entities\ShopReviewEntity;
use Okay\Admin\Controllers\IndexAdmin;
use Okay\Core\EntityFactory;

class ShopReviewsAdmin extends IndexAdmin
{
    public function fetch(EntityFactory $entityFactory)
    {
        /** @var ShopReviewEntity $ShopReviewEntity */
        $ShopReviewEntity = $entityFactory->get(ShopReviewEntity::class);

        if($this->request->method('post')) {
            $ids = $this->request->post('check');
            if(is_array($ids)) {
                switch($this->request->post('action')) {
                    case 'disable': {
                        $ShopReviewEntity->update($ids, ['visible'=>0]);
                        break;
                    }
                    case 'enable': {
                        $ShopReviewEntity->update($ids, ['visible'=>1]);
                        break;
                    }
                    case 'delete': {
                        $ShopReviewEntity->delete($ids);
                        break;
                    }
                }
            }

            // Сортировка
            $positions = $this->request->post('positions');
            if (!empty($positions)) {
                $ids = array_keys($positions);
                sort($positions);
                $positions = array_reverse($positions);
                foreach($positions as $i=>$position) {
                    $ShopReviewEntity->update($ids[$i], ['position'=>$position]);
                }
            }
        }

        $filter = [];
        $filter['page'] = max(1, $this->request->get('page', 'integer'));
        $filter['limit'] = 20;

        $keyword = $this->request->get('keyword', 'string');
        if(!empty($keyword)) {
            $filter['keyword'] = $keyword;
            $this->design->assign('keyword', $keyword);
        }

        $ShopReviews_count = $ShopReviewEntity->count($filter);
        if($this->request->get('page') == 'all') {
            $filter['limit'] = $ShopReviews_count;
        }

        $ShopReviews = $ShopReviewEntity->find($filter);
        $this->design->assign('ShopReviews_count', $ShopReviews_count);
        $this->design->assign('pages_count', ceil($ShopReviews_count/$filter['limit']));
        $this->design->assign('current_page', $filter['page']);
        $this->design->assign('ShopReviews', $ShopReviews);
        $this->response->setContent($this->design->fetch('shopreviews.tpl'));
    }
}