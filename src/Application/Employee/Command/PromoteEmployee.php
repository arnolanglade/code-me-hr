<?php
declare(strict_types=1);

namespace Al\Application\Employee\Command;

use SimpleBus\Message\Name\NamedMessage;

final class PromoteEmployee implements NamedMessage
{
    /** @var string */
    private $id;

    /** @var string */
    private $position = '';

    /** @var int */
    private $salaryScale = 0;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position)
    {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getSalaryScale(): int
    {
        return $this->salaryScale;
    }

    /**
     * @param int $withSalaryScale
     */
    public function setSalaryScale(int $withSalaryScale)
    {
        $this->salaryScale = $withSalaryScale;
    }

    /**
     * {@inheritdoc}
     */
    public static function messageName(): string
    {
        return 'promote_employee';
    }
}
