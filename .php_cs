<?php
$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in('config')
    ->in('src');
$config = Symfony\CS\Config\Config::create();
$config->setUsingCache(true);
$config->level(Symfony\CS\FixerInterface::PSR2_LEVEL);
$config->fixers(
    array(
        'braces',
        'duplicate_semicolon',
        'elseif',
//        'empty_return',
        'encoding',
        'eof_ending',
        'function_call_space',
        'function_declaration',
        'indentation',
        'join_function',
        'line_after_namespace',
        'linefeed',
        'lowercase_constants',
        'lowercase_keywords',
        'parenthesis',
        'multiple_use',
        'method_argument_space',
        'newline_after_open_tag',
        'no_blank_lines_before_namespace',
        'object_operator',
        'ordered_use',
        'php_closing_tag',
        'remove_lines_between_uses',
        'short_array_syntax',
        'short_tag',
        'standardize_not_equal',
        'trailing_spaces',
        'unused_use',
        'visibility',
        'whitespacy_lines',
    )
);
$config->finder($finder);
return $config;
