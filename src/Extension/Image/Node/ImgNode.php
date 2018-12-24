<?php

/*
 * This file is part of the HTML sanitizer project.
 *
 * (c) Steve Nebes <snebes@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HtmlSanitizer\Extension\Image\Node;

use HtmlSanitizer\Node\AbstractTagNode;
use HtmlSanitizer\Node\IsChildlessTrait;

/**
 * @author Steve Nebes <snebes@gmail.com>
 *
 * @final
 */
class ImgNode extends AbstractTagNode
{
    use IsChildlessTrait;

    public function getTagName(): string
    {
        return 'img';
    }
}
