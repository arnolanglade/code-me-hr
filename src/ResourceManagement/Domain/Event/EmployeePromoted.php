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

namespace Al\ResourceManagement\Domain\Event;

use SimpleBus\Message\Name\NamedMessage;

final class EmployeePromoted implements NamedMessage
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $position;

    public function __construct(string $id, string $name, string $position)
    {
        $this->id = $id;
        $this->name = $name;
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getEmployeeId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmployeeName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmployeePosition(): string
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public static function messageName(): string
    {
        return 'employee_promoted';
    }
}
