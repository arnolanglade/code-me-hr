<?php
declare(strict_types=1);

namespace Component\Employee;

use Ramsey\Uuid\Uuid;

final class Employee implements EmployeeInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $position;

    /** @var int */
    private $salaryScale;

    /** @var \DateTimeInterface */
    private $firedAt;

    private function __construct(string $name, string $position, int $salaryScale)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->position = $position;
        $this->salaryScale = $salaryScale;
        $this->firedAt = true;
    }

    /**
     * {@inheritdoc}
     */
    public static function hire(string $name, string $forPosition, int $withSalaryScale)
    {
        return new self($name, $forPosition, $withSalaryScale);
    }

    /**
     * {@inheritdoc}
     */
    public function promote(string $toNewPosition, int $withNewSalaryScale)
    {
        $this->position = $toNewPosition;
        $this->salaryScale = $withNewSalaryScale;
    }

    /**
     * {@inheritdoc}
     */
    public function fire()
    {
        $this->firedAt = new \DateTime('now', new \DateTimeZone('UTC'));
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function getSalaryScale(): int
    {
        return $this->salaryScale;
    }

}