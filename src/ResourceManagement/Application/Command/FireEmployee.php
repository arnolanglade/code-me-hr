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

namespace Al\ResourceManagement\Application\Command;

use Ramsey\Uuid\Uuid;
use SimpleBus\Message\Name\NamedMessage;

final class FireEmployee implements NamedMessage
{
    /** @var Uuid */
    public $id;

    /** @var \DateTime */
    public $firedAt;

    public function __construct(string $id)
    {
        $this->id = Uuid::fromString($id);
        $this->firedAt = new \DateTime('now');
    }

    /**
     * {@inheritdoc}
     */
    public static function messageName(): string
    {
        return 'fire_employee';
    }
}
