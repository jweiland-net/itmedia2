<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Itmedia2\Tests\Unit\Domain\Model;

use JWeiland\Itmedia2\Domain\Model\Position;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test case.
 */
class PositionTest extends UnitTestCase
{
    /**
     * @var Position
     */
    protected $subject;

    protected function setUp(): void
    {
        $this->subject = new Position();
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
    public function getTitleInitiallyReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle(): void
    {
        $this->subject->setTitle('foo bar');

        self::assertSame(
            'foo bar',
            $this->subject->getTitle()
        );
    }
}
