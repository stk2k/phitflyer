<?php
namespace PhitFlyer;

use NetDriver\NetDriverInterface;

interface NetDriverChangeListenerInterface
{
    /**
     * Net driver change callback
     *
     * @param NetDriverInterface $net_driver
     */
    public function onNetDriverChanged(NetDriverInterface $net_driver);
}