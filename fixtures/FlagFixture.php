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

use Enums\FlagEnumInterface;
use Enums\FlagEnumTrait;

class FlagFixture implements FlagEnumInterface
{
    use FlagEnumTrait;

    const Read = 1;

    const Write = 2;

    const Execute = 4;
}
