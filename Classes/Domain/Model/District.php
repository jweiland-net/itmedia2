<?php
declare(strict_types=1);
namespace JWeiland\Itmedia2\Domain\Model;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Domain model to keep information about districts
 * As we use the districts of yellowpages2, this model extends the foreign district.
 */
class District extends \JWeiland\Yellowpages2\Domain\Model\District
{
}
