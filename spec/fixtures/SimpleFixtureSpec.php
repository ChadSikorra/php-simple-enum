<?php
/**
 * This file is part of the php-simple-enum package.
 *
 * (c) Chad Sikorra <Chad.Sikorra@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\fixtures;

use fixtures\SimpleFixture;
use PhpSpec\ObjectBehavior;

class SimpleFixtureSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SimpleFixture::class);
    }

    function it_should_have_a_string_representation()
    {
        $this->__toString()->shouldBeEqualTo('Monday');
    }

    function it_should_get_the_value_of_the_enum()
    {
        $this->getValue()->shouldBeEqualTo(1);
    }

    function it_should_get_the_name_that_the_enum_represents()
    {
        $this->getName()->shouldBeEqualTo('Monday');
    }

    function it_should_get_all_possible_names_for_the_enum()
    {
        $this::names()->shouldBeEqualTo([
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday",
        ]);
    }

    function it_should_get_all_possible_values_for_the_enum()
    {
        $this::values()->shouldBeEqualTo([
            1,
            2,
            3,
            4,
            5,
            6,
            7,
        ]);
    }

    function it_should_have_an_array_representation()
    {
        $this->toArray()->shouldBeEqualTo([
            'Monday' => 1,
            'Tuesday' => 2,
            'Wednesday' => 3,
            'Thursday' => 4,
            'Friday' => 5,
            'Saturday' => 6,
            'Sunday' => 7,
        ]);
    }

    function it_should_check_if_an_enum_name_is_valid()
    {
        $this::isValidName('Monday')->shouldBeEqualTo(true);
        $this::isValidName('FooDay')->shouldBeEqualTo(false);
    }

    function it_should_check_if_an_enum_name_is_valid_regardless_of_case()
    {
        $this::isValidName('mOnDaY')->shouldBeEqualTo(true);
    }

    function it_should_check_if_an_enum_value_is_valid()
    {
        $this::isValidValue(1)->shouldBeEqualTo(true);
        $this::isValidValue(8)->shouldBeEqualTo(false);
    }

    function it_should_get_an_enum_value_for_a_name()
    {
        $this::getNameValue('Monday')->shouldBeEqualTo(1);
    }

    function it_should_throw_an_exception_getting_a_value_for_a_name_that_doesnt_exist()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('getNameValue', ['FooDay']);
    }

    function it_should_get_an_enum_name_for_a_value()
    {
        $this::getValueName(1)->shouldBeEqualTo('Monday');
    }

    function it_should_throw_an_exception_getting_a_name_for_a_value_that_doesnt_exist()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('getValueName', [8]);
    }
}
