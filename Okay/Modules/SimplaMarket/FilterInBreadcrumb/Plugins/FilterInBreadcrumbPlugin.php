<?php


namespace Okay\Modules\SimplaMarket\FilterInBreadcrumb\Plugins;


use Okay\Core\Design;
use Okay\Core\SmartyPlugins\Func;
use Okay\Modules\SimplaMarket\FilterInBreadcrumb\Helpers\FilterInBreadcrumbHelper;

class FilterInBreadcrumbPlugin extends Func
{
    protected $tag = 'filter_breadcrumb';

    protected $design;

    public function __construct(Design $design)
    {
        $this->design = $design;
    }

    public function run($vars)
    {
        $level = $vars['level'] ? $vars['level'] : 1;
        $this->design->assign('level_filter', $level);

        if (!empty($category = $vars['category'])) {
            $currentBrandsIds = $this->design->getVar('selected_brands_ids');
            $currentFeatures  = $this->design->getVar('selected_filters');
            $categoryFeatures = $this->design->getVar('features');

            if (!empty($currentFeatures) || !empty($currentBrandsIds)) {
                $filterBreadcrumbHelper = new FilterInBreadcrumbHelper($category, $categoryFeatures, $currentFeatures, $currentBrandsIds);
                $filterBreadcrumb = $filterBreadcrumbHelper->getFilterBreadcrumb();
                $this->design->assign('filter_breadcrumb', $filterBreadcrumb);
            }
        }

        return $this->design->fetch('filter_breadcrumb.tpl');
    }
}