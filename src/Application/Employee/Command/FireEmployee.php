<?php
declare(strict_types=1);

namespace Al\Application\Employee\Command;

use SimpleBus\Message\Name\NamedMessage;

final class FireEmployee implements NamedMessage
{
    /** @var string */
    private $id;

    /** @var \DateTime */
    private $firedAt;

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
     * @return \DateTime
     */
    public function getFiredAt()
    {
        return $this->firedAt;
    }

    /**
     * @param \DateTime $fireAt
     */
    public function setFiredAt(\DateTime $fireAt)
    {
        $this->firedAt = $fireAt;
    }

    /**
     * {@inheritdoc}
     */
    public static function messageName(): string
    {
        return 'fire_employee';
    }
}
