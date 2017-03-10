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

final class FireEmployee implements NamedMessage
{
    /** @var string */
    private $id;

    /** @var \DateTime */
    private $firedAt;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
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
    public function setFiredAt($fireAt)
    {
        $this->firedAt = $fireAt;
    }

    /**
     * {@inheritdoc}
     */
    public static function messageName()
    {
        return 'fire_employee';
    }
}
