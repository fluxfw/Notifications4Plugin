<?php

namespace srag\Notifications4Plugin\Parser;

/**
 * Interface FactoryInterface
 *
 * @package srag\Notifications4Plugin\Parser
 */
interface FactoryInterface
{

    /**
     * @return twigParser
     */
    public function twig() : twigParser;
}
