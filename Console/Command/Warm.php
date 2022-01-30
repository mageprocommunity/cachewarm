<?php
/**
 * Copyright © MagePro - Magento Community All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace MagePro\CacheWarm\Console\Command;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\UrlRewrite\Model\UrlRewrite;
use MagePro\CacheWarm\Model\UrlProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Warm extends Command
{
    const CMS_PAGE = "cms-page";
    const PRODUCT = "product";
    const CATEGORY = "category";

    /** @var UrlProvider $urlProvider */
    private $urlProvider;

    /** @var StoreManagerInterface $storeManager */
    private $storeManager;

    /** @var \Magento\Framework\ObjectManagerInterface */
    private $objectManager;

    public function __construct(
        UrlProvider                               $urlProvider,
        StoreManagerInterface                     $storeManager,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        string                                    $name = null
    )
    {
        $this->urlProvider = $urlProvider;
        $this->storeManager = $storeManager;
        $this->objectManager = $objectManager;
        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface  $input,
        OutputInterface $output
    )
    {
        $store_id = $input->getOption('store_id');
        $store_ids = $store_id ? explode(',', $store_id) : null;
        $types = $input->getOption('type');
        $entities = $types ? explode(',', $types) : [self::CMS_PAGE, self::CATEGORY, self::PRODUCT];

        foreach ($this->storeManager->getStores() as $store) {
            if ($store_ids && !in_array($store->getId(), $store_ids)) {
                continue;
            }
            $output->writeln("Working on 1Store ID " . $store->getId() . ' ' . $store->getCode());
            foreach ($entities as $entity) {
                $res = $this->urlProvider->getUrls($store->getId(), $entity);
                $progressBar = $this->objectManager->create(
                    \Symfony\Component\Console\Helper\ProgressBar::class,
                    [
                        'output' => $output,
                        'max' => $res->count()
                    ]
                );
                $progressBar->setFormat('<info>%message%</info> %current%/%max% [%bar%] %percent:3s%% %elapsed% %memory:6s%');
                $progressBar->setMessage($entity);
                $progressBar->start();
                $progressBar->display();
                /** @var UrlRewrite $r */
                foreach ($res as $r) {
                    @file_get_contents($store->getUrl($r->getRequestPath()));
                    $progressBar->advance();
                }
                $progressBar->finish();
                $output->writeln('');
            }
        }
    }


    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("magepro_cachewarm:warm");
        $this->setDescription("Prepare Magento cache");
        $this->setDefinition([
            new InputOption('store_id', null, InputOption::VALUE_OPTIONAL, "Store ID"),
            new InputOption('type', null, InputOption::VALUE_OPTIONAL, "")
        ]);
        parent::configure();
    }
}

