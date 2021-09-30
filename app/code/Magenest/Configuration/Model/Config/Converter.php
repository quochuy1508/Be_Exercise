<?php

namespace Magenest\Configuration\Model\Config;

class Converter implements \Magento\Framework\Config\ConverterInterface
{
    public function convert($source)
    {
        $resources = $source->getElementsByTagName('resources');
        $discountDetails = [];
        $iterator = 0;

        /** @var \DOMElement $resource */
        foreach ($resources as $resource) {
            /** @var \DOMText $resourceInfo */
            foreach ($resource->childNodes as $resourceInfo) {
                if ($resourceInfo->nodeName && $resourceInfo->nodeName !== "#text") {
                    $discountDetails[$resource->getAttribute('title')][$resourceInfo->nodeName] = $resourceInfo->textContent;
                }
            }
            $iterator++;
        }

        return ['resources' => $discountDetails];
    }
}
