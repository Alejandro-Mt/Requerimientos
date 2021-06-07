<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | El following language lines contain El default error messages used by
    | El validator class. Some of Else rules have multiple versions such
    | as El size rules. Feel free to tweak each of Else messages here.
    |
    */

    'accepted' => 'El :attribute ha sido aceptado.',
    'active_url' => 'El :attribute no es una URL valida.',
    'after' => 'El :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'EL :attribute Solo debe contener letras.',
    'alpha_dash' => 'El :attribute solo debe contener letras, numeros y guiones.',
    'alpha_num' => 'El :attribute solo debe contener letras y numeros.',
    'array' => 'El :attribute debe ser una matriz.',
    'before' => 'El :attributedebe ser una fecha anterior a :date.',
    'before_or_equal' => 'El :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'file' => 'El :attribute debe estar entre :min y :max kilobytes.',
        'string' => 'El :attribute debe estar entre :min y :max caracteres.',
        'array' => 'El :attribute must have between :min y :max items.',
    ],
    'boolean' => 'El :attribute debe ser verdadero o falso.',
    'confirmed' => 'El :attribute confirmacion no conicide.',
    'date' => 'El :attribute no es una fecha valida.',
    'date_equals' => 'El :attribute debe ser igual a :date.',
    'date_format' => 'El :attribute no coincide con el formato :format.',
    'different' => 'El :attribute y :other deben ser diferentes.',
    'digits' => 'El :attribute deben ser :digits digitos.',
    'digits_between' => 'El :attribute debe estar entre :min y :max digitos.',
    'dimensions' => 'El :attribute no es una dimencion valida.',
    'distinct' => 'El :attribute campo es un valor duplicado.',
    'email' => 'El :attribute no es una direccion valida.',
    'ends_with' => 'El :attribute puede terminar con: :values.',
    'exists' => 'El :attribute seleccionado no es valido.',
    'file' => 'El :attribute debe ser in archivo.',
    'filled' => 'El :attribute campo debe tener valor.',
    'gt' => [
        'numeric' => 'El :attribute debe ser mayor a :value.',
        'file' => 'El :attribute debe ser mayor a :value kilobytes.',
        'string' => 'El :attribute debe ser mayor a :value caracteres.',
        'array' => 'El :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'El :attribute debe ser mayor o igual a :value.',
        'file' => 'El :attribute debe ser mayor o igual a :value kilobytes.',
        'string' => 'El :attribute debe ser mayor o igual a :value characters.',
        'array' => 'El :attribute debe contener :value items o mas.',
    ],
    'image' => 'El :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado no es valido.',
    'in_array' => 'El :attribute campo no existe en :other.',
    'integer' => 'El :attribute debe ser un entero.',
    'ip' => 'El :attribute debe ser una IP valida.',
    'ipv4' => 'El :attribute must debe ser una IPv4 valida.',
    'ipv6' => 'El :attribute must debe ser una IPv6 valida.',
    'json' => 'El :attribute must debe ser un JSON valido.',
    'lt' => [
        'numeric' => 'El :attribute debe ser menor a :value.',
        'file' => 'El :attribute debe ser menor a :value kilobytes.',
        'string' => 'El :attribute debe ser menor a :value caracteres.',
        'array' => 'El :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'El :attribute debe ser menor o igual a :value.',
        'file' => 'El :attribute debe ser menor o igual a :value kilobytes.',
        'string' => 'El :attribute debe ser menor o igual a :value caracteres.',
        'array' => 'El :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'El :attribute no debe ser mayor a :max.',
        'file' => 'El :attribute no debe ser mayor a :max kilobytes.',
        'string' => 'El :attribute no debe ser mayor a :max caracteres.',
        'array' => 'El :attribute must not have more than :max items.',
    ],
    'mimes' => 'El :attribute debe ser un archivo tipo: :values.',
    'mimetypes' => 'El :attribute debe ser un archivo tipo: :values.',
    'min' => [
        'numeric' => 'El :attribute debe ser minimo de :min.',
        'file' => 'El :attribute debe ser minimo de :min kilobytes.',
        'string' => 'El :attribute debe ser minimo de :min caracteres.',
        'array' => 'El :attribute debe contener minimo :min items.',
    ],
    'multiple_of' => 'El :attribute debe ser un multiplo de :value.',
    'not_in' => 'El :attribute seleccionado no es valido.',
    'not_regex' => 'El :attribute formato no es valido.',
    'numeric' => 'El :attribute debe ser un numero.',
    'password' => 'La contraseña es incorrecta.',
    'present' => 'El :attribute campo debe estar presente.',
    'regex' => 'El formato de :attribute no es valido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless' => 'El campo :attribute es obligatorio excepto cuando :other esta en :values.',
    'required_with' => 'El campo:attribute es obligatorio cuando :values esta presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values estan presentes.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no estan presentes.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values estan presentes.',
    'prohibited' => 'El campo :attribute esta bloqueado.',
    'prohibited_if' => 'El campo :attribute esta bloqueado cuando :other esta :value.',
    'prohibited_unless' => 'El campo :attribute esta bloqueado excepto si :other esta en :values.',
    'same' => 'El campo :attribute y :other no coinciden.',
    'size' => [
        'numeric' => 'El :attribute debe ser igual a :size.',
        'file' => 'El :attribute debe pesar :size kilobytes.',
        'string' => 'El :attribute debe contener :size caracteres.',
        'array' => 'El :attribute debe contener :size items.',
    ],
    'starts_with' => 'El :attribute debe comensar con: :values.',
    'string' => 'El :attribute debe ser texto.',
    'timezone' => 'El :attribute debe ser una zona valida.',
    'unique' => 'El :attribute ya ha sido registrada.',
    'uploaded' => 'El :attribute ha sido actualizado.',
    'url' => 'El formato :attribute no es valido.',
    'uuid' => 'El :attribute debe ser un UUID valido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using El
    | convention "attribute.rule" to name El lines. This makes it quick to
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
    | El following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
