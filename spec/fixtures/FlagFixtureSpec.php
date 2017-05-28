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

use fixtures\FlagFixture;
use fixtures\SimpleFixture;
use PhpSpec\ObjectBehavior;

class FlagFixtureSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Read');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FlagFixture::class);
    }

    function it_should_be_constructable_with_a_value()
    {
        $this->beConstructedWith(7);

        $this->getValue()->shouldBeEqualTo(7);
    }

    function it_should_be_constructable_with_an_object()
    {
        $this->beConstructedWith(new FlagFixture('Execute'));

        $this->getValue()->shouldBeEqualTo(4);
    }

    function it_should_add_a_flag_by_name()
    {
        $this->add('Write')->getValue()->shouldBeEqualTo(3);
    }

    function it_should_add_a_flag_by_value()
    {
        $this->add(2)->getValue()->shouldBeEqualTo(3);
    }

    function it_should_add_a_flag_by_object()
    {
        $this->add(new FlagFixture('Write'))->getValue()->shouldBeEqualTo(3);
    }

    function it_should_only_add_flag_objects_that_are_instances_of_itself()
    {
        $this->add(new SimpleFixture('Monday'))->getValue()->shouldBeEqualTo(1);
    }

    function it_should_add_multiple_values_to_the_flag()
    {
        $this->add('Write', new FlagFixture('Execute'))->getValue()->shouldBeEqualTo(7);
    }

    function it_should_not_add_a_flag_that_already_exists()
    {
        $this->add('Read')->getValue()->shouldBeEqualTo(1);
    }

    function it_should_remove_a_flag_by_name()
    {
        $this->remove('Read')->getValue()->shouldBeEqualTo(0);
    }

    function it_should_remove_a_flag_by_value()
    {
        $this->remove(1)->getValue()->shouldBeEqualTo(0);
    }

    function it_should_remove_a_flag_by_object()
    {
        $this->remove(new FlagFixture('Read'))->getValue()->shouldBeEqualTo(0);
    }

    function it_should_remove_multiple_flags()
    {
        $this->beConstructedWith(7);

        $this->remove('Read', new FlagFixture('Write'))->getValue()->shouldBeEqualTo(4);
    }

    function it_should_not_remove_a_flag_that_doesnt_exist()
    {
        $this->remove('Write')->getValue()->shouldBeEqualTo(1);
    }

    function it_should_check_if_a_flag_exists()
    {
        $this->has('Read')->shouldBeEqualTo(true);
    }

    function it_should_check_if_a_flag_does_not_exist()
    {
        $this->has('Write')->shouldBeEqualTo(false);
    }

    function it_should_be_case_insensitive_checking_a_flag()
    {
        $this->has('ReAd')->shouldBeEqualTo(true);
    }

    function it_should_be_case_insensitive_adding_a_flag()
    {
        $this->add('WrItE')->getValue()->shouldBeEqualTo(3);
    }

    function it_should_be_case_insensitive_removing_a_flag()
    {
        $this->remove('ReAd')->getValue()->shouldBeEqualTo(0);
    }

    function it_should_get_all_the_names_the_flag_represents()
    {
        $this->beConstructedWith(3);

        $this->getNames()->shouldBeEqualTo(['Read', 'Write']);
    }

    function it_should_have_a_string_representation()
    {
        $this->beConstructedWith(3);

        $this->__toString()->shouldBeEqualTo('Read,Write');
    }
}
