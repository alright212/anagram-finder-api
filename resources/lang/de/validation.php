<?php

return [
    'required' => 'Das Feld :attribute ist erforderlich.',
    'boolean' => 'Das Feld :attribute muss wahr oder falsch sein.',
    'string' => 'Das Feld :attribute muss eine Zeichenkette sein.',
    'max' => [
        'string' => 'Das Feld :attribute darf nicht länger als :max Zeichen sein.',
    ],
    'min' => [
        'string' => 'Das Feld :attribute muss mindestens :min Zeichen lang sein.',
    ],
    'email' => 'Das Feld :attribute muss eine gültige E-Mail-Adresse sein.',
    'unique' => 'Dieses :attribute ist bereits vergeben.',
    'exists' => 'Das ausgewählte :attribute ist ungültig.',
    'numeric' => 'Das Feld :attribute muss eine Zahl sein.',
    'integer' => 'Das Feld :attribute muss eine Ganzzahl sein.',
    'size' => [
        'string' => 'Das Feld :attribute muss genau :size Zeichen lang sein.',
    ],
    'in' => 'Das ausgewählte :attribute ist ungültig.',
    'not_in' => 'Das ausgewählte :attribute ist verboten.',
    'array' => 'Das Feld :attribute muss ein Array sein.',
    'date' => 'Das Feld :attribute muss ein gültiges Datum sein.',
    'url' => 'Das Feld :attribute muss eine gültige URL sein.',
    'confirmed' => 'Die :attribute Bestätigung stimmt nicht überein.',
    'same' => 'Die Felder :attribute und :other müssen übereinstimmen.',
    'different' => 'Die Felder :attribute und :other müssen unterschiedlich sein.',
    'after' => 'Das Feld :attribute muss ein Datum nach :date sein.',
    'before' => 'Das Feld :attribute muss ein Datum vor :date sein.',
    'json' => 'Das Feld :attribute muss ein gültiger JSON-String sein.',

    'custom' => [
        'locale' => [
            'in' => 'Die ausgewählte Sprache wird nicht unterstützt.',
        ],
        'force' => [
            'boolean' => 'Der Zwangsparameter muss wahr oder falsch sein.',
        ],
    ],

    'attributes' => [
        'locale' => 'Sprache',
        'force' => 'Zwang',
        'word' => 'Wort',
    ],
];
