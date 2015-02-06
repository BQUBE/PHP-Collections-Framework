<?php

namespace Mysidia\Resource;

/**
 * Returns a unique object hash
 *
 * @author Christopher Pitt <cgpitt@gmail.com>
 */
interface Hashable
{
    /**
     * Returns a unique object hash
     *
     * @return float
     */
    public function hashCode();
}
