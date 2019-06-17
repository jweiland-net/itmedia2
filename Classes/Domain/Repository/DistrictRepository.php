<?php
declare(strict_types=1);
namespace JWeiland\Itmedia2\Domain\Repository;

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
 * A repository to search for districts. Needed for selectbox.
 *
 * We use the district table of yellowpages2 here to prevent duplicates.
 */
class DistrictRepository extends \JWeiland\Yellowpages2\Domain\Repository\DistrictRepository
{
}
