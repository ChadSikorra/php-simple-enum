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
 * Flag based enum interface.
 *
 * @author Chad Sikorra <Chad.Sikorra@gmail.com>
 */
interface FlagEnumInterface
{
    /**
     * Get the enum names this flag contains.
     *
     * @return string[]
     */
    public function getNames();

    /**
     * Get the value of this flag enum.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Check if the flag has this enum name/value.
     *
     * @param mixed $flag
     * @return bool
     */
    public function has($flag);

    /**
     * Add an enum name/value to the flag.
     *
     * @param array ...$flag
     * @return $this
     */
    public function add(...$flag);

    /**
     * Remove an enum name/value from the flag.
     *
     * @param array ...$flag
     * @return $this
     */
    public function remove(...$flag);
}
