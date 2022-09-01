<?php


namespace Okay\Modules\SimplaMarket\FilterInBreadcrumb\Helpers;


class FilterInBreadcrumbHelper
{
    const MAX_FILTER_VALUES = 1;
    private $filterBreadcrumb = [];

    public function __construct($category, $categoryFeatures, $currentFeatures, $currentBrandsIds)
    {
        if ($this->checkLimit($currentFeatures, $currentBrandsIds)) {
            $filterBrandBreadcrumbData    = $this->getFilterBrandData($currentBrandsIds, $category->brands);
            $filterFeaturesBreadcrumbData = $this->getFilterFeaturesData($currentFeatures, $categoryFeatures);

            $filterBreadcrumbBrand        = $this->getBrandBreadcrumb($filterBrandBreadcrumbData, $filterFeaturesBreadcrumbData);
            $filterFeaturesBreadcrumb     = $this->getFeatureBreadcrumb($filterFeaturesBreadcrumbData);

            $this->filterBreadcrumb = array_merge($this->filterBreadcrumb, $filterBreadcrumbBrand, $filterFeaturesBreadcrumb);
        }
    }

    public function checkLimit($currentFeatures, $currentBrandsIds)
    {
        $flag = false;

        if (!empty($currentFeatures)) {
            $flag = true;
            foreach ($currentFeatures as $feature) {
                if (count($feature) > self::MAX_FILTER_VALUES) {
                    return false;
                }
            }
        }

        if (!empty($currentBrandsIds)) {
            $flag = true;
            if (count($currentBrandsIds)>self::MAX_FILTER_VALUES) return false;
        }

        return $flag;
    }
    public function getFilterBrandData($currentBrandsIds, $brands)
    {
        if (empty($currentBrandsIds)) {
            return [];
        }
        if (empty($brands)) {
            return [];
        }

        $filterBrandBreadcrumbData = [];
        foreach ($currentBrandsIds as $bId) {

            if (!empty($b = $brands[$bId])) {
                $filterBrandData = new \stdClass();
                $filterBrandData->name = $b->name;
                $filterBrandData->url = $b->url;
                $filterBrandData->translit = $b->url;
                $filterBrandData->type = 'brand';
                $filterBrandData->brand = $b;
                $filterBrandBreadcrumbData[] = $filterBrandData;
            }
        }
        return $filterBrandBreadcrumbData;
    }
    public function getFilterFeaturesData($currentFeatures, $categoryFeatures)
    {
        if (empty($categoryFeatures)) {
            return [];
        }
        if (empty($currentFeatures)) {
            return [];
        }

        $filterFeaturesBreadcrumbData = [];
        foreach ($categoryFeatures as $f) {
            if (!empty($currentFeatures[$f->id])) {
                foreach ($f->features_values as $fv) {
                    if (isset($currentFeatures[$f->id][$fv->id])) {
                        $filterFeatureData = new \stdClass();
                        $filterFeatureData->type = 'feature';
                        $filterFeatureData->feature = $f;
                        $filterFeatureData->value = $fv;
                        $filterFeatureData->name = $f->name.' '.$fv->value;
                        $filterFeatureData->url = $f->url;
                        $filterFeatureData->translit = $fv->translit;
                        $filterFeaturesBreadcrumbData[] = $filterFeatureData;
                    }
                }
            }
        }

        return $filterFeaturesBreadcrumbData;
    }

    public function getBrandBreadcrumb($filterBrandBreadcrumbData, $filterFeaturesBreadcrumbData)
    {
        if (empty($filterBrandBreadcrumbData)) return [];

        $filterBreadcrumb = [];
        if (!empty($filterBrandBreadcrumbData)) {
            foreach ($filterBrandBreadcrumbData as $b) {
                if (!empty($filterFeaturesBreadcrumbData)) {
                    $cnt = count($filterFeaturesBreadcrumbData);
                    foreach ($filterFeaturesBreadcrumbData as $key=>$crumb) {
                        $tempSliced = array_slice($filterFeaturesBreadcrumbData, $key, $cnt);
                        if (!empty($tempSliced)) {
                            foreach ($tempSliced as $tempCrumb) {
                                $b->params[$tempCrumb->url] = $tempCrumb->translit;
                            }
                        }
                    }
                }
                $filterBreadcrumb[] = $b;
            }
            return $filterBreadcrumb;
        }
        return $filterBreadcrumb;
    }

    public function getFeatureBreadcrumb($filterFeaturesBreadcrumbData)
    {
        if (empty($filterFeaturesBreadcrumbData)) return [];

        $filterBreadcrumb = [];
        if (!empty($filterFeaturesBreadcrumbData)) {
            $cnt = count($filterFeaturesBreadcrumbData);
            foreach ($filterFeaturesBreadcrumbData as $key=>$crumb) {
                $tempSliced = array_slice($filterFeaturesBreadcrumbData, $key+1, $cnt);
                if (!empty($tempSliced)) {
                    foreach ($tempSliced as $tempCrumb) {
                        $crumb->params[$tempCrumb->url] =$tempCrumb->translit;
                    }
                }
                $filterBreadcrumb[] = $crumb;
            }
            return $filterBreadcrumb;
        }
        return $filterBreadcrumb;
    }


    public function getFilterBreadcrumb()
    {
        return $this->filterBreadcrumb;
    }
}