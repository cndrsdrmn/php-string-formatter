<?php

use Cndrsdrmn\PhpStringFormatter\StringFormatter;

it('bothify method can replaces `*` with random `#` or `?`, `#` with digits and `?` with letters', function (): void {
    $string = StringFormatter::bothify('Foo *###?');

    expect($string)->toMatch('/Foo \d{1}|[a-z]{1}\d{3}[a-z]{1}/');
});

it('bothify generation to be controlled', function (): void {
    StringFormatter::createBothifyUsing(fn (): string => 'bothify');

    expect(StringFormatter::bothify('Foo *###?'))->toBe('bothify');

    StringFormatter::createBothifyNormally();

    expect(StringFormatter::bothify('Foo *###?'))
        ->toMatch('/Foo \d{1}|[a-z]{1}\d{3}[a-z]{1}/')
        ->not->toBe('bothify');
});

it('numerify method which replaces `#` with digits and `%` with digits from 1-9', function (): void {
    $stringWithZero = StringFormatter::numerify('Foo ####');
    $stringWithoutZero = StringFormatter::numerify('Foo %%%%');

    expect($stringWithZero)
        ->toMatch('/Foo \d{4}/')
        ->and($stringWithoutZero)
        ->toMatch('/Foo [1-9]{4}/');
});

it('numerify generation to be controlled', function (): void {
    StringFormatter::createNumerifyUsing(fn (): string => 'number');

    expect(StringFormatter::numerify('Foo ####'))->toBe('number');

    StringFormatter::createNumerifyNormally();

    expect(StringFormatter::numerify('Foo %%%%'))
        ->toMatch('/Foo \d{4}/')
        ->toMatch('/Foo [1-9]{4}/')
        ->not->toBe('number');
});

it('lexify method can replaces `?` with random lowercase letters', function (): void {
    $string = StringFormatter::lexify('Foo ????');

    expect($string)->toMatch('/Foo [a-z]{4}/');
});

it('lexify generation to be controlled', function (): void {
    StringFormatter::createLexifyUsing(fn (): string => 'letter');

    expect(StringFormatter::lexify('Foo ????'))->toBe('letter');

    StringFormatter::createLexifyNormally();

    expect(StringFormatter::lexify('Foo ????'))
        ->toMatch('/Foo [a-z]{4}/')
        ->not->toBe('letter');
});
