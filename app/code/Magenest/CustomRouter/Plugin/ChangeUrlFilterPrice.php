<?php

namespace Magenest\CustomRouter\Plugin;

use Magento\Catalog\Model\Layer\Filter\Item;

class ChangeUrlFilterPrice
{
    /**
     * @param Item $subject
     * @param $result
     * @return mixed
     */
    public function afterGetUrl(Item $subject, $result)
    {
        $urlString = $result;
        $urlArrays = explode('?', $urlString);
        if (str_contains(end($urlArrays), 'price')) {
            $addParam = str_replace('=', '-', end($urlArrays));
            return substr_replace($urlArrays[0], '-'.$addParam, strlen($urlArrays[0]) - 5, 0);
        } else {
            return $result;
        }
    }
}
