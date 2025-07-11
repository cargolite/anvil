<?php

use App\Repositories\ConfigurationJsonRepository;

it('works without json file', function () {
    $repository = new ConfigurationJsonRepository(null, 'psr12');

    expect($repository->finder())->toBeEmpty()
        ->and($repository->rules())->toBeEmpty();
});

it('works with a remote json file', function () {
    $repository = new ConfigurationJsonRepository(dirname(__DIR__, 2).'/Fixtures/rules/anvil.json', 'psr12');

    expect($repository->rules())->toBe([
        'no_unused_imports' => false,
    ]);
});

it('may have rules options', function () {
    $repository = new ConfigurationJsonRepository(dirname(__DIR__, 2).'/Fixtures/rules/anvil.json', 'psr12');

    expect($repository->rules())->toBe([
        'no_unused_imports' => false,
    ]);
});

it('may have finder options', function () {
    $repository = new ConfigurationJsonRepository(dirname(__DIR__, 2).'/Fixtures/finder/anvil.json', null);

    expect($repository->finder())->toBe([
        'exclude' => [
            'my-dir',
        ],
        'notName' => [
            '*-my-file.php',
        ],
        'notPath' => [
            'path/to/excluded-file.php',
        ],
    ]);
});

it('may have a preset option', function () {
    $repository = new ConfigurationJsonRepository(dirname(__DIR__, 2).'/Fixtures/preset/anvil.json', null);

    expect($repository->preset())->toBe('laravel');
});

it('may have indent option', function () {
    $repository = new ConfigurationJsonRepository(dirname(__DIR__, 2).'/Fixtures/configs/anvil.json', null);

    expect($repository->indent())->toBe("\t");
});

it('may have lineEnding option', function () {
    $repository = new ConfigurationJsonRepository(dirname(__DIR__, 2).'/Fixtures/configs/anvil.json', null);

    expect($repository->lineEnding())->toBe("\r\n");
});

it('properly extend the base config file', function () {
    $repository = new ConfigurationJsonRepository(dirname(__DIR__, 2).'/Fixtures/extend/anvil.json', null);

    expect($repository->preset())->toBe('laravel')
        ->and($repository->rules())->toBe([
            'array_push' => true,
            'backtick_to_shell_exec' => true,
            'date_time_immutable' => true,
            'final_internal_class' => true,
            'final_public_method_for_abstract_class' => true,
            'fully_qualified_strict_types' => false,
            'global_namespace_import' => [
                'import_classes' => true,
                'import_constants' => true,
                'import_functions' => true,
            ],
            'declare_strict_types' => true,
            'lowercase_keywords' => true,
            'lowercase_static_reference' => true,
            'final_class' => true,
        ]);
});

it('throw an error if the extended configuration also has an extend', function () {
    $repository = new ConfigurationJsonRepository(dirname(__DIR__, 2).'/Fixtures/extend_recursive/anvil.json', null);

    $repository->finder();
})->throws(LogicException::class);
