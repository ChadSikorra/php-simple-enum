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
 * Provides a base for the flag and simple enum.
 *
 * @author Chad Sikorra <Chad.Sikorra@gmail.com>
 */
trait EnumTrait
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var array
     */
    protected static $constants;

    /**
     * @var array
     */
    protected static $lcKeyMap = [];

    /**
     * Get the value this enum represents.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get all the names for the enum.
     *
     * @return array
     */
    public static function names()
    {
        static::initialize();

        return array_keys(static::$constants);
    }

    /**
     * Get all the values for the enum.
     *
     * @return array
     */
    public static function values()
    {
        static::initialize();

        return array_values(static::$constants);
    }

    /**
     * Get the enum as its key => value pairs.
     *
     * @return array
     */
    public static function toArray()
    {
        static::initialize();

        return static::$constants;
    }

    /**
     * Check if a specific enum exists by name.
     *
     * @param string $name
     * @return bool
     */
    public static function isValidName($name)
    {
        static::initialize();

        return isset(static::$lcKeyMap[strtolower($name)]);
    }

    /**
     * Check if a specific enum exists by value.
     *
     * @param $value
     * @param bool $strict
     * @return bool
     */
    public static function isValidValue($value, $strict = false)
    {
        static::initialize();

        return (array_search($value, static::$constants, $strict) !== false);
    }

    /**
     * Get the enum name from its value.
     *
     * @param mixed $value
     * @param bool $strict
     * @return string
     */
    public static function getValueName($value, $strict = false)
    {
        if (!static::isValidValue($value)) {
            throw new \InvalidArgumentException('No enum name was found for the value supplied.');
        }

        return array_search($value, static::$constants, $strict);
    }

    /**
     * Get the enum value from its name.
     *
     * @param string $name
     * @return mixed
     */
    public static function getNameValue($name)
    {
        static::initialize();

        if (!static::isValidName($name)) {
            throw new \InvalidArgumentException(sprintf(
                'The enum name "%s" is not valid. Expected one of: %s',
                $name,
                implode(', ', static::names())
            ));
        }

        return static::$constants[static::$lcKeyMap[strtolower($name)]];
    }

    /**
     * Cache the enum array statically so we only have to do reflection a single time.
     */
    protected static function initialize()
    {
        $class = static::class;

        if (static::$constants === null) {
            static::$constants = (new \ReflectionClass($class))->getConstants();

            foreach (static::names() as $name) {
                static::$lcKeyMap[strtolower($name)] = $name;
            }
        }
    }
}
