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
 * Provides a flag based enum.
 *
 * @author Chad Sikorra <Chad.Sikorra@gmail.com>
 */
trait FlagEnumTrait
{
    use EnumTrait;

    /**
     * @param int|string $flags
     */
    public function __construct($flags = 0)
    {
        if ($flags instanceof static) {
            $this->value = $flags->getValue();
        } elseif (static::isValidName($flags)) {
            $this->value = static::getNameValue($flags);
        } else {
            $this->value = (int) $flags;
        }
    }

    /**
     * Add a flag to the value.
     *
     * @param int[]|string[]|FlagEnumTrait[] ...$flags
     * @return $this
     */
    public function add(...$flags)
    {
        foreach ($flags as $flag) {
            if ($this->has($flag)) {
                continue;
            }
            foreach ($this->getValuesFromFlagOrEnum($flag) as $value) {
                $this->value = $this->value | (int) $value;
            }
        }

        return $this;
    }

    /**
     * Remove a flag from the value.
     *
     * @param int[]|string[]|FlagEnumTrait[] ...$flags
     * @return $this
     */
    public function remove(...$flags)
    {
        foreach ($flags as $flag) {
            if (!$this->has($flag)) {
                continue;
            }
            foreach ($this->getValuesFromFlagOrEnum($flag) as $value) {
                $this->value = $this->value ^ (int) $value;
            }
        }

        return $this;
    }

    /**
     * Given an enum name, value, or another FlagEnumTrait instance, check if this instance has the same value(s).
     *
     * @param string|int|FlagEnumTrait $flag
     * @return bool
     */
    public function has($flag)
    {
        $values = $this->getValuesFromFlagOrEnum($flag);

        if (empty($values)) {
            return false;
        }

        foreach ($values as $value) {
            if (!(bool) ($this->value & $value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get an array of all the enum names this flag instance represents.
     *
     * @return array
     */
    public function getNames()
    {
        $enums = [];

        foreach (static::toArray() as $name => $value) {
            if ($this->has($value)) {
                $enums[] = $name;
            }
        }

        return $enums;
    }

    /**
     * Returns a comma-delimited list of enum names this instance represents.
     *
     * @return string
     */
    public function __toString()
    {
        return implode(',', $this->getNames());
    }

    /**
     * Given an enum name, enum value, or flag enum instance, get the array of values it represents.
     *
     * @param int|string|FlagEnumTrait $flag
     * @return array
     */
    protected function getValuesFromFlagOrEnum($flag)
    {
        $values = [];

        if ($flag instanceof static) {
            foreach ($flag->getNames() as $enum) {
                $values[] = static::getNameValue($enum);
            }
        } elseif (static::isValidName((string) $flag)) {
            $values[] = static::getNameValue((string) $flag);
        } elseif (is_numeric($flag)) {
            $values[] = $flag;
        }

        return $values;
    }
}
