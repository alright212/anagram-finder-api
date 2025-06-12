<?php

return [
    'required' => 'Väli :attribute on kohustuslik.',
    'boolean' => 'Väli :attribute peab olema tõene või väär.',
    'string' => 'Väli :attribute peab olema tekst.',
    'max' => [
        'string' => 'Väli :attribute ei tohi olla pikem kui :max tähemärki.',
    ],
    'min' => [
        'string' => 'Väli :attribute peab olema vähemalt :min tähemärki pikk.',
    ],
    'email' => 'Väli :attribute peab olema kehtiv e-posti aadress.',
    'unique' => 'Selline :attribute on juba kasutusel.',
    'exists' => 'Valitud :attribute on vigane.',
    'numeric' => 'Väli :attribute peab olema number.',
    'integer' => 'Väli :attribute peab olema täisarv.',
    'size' => [
        'string' => 'Väli :attribute peab olema täpselt :size tähemärki pikk.',
    ],
    'in' => 'Valitud :attribute on vigane.',
    'not_in' => 'Valitud :attribute on keelatud.',
    'array' => 'Väli :attribute peab olema massiiv.',
    'date' => 'Väli :attribute peab olema kehtiv kuupäev.',
    'url' => 'Väli :attribute peab olema kehtiv URL.',
    'confirmed' => 'Väli :attribute kinnitus ei klapi.',
    'same' => 'Väljad :attribute ja :other peavad olema ühesugused.',
    'different' => 'Väljad :attribute ja :other peavad olema erinevad.',
    'after' => 'Väli :attribute peab olema kuupäev pärast :date.',
    'before' => 'Väli :attribute peab olema kuupäev enne :date.',
    'json' => 'Väli :attribute peab olema kehtiv JSON string.',

    'custom' => [
        'locale' => [
            'in' => 'Valitud keel pole toetatud.',
        ],
        'force' => [
            'boolean' => 'Jõustamise parameeter peab olema tõene või väär.',
        ],
    ],

    'attributes' => [
        'locale' => 'keel',
        'force' => 'jõustamine',
        'word' => 'sõna',
    ],
];
