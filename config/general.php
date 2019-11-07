<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use Platformsh\ConfigReader\Config;

$config = new Config;

$settings = [
    // Craft config settings from .env variables
    'aliases' => [
        '@assetsUrl' => getenv('ASSETS_URL'),
        '@cloudfrontUrl' => getenv('CLOUDFRONT_URL'),
        '@web' => getenv('SITE_URL'),
        '@webroot' => getenv('WEB_ROOT_PATH'),
    ],
    'allowUpdates' => (bool)getenv('ALLOW_UPDATES'),
    'allowAdminChanges' => (bool)getenv('ALLOW_ADMIN_CHANGES'),
    'backupOnUpdate' => (bool)getenv('BACKUP_ON_UPDATE'),
    'devMode' => (bool)getenv('DEV_MODE'),
    'enableTemplateCaching' => (bool)getenv('ENABLE_TEMPLATE_CACHING'),
    'isSystemLive' => (bool)getenv('IS_SYSTEM_LIVE'),
    'resourceBasePath' => getenv('WEB_ROOT_PATH').'/cpresources',
    'runQueueAutomatically' => (bool)getenv('RUN_QUEUE_AUTOMATICALLY'),
    'securityKey' => getenv('SECURITY_KEY'),
    // Craft config settings from constants
    'cacheDuration' => false,
    'defaultSearchTermOptions' => [
        'subLeft' => true,
        'subRight' => true,
    ],
    'enableCsrfProtection' => true,
    'errorTemplatePrefix' => 'errors/',
    'generateTransformsBeforePageLoad' => true,
    'maxCachedCloudImageSize' => 3000,
    'maxUploadFileSize' => '100M',
    'omitScriptNameInUrls' => true,
    'useEmailAsUsername' => true,
    'usePathInfo' => true,
    'useProjectConfigFile' => true,
    'preserveImageColorProfiles' => true
];

if ($config->isValidPlatform()) {
    $settings['securityKey'] = $config->projectEntropy;

    if ($config->inRuntime()) {
        $settings['resourceBasePath'] = $config->documentRoot . '/cpresources';
        $settings['trusted_host_patterns'] = [];

        foreach ($config->routes() as $url => $route) {
            if ($route['primary'] == true) {
                $settings['aliases']['@assetsUrl'] = $url . 'assets';
                $settings['aliases']['@web'] = $url;
                $settings['siteUrl'] = $url;
            }
        }

        $settings['aliases']['@webroot'] = $config->documentRoot;

        $settings['isSystemLive'] = true;
        $settings['devMode'] = false;
        $settings['enableTemplateCaching'] = true;
        $settings['allowAdminChanges'] = true;
        $settings['backupOnUpdate'] = true;
        $settings['allowUpdates'] = false;
        $settings['runQueueAutomatically'] = false;
    }
}

return $settings;