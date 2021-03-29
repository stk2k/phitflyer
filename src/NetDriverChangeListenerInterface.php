<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer;

use Stk2k\NetDriver\NetDriverInterface;

interface NetDriverChangeListenerInterface
{
    /**
     * Net driver change callback
     *
     * @param NetDriverInterface $net_driver
     */
    public function onNetDriverChanged(NetDriverInterface $net_driver);
}