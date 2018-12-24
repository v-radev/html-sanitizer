<?php

/*
 * This file is part of the HTML sanitizer project.
 *
 * (c) Steve Nebes <snebes@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HtmlSanitizer\Node;

/**
 * Special node to ignore scripts and all their content.
 *
 * @author Steve Nebes <snebes@gmail.com>
 *
 * @internal
 */
class ScriptNode extends AbstractTagNode
{
    use IsChildlessTrait;

    public function getTagName(): string
    {
        return 'script';
    }

    public function render(): string
    {
        return '';
    }
}
