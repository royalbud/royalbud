<?php


namespace Okay\Modules\SimplaMarket\BrandH1\Extensions;
use Okay\Core\Design;
use Okay\Core\Modules\Extender\ExtensionInterface;


class H1Extensions implements ExtensionInterface
{
    public function __construct(Design $design)
    {
        $this->design = $design;
    }
    public function customH1($h1)
    {
        $brand = $this->design->getVar('brand');

        if (!empty($brand->brand_h1)) {
            $h1 = $brand->brand_h1;
        }

        return $h1;
    }
}