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

    'accepted'             => 'Acest câmp ":attribute" trebuie să fie acceptat.',
    'active_url'           => 'Acest câmp ":attribute" nu reprezintă un URL valid.',
    'after'                => 'Acest câmp ":attribute" trebuie să fie o dată după :date.',
    'alpha'                => 'Acest câmp ":attribute" trebuie să conțină numai litere.',
    'alpha_dash'           => 'Acest câmp ":attribute" trebuie să conțină numai litere, numere, și cratime.',
    'alpha_num'            => 'Acest câmp ":attribute" trebuie să conțină numai litere și numere.',
    'array'                => 'Acest câmp ":attribute" trebuie să fie un tablou.',
    'before'               => 'Acest câmp ":attribute" trebuie să fie o dată înainte de :date.',
    'between'              => [
        'numeric' => 'Acest câmp ":attribute" trebuie să fie între :min și :max.',
        'file'    => 'Acest câmp ":attribute" trebuie să fie între :min și :max kilobiți.',
        'string'  => 'Acest câmp ":attribute" trebuie să fie între :min și :max caractere.',
        'array'   => 'Acest câmp ":attribute" trebuie să aibă între between :min și :max itemi.',
    ],
    'boolean'              => 'Acest câmp ":attribute" trebuie să fie true sau false.',
    'confirmed'            => 'Acest câmp ":attribute" de confirmare nu corespunde.',
    'date'                 => 'Acest câmp ":attribute" nu este o dată validă.',
    'date_format'          => 'Acest câmp ":attribute" nu corespunde acestui format :format.',
    'different'            => 'Acest câmp ":attribute" și :other trebuie să fie diferiți.',
    'digits'               => 'Acest câmp ":attribute" trebuie să fie de :digits cifre.',
    'digits_between'       => 'Acest câmp ":attribute" trebuie să fie între :min and :max cifre.',
    'distinct'             => 'Acest câmp ":attribute" are o valoare duplicată.',
    'email'                => 'Acest câmp ":attribute" trebuie să fie o adresă de email validă.',
    'exists'               => 'Acest câmp ":attribute" selectat este invalid.',
    'filled'               => 'Acest câmp ":attribute" este obligatoriu.',
    'image'                => 'Acest câmp ":attribute" trebuie să fie o imagine.',
    'in'                   => 'Acest câmp ":attribute" selectat este invalid.',
    'in_array'             => 'Acest câmp ":attribute" nu există în :other.',
    'integer'              => 'Acest câmp ":attribute" trebuie să fie un întreg.',
    'ip'                   => 'Acest câmp ":attribute" trebuie să fie o adresă IP validă.',
    'json'                 => 'Acest câmp ":attribute" trebuie să fie un șir JSON valid.',
    'max'                  => [
        'numeric' => 'Acest câmp ":attribute" nu poate fi mai mare de :max.',
        'file'    => 'Acest câmp ":attribute" nu poate fi mai mare de :max kilobiți.',
        'string'  => 'Acest câmp ":attribute" nu poate fi mai mare de :max caractere.',
        'array'   => 'Acest câmp ":attribute" nu poate avea mai mult de :max itemi.',
    ],
    'mimes'                => 'Acest câmp ":attribute" trebuie să fie un fișier de tipul: :values.',
    'min'                  => [
        'numeric' => 'Acest câmp ":attribute" nu poate fi mai mare decât :min.',
        'file'    => 'Acest câmp ":attribute" nu poate fi mai mare decât :min kilobiți.',
        'string'  => 'Acest câmp ":attribute" nu poate fi mai mare decât :min caractere.',
        'array'   => 'Acest câmp ":attribute" trebuie să aibă cel mult :min itemi.',
    ],
    'not_in'               => 'Acest câmp ":attribute" selectat este invalid.',
    'numeric'              => 'Acest câmp ":attribute" trebuie  să fie un număr.',
    'present'              => 'Acest câmp ":attribute" trebuie să fie prezent.',
    'regex'                => 'Acest câmp ":attribute" format este invalid.',
    'required'             => 'Acest câmp ":attribute" este obligatoriu.',
    'required_if'          => 'Acest câmp ":attribute" este obligatoriu când :other este :value.',
    'required_unless'      => 'Acest câmp ":attribute" este obligatoriu doar dacă :other este în :values.',
    'required_with'        => 'Acest câmp ":attribute" este obligatoriu când :values este prezent.',
    'required_with_all'    => 'Acest câmp ":attribute" este obligatoriu când :values este prezent.',
    'required_without'     => 'Acest câmp ":attribute" este obligatoriu când :values nu este prezent.',
    'required_without_all' => 'Acest câmp ":attribute" este obligatoriu când nicio :values nu este prezent.',
    'same'                 => 'Acest câmp ":attribute" și :other trebuie să coincidă.',
    'size'                 => [
        'numeric' => 'Acest câmp ":attribute" trebuie să fie :size.',
        'file'    => 'Acest câmp ":attribute" trebuie să fie :size kilobytes.',
        'string'  => 'Acest câmp ":attribute" trebuie să fie :size characters.',
        'array'   => 'Acest câmp ":attribute" trebuie să conțină :size itemi.',
    ],
    'string'               => 'Acest câmp ":attribute" trebuie să fie un șir.',
    'timezone'             => 'Acest câmp ":attribute" trebuie să fie o zonă validă.',
    'unique'               => 'Acest câmp ":attribute" este deja luat.',
    'url'                  => 'Acest câmp ":attribute" este invalid.',

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
