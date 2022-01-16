<?php
/**
 * Laravel Mix plugin for Craft CMS 3.x
 *
 * Twig utility function to handle Laravel Mix files for Craft CMS.
 *
 * @link      https://github.com/bryaneschultz
 * @copyright Copyright (c) 2022 Bryan E. Schultz
 */

namespace bryaneschultz\mix\twigextensions;

use bryaneschultz\mix\Mix;

use Twig\Extension\AbstractExtension;
use Twig\Markup;
use Twig\TwigFunction;

/**
 * Class MixTwigExtension
 * @MixTwigExtension
 * @extends AbstractExtension
 *
 * @property  array  getFunctions
 * @property  string mix
 *
 * @author    Bryan E. Schultz
 * @package   Craft-Mix
 * @since     1.0.0
 */
class MixTwigExtension extends AbstractExtension
{
    /**
     * @inheritdoc
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('mix', [$this, 'mix'],
                ['is_safe' => ['html'], 'preserves_safety' => true]),
        ];
    }

    /**
     * Returns the outputted version of the file name from the Laravel manifest file.
     *
     * @public
     *
     * @param  string  $file
     * @param  boolean $version
     * @param  boolean $html
     *
     * @return string
     * @since  1.0.0
     */
    public function mix(string $file, bool $version = true, bool $html = false): string
    {
        if ($html) {
            $markup = Mix::$plugin->mix->mix($file, $version, true);

            return new Markup($markup, 'UTF-8');
        }

        return Mix::$plugin->mix->mix($file, $version);
    }
}
