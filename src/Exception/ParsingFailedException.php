<?php
/**
 * (c) Steve Nebes <snebes@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace SN\HtmlSanitizer\Exception;

use SN\HtmlSanitizer\Parser\ParserInterface;

/**
 * @author Steve Nebes <snebes@gmail.com>
 */
class ParsingFailedException extends \InvalidArgumentException
{
    /**
     * @var ParserInterface
     */
    private $parser;

    public function __construct(ParserInterface $parser, \Throwable $previous = null)
    {
        parent::__construct('HTML parsing failed using parser '.get_class($parser), 0, $previous);

        $this->parser = $parser;
    }

    public function getParser(): ParserInterface
    {
        return $this->parser;
    }
}
