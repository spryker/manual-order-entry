<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ManualOrderEntry\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\ManualOrderEntry\Business\Model\OrderSource\OrderSourceHydrator;
use Spryker\Zed\ManualOrderEntry\Business\Model\OrderSource\OrderSourceHydratorInterface;
use Spryker\Zed\ManualOrderEntry\Business\Model\OrderSource\OrderSourceReader;
use Spryker\Zed\ManualOrderEntry\Business\Model\OrderSource\OrderSourceReaderInterface;

/**
 * @method \Spryker\Zed\ManualOrderEntry\Persistence\ManualOrderEntryRepositoryInterface getRepository()
 * @method \Spryker\Zed\ManualOrderEntry\ManualOrderEntryConfig getConfig()
 */
class ManualOrderEntryBusinessFactory extends AbstractBusinessFactory
{
    public function createOrderSourceReader(): OrderSourceReaderInterface
    {
        return new OrderSourceReader(
            $this->getRepository(),
        );
    }

    public function createOrderSourceHydrator(): OrderSourceHydratorInterface
    {
        return new OrderSourceHydrator();
    }
}
