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

namespace Al\Application\Employee\Command;

use SimpleBus\Message\Name\NamedMessage;

final class HireEmployee implements NamedMessage
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $position = '';

    /** @var int */
    public $salaryScale = 0;

    /** @var \DateTimeInterface */
    public $hiredAt;

    public function __construct()
    {
        $this->hiredAt = new \DateTime('now');
    }

    /**
     * {@inheritdoc}
     */
    public static function messageName(): string
    {
        return 'hire_employee';
    }
}
