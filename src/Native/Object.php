<?php

namespace Mysidia\Resource\Native;

use Mysidia\Resource\Cloneable;
use Mysidia\Resource\Coercible;
use Mysidia\Resource\Comparable;
use Mysidia\Resource\Hashable;
use Mysidia\Resource\Invokable;
use Mysidia\Resource\Stringable;
use Mysidia\Resource\Valuable;
use Serializable;

/**
 * Base type class
 *
 * @author Ordland
 */
abstract class Object implements Cloneable, Coercible, Comparable, Hashable, Invokable, Stringable, Valuable, Serializable
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * Coerces and sets value
     *
     * @param mixed $value
     */
    public function __construct($value = null)
    {
        if ($value !== null) {
            $this->value = $this->coerce($value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function coerce($value)
    {
        return $value;
    }

    /**
     * Destroys stored value
     */
    public function __destruct()
    {
        $this->value = null;
    }

    /**
     * {@inheritdoc}
     */
    public function __clone()
    {
        return unserialize(serialize($this));
    }

    /**
     * {@inheritdoc}
     */
    public function equals($object)
    {
        return ($this == $object);
    }

    /**
     * {@inheritdoc}
     */
    public function hash()
    {
        return spl_object_hash($this);
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize($this->value());
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($string)
    {
        $this->value = unserialize($string);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return get_class($this);
    }

    /**
     * {@inheritdoc}
     */
    public function compareTo(Valuable $object)
    {
        $a = $this->value();
        $b = $object->value();

        return ($a < $b) ? -1 : (($a > $b) ? 1 : 0);
    }

    /**
     * {@inheritdoc}
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke()
    {
        return $this->value();
    }
}
