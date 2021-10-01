<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magenest\CLI\Console\Command;

use Magenest\CLI\Api\CancelOrderWithStatusInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * Command for executing cron jobs
 */
class CancelOrderWithStatusNotHandle extends Command
{
    /**
     * Name of input option
     */
    const INPUT_KEY_STATUS_ORDER = 'status';

    /**
     * @var CancelOrderWithStatusInterface
     */
    private $cancelOrderWithStatus;

    /**
     * @param CancelOrderWithStatusInterface $cancelOrderWithStatus
     * @param string|null $name
     */
    public function __construct(
        CancelOrderWithStatusInterface $cancelOrderWithStatus,
        string $name = null
    ) {
        $this->cancelOrderWithStatus = $cancelOrderWithStatus;
        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $options = [
            new InputOption(
                self::INPUT_KEY_STATUS_ORDER,
                null,
                InputOption::VALUE_REQUIRED,
                'Status of special order'
            )
        ];
        $this->setName('order:clear')
            ->setDescription('Clear Status Order')
            ->setDefinition($options);
        parent::configure();
    }

    /**
     * Runs cancel order with status if satisfaction condition
     *
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $statusOrder = $input->getOption(self::INPUT_KEY_STATUS_ORDER);
        $result = $this->cancelOrderWithStatus->execute($statusOrder);
        if ($result) {
            $output->writeln("<info>Successfully</info>");
        } else {
            $output->writeln("<info>Fail</info>");
        }
        return 0;
    }
}
