<?php

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Itmedia2\Tests\Unit\Domain\Model;

use JWeiland\Itmedia2\Domain\Model\Floor;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test case.
 */
class FloorTest extends UnitTestCase
{
    /**
     * @var Floor
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Floor();
    }

    public function tearDown()
    {
        unset(
            $this->subject
        );
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameInitiallyReturnsEmptyString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameSetsName()
    {
        $this->subject->setName('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameWithIntegerResultsInString()
    {
        $this->subject->setName(123);
        self::assertSame('123', $this->subject->getName());
    }

    /**
     * @test
     */
    public function setNameWithBooleanResultsInString()
    {
        $this->subject->setName(true);
        self::assertSame('1', $this->subject->getName());
    }

    /**
     * @test
     */
    public function getSortingInitiallyReturnsZero()
    {
        self::assertSame(
            0,
            $this->subject->getSorting()
        );
    }

    /**
     * @test
     */
    public function setSortingSetsSorting()
    {
        $this->subject->setSorting(123456);

        self::assertSame(
            123456,
            $this->subject->getSorting()
        );
    }

    /**
     * @test
     */
    public function setSortingWithStringResultsInInteger()
    {
        $this->subject->setSorting('123Test');

        self::assertSame(
            123,
            $this->subject->getSorting()
        );
    }

    /**
     * @test
     */
    public function setSortingWithBooleanResultsInInteger()
    {
        $this->subject->setSorting(true);

        self::assertSame(
            1,
            $this->subject->getSorting()
        );
    }
}
