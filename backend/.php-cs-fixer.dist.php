<?php

declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PHP82Migration' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'declare_strict_types' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'php_unit_strict' => true,
        'single_line_throw' => false,
        'strict_comparison' => true,
        'strict_param' => true,
    ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__.'/.php-cs-fixer.cache')
    ->setRiskyAllowed(true);
