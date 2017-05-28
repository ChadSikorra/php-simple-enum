<?php
/**
 * This file is part of the php-simple-enum package.
 *
 * (c) Chad Sikorra <Chad.Sikorra@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace fixtures;

use Enums\SimpleEnumInterface;
use Enums\SimpleEnumTrait;

class SimpleFixture implements SimpleEnumInterface
{
    use SimpleEnumTrait;

    const Monday = 1;

    const Tuesday = 2;

    const Wednesday = 3;

    const Thursday = 4;

    const Friday = 5;

    const Saturday = 6;

    const Sunday = 7;
}
