<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ManualOrderEntry\Communication\Plugin\Sales;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\SalesDetailBlockRendererPluginInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\ManualOrderEntry\Communication\ManualOrderEntryCommunicationFactory getFactory()
 * @method \Spryker\Zed\ManualOrderEntry\Business\ManualOrderEntryFacadeInterface getFacade()
 * @method \Spryker\Zed\ManualOrderEntry\Persistence\ManualOrderEntryRepositoryInterface getRepository()
 */
class ManualOrderEntrySalesListBlockRendererPlugin extends AbstractPlugin implements SalesDetailBlockRendererPluginInterface
{
    protected const string BLOCK_URL = '/manual-order-entry/sales/list';

    /**
     * {@inheritDoc}
     * - Checks if the block URL is '/manual-order-entry/sales/list'.
     *
     * @api
     *
     * @param string $blockUrl
     *
     * @return bool
     */
    public function isApplicable(string $blockUrl): bool
    {
        return $blockUrl === static::BLOCK_URL;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $blockUrl
     *
     * @return string
     */
    public function getTemplatePath(string $blockUrl): string
    {
        return '@ManualOrderEntry/Sales/list.twig';
    }

    /**
     * {@inheritDoc}
     * - Returns order source name for the order as template data.
     *
     * @api
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param string $blockUrl
     *
     * @return array<string, mixed>
     */
    public function getData(Request $request, OrderTransfer $orderTransfer, string $blockUrl): array
    {
        $orderSourceName = $this->getRepository()->getOrderSourceName($orderTransfer->getFkOrderSource());

        return ['orderSourceName' => $orderSourceName];
    }
}
