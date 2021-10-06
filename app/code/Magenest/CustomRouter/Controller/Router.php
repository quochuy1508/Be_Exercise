<?php

namespace Magenest\CustomRouter\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Request\Http as HttpRequest;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    protected $actionFactory;

    /**
     * @param ActionFactory $actionFactory
     */
    public function __construct(
        ActionFactory $actionFactory
    ) {
        $this->actionFactory = $actionFactory;
    }

    /**
     * Match corresponding URL Rewrite and modify request.
     *
     * @param RequestInterface|HttpRequest $request
     * @return ActionInterface|null
     * @throws NoSuchEntityException
     */
    public function match(RequestInterface $request)
    {
        try {
            $pathInfo = $request->getPathInfo();
            if ($pathInfo) {
                $arrayPath = explode('/', $pathInfo);
                $priceWithNamePath = str_replace('.html', '', end($arrayPath));
                $priceWithName = explode('-', $priceWithNamePath);
                if ($priceWithName[count($priceWithName)-3] == 'price') {
                    $priceOne = $priceWithName[count($priceWithName)-2];
                    $priceTwo = $priceWithName[count($priceWithName)-1];
                    $paramRemove = '-price-' . $priceOne . '-' . $priceTwo;
                    $path = str_replace($paramRemove, '', $pathInfo);

                    $request->setPathInfo('' . $path)->setParam('price', $priceOne . '-' . $priceTwo);
                    return $this->actionFactory->create(
                        Forward::class
                    );
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }
}
