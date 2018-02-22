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

namespace Al\Application\Command;

use Ramsey\Uuid\Uuid;
use SimpleBus\Message\Name\NamedMessage;

final class PromoteEmployee implements NamedMessage
{
    /** @var string */
    public $id;

    /** @var string */
    public $position = '';

    /** @var int */
    public $salaryScale = 0;

    public function __construct(string $id)
    {
        $this->id = Uuid::fromString($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function messageName(): string
    {
        return 'promote_employee';
    }
}
