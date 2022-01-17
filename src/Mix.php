<?php
/**
 * Laravel Mix plugin for Craft CMS 3.x
 *
 * Twig utility function to handle Laravel Mix files for Craft CMS.
 *
 * @link      https://github.com/bryaneschultz
 * @copyright Copyright (c) 2022 Bryan E. Schultz
 */

namespace bryaneschultz\mix;

use bryaneschultz\mix\services\MixService;
use bryaneschultz\mix\twigextensions\MixTwigExtension;

use Craft;
use craft\base\Plugin;

/**
 * Class Mix
 * @Mix
 * @extends Plugin
 *
 * @property  MixService    mix
 *
 * @author    Bryan E. Schultz
 * @package   Craft-Mix
 * @since     1.0.0
 */
class Mix extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Mix
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @inheritdoc
     */
    public $name = 'Mix';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        $this->setComponents([
            'mix' => MixService::class,
        ]);

        Craft::setAlias('@craftMix', $this->getBasePath());

        Craft::$app->getRequest()->setIsConsoleRequest(false);
        Craft::$app->view->registerTwigExtension(new MixTwigExtension());

        Craft::info(
            Craft::t(
                'craft-mix',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
