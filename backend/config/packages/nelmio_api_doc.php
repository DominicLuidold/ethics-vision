<?php

declare(strict_types=1);

use Symfony\Config\NelmioApiDocConfig;

return static function (NelmioApiDocConfig $nelmioApiDoc): void {
    $nelmioApiDoc
        ->documentation('info', [
            'title' => 'EthicsVision',
            'description' => 'API documentation for EthicsVision',
            'version' => '0.0.1',
        ]);

    $nelmioApiDoc->areas('default', ['path_patterns' => ['^/api(?!/docs)']]);
};
