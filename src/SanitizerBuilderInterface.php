<?php

/*
 * This file is part of the HTML sanitizer project.
 *
 * (c) Steve Nebes <snebes@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HtmlSanitizer;

use HtmlSanitizer\Extension\ExtensionInterface;

/**
 * Create a sanitizer using sanitizer extensions and configuration.
 *
 * @author Steve Nebes <snebes@gmail.com>
 */
interface SanitizerBuilderInterface
{
    /**
     * Register an extension to use in the sanitizer being built.
     *
     * @param ExtensionInterface $extension
     */
    public function registerExtension(ExtensionInterface $extension);

    /**
     * Build the sanitizer using the given configuration.
     *
     * @param array $config
     *
     * @return SanitizerInterface
     */
    public function build(array $config): SanitizerInterface;
}
