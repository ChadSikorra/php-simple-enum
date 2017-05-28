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
 * Simple enum interface.
 *
 * @author Chad Sikorra <Chad.Sikorra@gmail.com>
 */
interface SimpleEnumInterface
{
    /**
     * Get the enum name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the enum value.
     *
     * @return mixed
     */
    public function getValue();
}
