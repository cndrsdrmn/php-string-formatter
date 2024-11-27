<?php

use Cndrsdrmn\PhpStringFormatter\StringFormatter;

it('bothify method can replaces `*` with random `#` or `?`, `#` with digits and `?` with letters', function (): void {
    $string = StringFormatter::bothify('Foo *###?');

    expect($string)->toMatch('/Foo \d{1}|[a-z]{1}\d{3}[a-z]{1}/');
});

it('numerify method which replaces `#` with digits and `%` with digits from 1-9', function (): void {
    $stringWithZero = StringFormatter::numerify('Foo ####');
    $stringWithoutZero = StringFormatter::numerify('Foo %%%%');

    expect($stringWithZero)
        ->toMatch('/Foo \d{4}/')
        ->and($stringWithoutZero)
        ->toMatch('/Foo [1-9]{4}/');
});

it('lexify method can replaces `?` with random lowercase letters', function (): void {
    $string = StringFormatter::bothify('Foo ????');

    expect($string)->toMatch('/Foo [a-z]{4}/');
});
