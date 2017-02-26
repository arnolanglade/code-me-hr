<?php

namespace Al\Component\Employee\Command;

class FireEmployee
{
    /** @var \DateTime */
    private $firedAt;

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
}
