<?php
/**
 * Laravel Mix plugin for Craft CMS 3.x
 *
 * Twig utility function to handle Laravel Mix files for Craft CMS.
 *
 * @link      https://github.com/bryaneschultz
 * @copyright Copyright (c) 2022 Bryan E. Schultz
 */

namespace bryaneschultz\mix\services;

use Craft;
use craft\base\Component;
use craft\helpers\UrlHelper;

use yii\helpers\Json;

/**
 * Class MixService
 * @MixService
 * @extends Component
 *
 * @property       string  mix
 * @property-read  string  $path
 *
 * @author    Bryan E. Schultz
 * @package   Craft-Mix
 * @since     1.0.0
 */
class MixService extends Component
{
    // Private Properties
    // =========================================================================

    /**
     * Alias for webroot.
     *
     * @var   string
     * @since 1.0.0
     */
    private $webroot = '@webroot';

    /**
     * Laravel Mix manifest file.
     *
     * @var   string
     * @since 1.0.0
     */
    private $manifest = 'mix-manifest.json';

    /**
     * Regular expressions for Laravel manifest file.
     *
     * @var   array|string[]
     * @since 1.0.0
     */
    private $regex = [
        '/[.\/]?css[\/]?/i',
        '/[.\/]?js[\/]?/i',
    ];


    // Public Methods
    // =========================================================================

    /**
     * Get outputted version of the file name from the Laravel manifest file.
     *
     * @param  string  $file
     * @param  boolean $version
     * @param  boolean $html
     * @return string
     * @since  1.0.0
     */
    public function mix(string $file, bool $version = true, bool $html = false): string
    {
        $manifest = $this->read();

        if ($manifest && $file) {
            $key = DIRECTORY_SEPARATOR . $file;

            if (array_key_exists($key, $manifest)) {
                $path = $version ?
                            ltrim($manifest[$key], '/') :
                            ltrim($key, '/');

                return $this->getUrl($path, $html);
            }
        }

        Craft::warning(
            Craft::t(
                'mix',
                'Unable to locate the key [{file}] in manifest file.',
                ['file' => $file]
            ),
            __METHOD__
        );

        return $this->getUrl($file, $html);
    }

    // Private Methods
    // =========================================================================

    /**
     * Returns the path to the Laravel manifest file.
     *
     * @private
     * @return string
     * @since  1.0.0
     */
    private function getPath(): string
    {
        return Craft::getAlias($this->webroot) . DIRECTORY_SEPARATOR . $this->manifest;
    }

    /**
     * Return the full url path of asset.
     *
     * @param  string  $path
     * @param  boolean $html
     * @return string
     * @since  1.0.0
     */
    private function getUrl(string $path, bool $html = false): string
    {
        $url = UrlHelper::url($path);

        if ($html && preg_match($this->regex[0], $url)) {
            return sprintf('<link rel="stylesheet" href="%s">', $url);
        }

        if ($html && preg_match($this->regex[1], $url)) {
            return sprintf('<script src="%s"></script>', $url);
        }

        return $url;
    }

    /**
     * Read and return the contents of the Laravel manifest file.
     *
     * @private
     * @return array|boolean
     * @since  1.0.0
     */
    private function read(): array
    {
        if (file_exists($this->getPath())) {
            $manifest = file_get_contents($this->getPath());

            return Json::decode($manifest, true);
        }

        Craft::warning(
            Craft::t(
                'mix',
                'Unable to locate manifest file.'
            ),
            __METHOD__
        );

        return false;
    }
}
