<?php

declare(strict_types=1);

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

    protected function setUp(): void
    {
        $this->subject = new Floor();
    }

    protected function tearDown(): void
    {
        unset(
            $this->subject
        );
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameSetsName(): void
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
    public function getSortingInitiallyReturnsZero(): void
    {
        self::assertSame(
            0,
            $this->subject->getSorting()
        );
    }

    /**
     * @test
     */
    public function setSortingSetsSorting(): void
    {
        $this->subject->setSorting(123456);

        self::assertSame(
            123456,
            $this->subject->getSorting()
        );
    }
}
