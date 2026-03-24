<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\ManualOrderEntry\Communication\Plugin;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\ManualOrderEntry\Persistence\SpyOrderSource;
use Spryker\Zed\ManualOrderEntry\Communication\Plugin\Sales\ManualOrderEntrySalesListBlockRendererPlugin;
use SprykerTest\Zed\ManualOrderEntry\ManualOrderEntryCommunicationTester;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group ManualOrderEntry
 * @group Communication
 * @group Plugin
 * @group ManualOrderEntrySalesListBlockRendererPluginTest
 * Add your own group annotations below this line
 */
class ManualOrderEntrySalesListBlockRendererPluginTest extends Unit
{
    protected const string BLOCK_URL = '/manual-order-entry/sales/list';

    protected const string OTHER_URL = '/other/url';

    protected ManualOrderEntryCommunicationTester $tester;

    public function testIsApplicableReturnsTrueForMatchingUrl(): void
    {
        // Arrange
        $plugin = $this->getBlockRendererPlugin();

        // Act
        $result = $plugin->isApplicable(static::BLOCK_URL);

        // Assert
        $this->assertTrue($result);
    }

    public function testIsApplicableReturnsFalseForNonMatchingUrl(): void
    {
        // Arrange
        $plugin = $this->getBlockRendererPlugin();

        // Act
        $result = $plugin->isApplicable(static::OTHER_URL);

        // Assert
        $this->assertFalse($result);
    }

    public function testGetTemplatePathReturnsExpectedPath(): void
    {
        // Arrange
        $plugin = $this->getBlockRendererPlugin();

        // Act
        $result = $plugin->getTemplatePath(static::BLOCK_URL);

        // Assert
        $this->assertSame('@ManualOrderEntry/Sales/list.twig', $result);
    }

    public function testGetDataReturnsOrderSourceNameWhenOrderSourceNotFound(): void
    {
        // Arrange
        $plugin = $this->getBlockRendererPlugin();
        $orderTransfer = (new OrderTransfer())->setFkOrderSource(null);

        // Act
        $result = $plugin->getData(new Request(), $orderTransfer, static::BLOCK_URL);

        // Assert
        $this->assertArrayHasKey('orderSourceName', $result);
        $this->assertSame('-', $result['orderSourceName']);
    }

    public function testGetDataReturnsOrderSourceNameForExistingOrderSource(): void
    {
        // Arrange
        $orderSourceName = 'Test Order Source';
        $orderSourceEntity = (new SpyOrderSource())->setName($orderSourceName);
        $orderSourceEntity->save();

        $plugin = $this->getBlockRendererPlugin();
        $orderTransfer = (new OrderTransfer())->setFkOrderSource($orderSourceEntity->getIdOrderSource());

        // Act
        $result = $plugin->getData(new Request(), $orderTransfer, static::BLOCK_URL);

        // Assert
        $this->assertSame($orderSourceName, $result['orderSourceName']);
    }

    public function getBlockRendererPlugin(): ManualOrderEntrySalesListBlockRendererPlugin
    {
        return new ManualOrderEntrySalesListBlockRendererPlugin();
    }
}
