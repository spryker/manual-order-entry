<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ManualOrderEntry\Business;

use Generated\Shared\Transfer\OrderSourceTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Spryker\Zed\ManualOrderEntry\Business\ManualOrderEntryBusinessFactory getFactory()
 * @method \Spryker\Zed\ManualOrderEntry\Persistence\ManualOrderEntryRepositoryInterface getRepository()
 */
class ManualOrderEntryFacade extends AbstractFacade implements ManualOrderEntryFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idOrderSource
     *
     * @return \Generated\Shared\Transfer\OrderSourceTransfer
     */
    public function getOrderSourceById($idOrderSource): OrderSourceTransfer
    {
        return $this->getFactory()
            ->createOrderSourceReader()
            ->getOrderSourceById($idOrderSource);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<\Generated\Shared\Transfer\OrderSourceTransfer>
     */
    public function getAllOrderSources(): array
    {
        return $this->getFactory()
            ->createOrderSourceReader()
            ->findAllOrderSources();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SpySalesOrderEntityTransfer $salesOrderEntityTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SpySalesOrderEntityTransfer
     */
    public function hydrateOrderSource(
        SpySalesOrderEntityTransfer $salesOrderEntityTransfer,
        QuoteTransfer $quoteTransfer
    ): SpySalesOrderEntityTransfer {
        return $this->getFactory()
            ->createOrderSourceHydrator()
            ->hydrateOrderSource($salesOrderEntityTransfer, $quoteTransfer);
    }
}
