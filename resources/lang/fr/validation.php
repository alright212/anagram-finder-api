<?php

return [
    'required' => 'Le champ :attribute est obligatoire.',
    'boolean' => 'Le champ :attribute doit être vrai ou faux.',
    'string' => 'Le champ :attribute doit être une chaîne de caractères.',
    'max' => [
        'string' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
    ],
    'min' => [
        'string' => 'Le champ :attribute doit faire au moins :min caractères.',
    ],
    'email' => 'Le champ :attribute doit être une adresse e-mail valide.',
    'unique' => 'Ce :attribute est déjà utilisé.',
    'exists' => 'Le :attribute sélectionné est invalide.',
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'integer' => 'Le champ :attribute doit être un entier.',
    'size' => [
        'string' => 'Le champ :attribute doit faire exactement :size caractères.',
    ],
    'in' => 'Le :attribute sélectionné est invalide.',
    'not_in' => 'Le :attribute sélectionné est interdit.',
    'array' => 'Le champ :attribute doit être un tableau.',
    'date' => 'Le champ :attribute doit être une date valide.',
    'url' => 'Le champ :attribute doit être une URL valide.',
    'confirmed' => 'La confirmation du champ :attribute ne correspond pas.',
    'same' => 'Les champs :attribute et :other doivent être identiques.',
    'different' => 'Les champs :attribute et :other doivent être différents.',
    'after' => 'Le champ :attribute doit être une date après :date.',
    'before' => 'Le champ :attribute doit être une date avant :date.',
    'json' => 'Le champ :attribute doit être une chaîne JSON valide.',

    'custom' => [
        'locale' => [
            'in' => 'La langue sélectionnée n\'est pas supportée.',
        ],
        'force' => [
            'boolean' => 'Le paramètre force doit être vrai ou faux.',
        ],
    ],

    'attributes' => [
        'locale' => 'langue',
        'force' => 'forcer',
        'word' => 'mot',
    ],
];
