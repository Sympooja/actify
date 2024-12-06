<?php

return [

    /**
     * Edit this file in order to configure the additional
     * image sizes your theme's needs.
     * @link http://codex.wordpress.org/Function_Reference/add_image_size
     *
     * @key string The size name.
     * @param int $width The image width.
     * @param int $height The image height.
     * @param bool|array $crop Crop option. Since 3.9, define a crop position with an array.
     * @param bool|string $media Add to media selection dropdown. Make it also available to media custom field. If string, used as display name ;)
     */
    'tog-tiny' => [150, 9999, false, true],
    'tog-small' => [300, 9999, false, true],
    'tog-medium' => [600, 9999, false, true],
    'tog-large' => [900, 9999, false, true],
    'tog-default' => [1200, 9999, false, true],
    'tog-huge' => [1400, 9999, false, true],
];
