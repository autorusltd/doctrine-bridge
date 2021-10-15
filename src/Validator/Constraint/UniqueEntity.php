<?php declare(strict_types=1);

/**
 * It's free open-source software released under the MIT License.
 *
 * @author Anatoly Fenric <anatoly@fenric.ru>
 * @copyright Copyright (c) 2020, Anatoly Fenric
 * @license https://github.com/sunrise-php/doctrine-bridge/blob/master/LICENSE
 * @link https://github.com/sunrise-php/doctrine-bridge
 */

namespace Sunrise\Bridge\Doctrine\Validator\Constraint;

/**
 * Import classes
 */
use Attribute;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 * @Target({"CLASS"})
 *
 * @NamedArgumentConstructor
 *
 * @Attributes({
 *   @Attribute("fields", type="array<string>", required=true),
 *   @Attribute("message", type="string"),
 *   @Attribute("atPath", type="string"),
 *   @Attribute("em", type="string"),
 * })
 */
#[Attribute(Attribute::TARGET_CLASS|Attribute::IS_REPEATABLE)]
class UniqueEntity extends Constraint
{

    /**
     * @var string
     */
    public const NOT_UNIQUE_ERROR = 'd3cf3b2e-f934-422e-ae60-b4eca745aa33';

    /**
     * @var string[]
     */
    public $fields;

    /**
     * @var string
     */
    public $message = 'The value {{ value }} is not unique.';

    /**
     * @var string|null
     */
    public $atPath = null;

    /**
     * @var string|null
     */
    public $em = null;

    /**
     * @param string[] $fields
     * @param string|null $message
     * @param string|null $atPath
     * @param string|null $em
     */
    public function __construct(
        array $fields,
        ?string $message = null,
        ?string $atPath = null,
        ?stirng $em = null
    ) {
        if (null === $message) {
            $message = $this->message;
        }

        $this->fields = $fields;
        $this->message = $message;
        $this->atPath = $atPath;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return [self::CLASS_CONSTRAINT];
    }

    /**
     * {@inheritdoc}
     */
    public function getRequiredOptions()
    {
        return ['fields'];
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOption()
    {
        return 'fields';
    }
}
