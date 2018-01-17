<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute moet geaccepteerd worden.',
    'active_url'           => ':attribute is geen geldig adres.',
    'after'                => ':attribute moet een datum zijn na :date zijn.',
    'alpha'                => ':attribute mag alleen letters bevatten.',
    'alpha_dash'           => ':attribute mag alleen letters, nummers en streepjes ( - en _ ) bevatten.',
    'alpha_num'            => ':attribute mag alleen letters en nummers bevatten.',
    'array'                => ':attribute moet een array zijn.',
    'before'               => ':attribute moet een datum voor :date zijn.',
    'between'              => [

        'numeric' => ':attribute moet tussen :min en :max zijn.',
        'file'    => ':attribute moet tussen :min en :max kilobytes zijn.',
        'string'  => ':attribute moet tussen :min en :max karakters lang zijn.',
        'array'   => ':attribute moet tussen :min en :max items bevatten.',
    ],
    'boolean'              => ':attribute moet ja of nee zijn.',
    'confirmed'            => ':attribute bevestiging komt niet overeen.',
    'date'                 => ':attribute moet een datum zijn.',
    'date_format'          => ':attribute is niet het geldige datum format, :format.',
    'different'            => ':attribute en :other moeten verschillend zijn.',
    'digits'               => ':attribute moet bestaan uit :digits cijfers.',
    'digits_between'       => ':attribute moet minimaal :min en maximaal :max cijfers zijn.',
    'distinct'             => ':attribute heeft een dubbele waarde.',
    'email'                => ':attribute moet een geldig e-mailadres zijn.',
    'exists'               => ':attribute bestaat niet.',
    'filled'               => ':attribute is verplicht.',
    'image'                => ':attribute moet een afbeelding zijn.',
    'in'                   => ':attribute is ongeldig.',
    'in_array'             => ':attribute bestaat niet in :other.',
    'integer'              => ':attribute moet een getal zijn.',
    'ip'                   => ':attribute moet een geldig IP-adres zijn.',
    'json'                 => ':attribute moet een geldige JSON String zijn.',
    'max'                  => [
        'numeric' => ':attribute mag niet hoger dan :max.',
        'file'    => ':attribute mag niet meer dan :max kilobytes zijn.',
        'string'  => ':attribute mag niet uit meer dan :max karakters bestaan.',
        'array'   => ':attribute mag niet meer dan :max items bevatten.',
    ],
    'mimes'                => ':attribute moet het bestandstype, :values hebben.',
    'min'                  => [
        'numeric' => ':attribute moet minimaal :min zijn.',
        'file'    => ':attribute moet minimaal :min kilobytes zijn.',
        'string'  => ':attribute moet minimaal :min characters zijn.',
        'array'   => ':attribute moet minimaal :min items bevatten.',
    ],
    'not_in'               => 'Het formaat van :attribute is ongeldig.',
    'numeric'              => ':attribute moet een nummer zijn.',
    'present'              => ':attribute moet bestaan.',
    'regex'                => ':attribute format is ongeldig.',
    'required'             => ':attribute is verplicht.',
    'required_if'          => ':attribute is verplicht als :other gelijk is aan :value.',
    'required_unless'      => ':attribute is verplicht tenzij :other gelijk is aan :values.',
    'required_with'        => ':attribute is verplicht wanneer :values bestaat.',
    'required_with_all'    => ':attribute is verplicht wanneer :values bestaat.',
    'required_without'     => ':attribute is verplicht wanneer :values niet bestaat.',
    'required_without_all' => ':attribute is verplicht wanneer :values niet bestaan.',
    'same'                 => ':attribute en :other moeten hetzelfde zijn.',
    'size'                 => [
        'numeric' => ':attribute moet :size zijn.',
        'file'    => ':attribute moet :size kilobytes zijn.',
        'string'  => ':attribute moet :size characters zijn.',
        'array'   => ':attribute moet :size items bevatten',
    ],
    'string'               => ':attribute moet tekst zijn.',
    'timezone'             => ':attribute moet een geldige tijdzone zijn.',
    'unique'               => ':attribute is al in gebruik.',
    'url'                  => ':attribute is geen geldig URL.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
