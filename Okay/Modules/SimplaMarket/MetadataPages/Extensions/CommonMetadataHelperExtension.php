<?php


namespace Okay\Modules\SimplaMarket\MetadataPages\Extensions;


use Okay\Core\Design;
use Okay\Core\Request;
use Okay\Core\EntityFactory;
use Okay\Core\Modules\Extender\ExtensionInterface;
use Okay\Modules\SimplaMarket\MetadataPages\Entities\MetadataPagesEntity;

class CommonMetadataHelperExtension implements ExtensionInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var MetadataPagesEntity
     */
    private $metadataPagesEntity;

    /**
     * @var Design
     */
    private $design;

    private $metadataPage;

    public function __construct(Request $request, EntityFactory $entityFactory, Design $design)
    {
        $this->request             = $request;
        $this->metadataPagesEntity = $entityFactory->get(MetadataPagesEntity::class);
        $this->design = $design;
        $url = $this->matchUrl($this->request->getRequestUri());
        $metadataPage = $this->metadataPagesEntity->findOne(['url' => $url]);
        if (!empty($metadataPage)) {
            $this->metadataPage = $metadataPage;
            $this->design->assign('metaDataPage', true);
            $domain = $this->request->getDomainWithProtocol();
            $this->design->assign('canonical', $domain."/".$metadataPage->url, true);
        }
    }

    public function getH1($h1)
    {
        if ($this->metadataPage && !empty($this->metadataPage->h1_title)) {
            $h1 = $this->metadataPage->h1_title;
        }

        return $h1;
    }

    public function getDescription($description)
    {
        if ($this->metadataPage && !empty($this->metadataPage->description)) {
            $description = $this->metadataPage->description;
        }

        return $description;
    }

    public function getMetaTitle($metaTitle)
    {
        if ($this->metadataPage && !empty($this->metadataPage->meta_title)) {
            $metaTitle = $this->metadataPage->meta_title;
        }

        return $metaTitle;
    }

    public function getMetaKeywords($metaKeywords)
    {
        if ($this->metadataPage && !empty($this->metadataPage->meta_keywords)) {
            $metaKeywords = $this->metadataPage->meta_keywords;
        }

        return $metaKeywords;
    }

    public function getMetaDescription($metaDescription)
    {
        if ($this->metadataPage && !empty($this->metadataPage->meta_description)) {
            $metaDescription = $this->metadataPage->meta_description;
        }

        return $metaDescription;
    }

    public function matchUrl($uri)
    {
        return explode('?', $uri)[0];
    }
}