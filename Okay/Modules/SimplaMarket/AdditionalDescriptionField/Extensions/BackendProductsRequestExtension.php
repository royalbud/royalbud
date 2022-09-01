<?php


namespace Okay\Modules\SimplaMarket\AdditionalDescriptionField\Extensions;


use Okay\Core\Request;
use Okay\Core\Modules\Extender\ExtensionInterface;
use Okay\Modules\SimplaMarket\AdditionalDescriptionField\Init\Init;

class BackendProductsRequestExtension implements ExtensionInterface
{
    /**
     * @var
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function extendPostProduct($product)
    {
        $product->{Init::ADDITIONAL_FIELD_NAME} = $this->request->post('simplamarket__additional_description_field__description');
        return $product;
    }
}