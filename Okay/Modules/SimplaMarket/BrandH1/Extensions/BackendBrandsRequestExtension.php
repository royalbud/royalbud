<?php


namespace Okay\Modules\SimplaMarket\BrandH1\Extensions;


use Okay\Core\Request;
use Okay\Core\Modules\Extender\ExtensionInterface;
use Okay\Modules\SimplaMarket\BrandH1\Init\Init;

class BackendBrandsRequestExtension implements ExtensionInterface
{
    /**
     * @var
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function extendPostBrand($brand)
    {
        $brand->brand_h1 = $this->request->post('brand_h1');
        return $brand;
    }
}