<?php return array(
    'root' => array(
        'pretty_version' => '0.0.1',
        'version' => '0.0.1.0',
        'type' => 'wordpress-plugin',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => 'schmitzoide/wp-react-backend',
        'dev' => true,
    ),
    'versions' => array(
        'schmitzoide/wp-react-backend' => array(
            'pretty_version' => '0.0.1',
            'version' => '0.0.1.0',
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
        'squizlabs/php_codesniffer' => array(
            'pretty_version' => '3.7.1',
            'version' => '3.7.1.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../squizlabs/php_codesniffer',
            'aliases' => array(),
            'reference' => '1359e176e9307e906dc3d890bcc9603ff6d90619',
            'dev_requirement' => true,
        ),
        'wp-coding-standards/wpcs' => array(
            'pretty_version' => '2.3.0',
            'version' => '2.3.0.0',
            'type' => 'phpcodesniffer-standard',
            'install_path' => __DIR__ . '/../wp-coding-standards/wpcs',
            'aliases' => array(),
            'reference' => '7da1894633f168fe244afc6de00d141f27517b62',
            'dev_requirement' => true,
        ),
    ),
);
