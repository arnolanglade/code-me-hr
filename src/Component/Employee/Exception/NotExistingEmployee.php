<?php
declare(strict_types=1);

/*
 * This file is part of the AL labs package
 *
 * (c) Arnaud Langlade
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\Employee\Exception;

use Exception;

class NotExistingEmployee extends \Exception
{
    public function __construct($identifier, $code = 0, Exception $previous = null)
    {
        parent::__construct(
            sprintf('There is not employee with identifier "%s"', $identifier),
            $code,
            $previous
        );
    }
}