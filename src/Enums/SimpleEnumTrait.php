<?php
/**
 * This file is part of the php-simple-enum package.
 *
 * (c) Chad Sikorra <Chad.Sikorra@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Enums;

/**
 * Provides a simple enum.
 *
 * @author Chad Sikorra <Chad.Sikorra@gmail.com>
 */
trait SimpleEnumTrait
{
    use EnumTrait;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        if ($value instanceof static) {
            $this->value = $value->getValue();
        } elseif (static::isValidName($value)) {
            $this->value = self::getNameValue($value);
        } elseif (static::isValidValue($value, true)) {
            $this->value = $value;
        } else {
            throw new \InvalidArgumentException(sprintf(
                'Invalid enum name/value "%s". Expected one of: %s',
                $value,
                implode(', ', static::names())
            ));
        }
    }

    /**
     * Get the name this enum represents.
     *
     * @return string
     */
    public function getName()
    {
        return static::getValueName($this->value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
