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

    'accepted' => ':attribute պետք է ընդունվի։',
    'accepted-if' => ':attribute պետք է ընդունվի, երբ :other :value է:',
    'active-url' => ':attribute վավեր URL չէ:',
    'after' => ':attribute պետք է լինի :date -ից հետո ամսաթիվ:',
    'after-or-equal' => ':attribute պետք է լինի :date -ին հաջորդող ամսաթիվ կամ հավասար:',
    'alpha' => ':attribute պետք է պարունակի միայն տառեր:',
    'alpha-dash' => ':attribute պետք է պարունակի միայն տառեր, թվեր, գծիկներ և ընդգծումներ:',
    'alpha-num' => ':attribute պետք է պարունակի միայն տառեր և թվեր:',
    'array' => ':attribute պետք է լինի զանգված:',
    'ascii' => ':attribute պետք է պարունակի միայն մեկ բայթանոց ալֆան-թվային նիշեր և նշաններ:',
    'before' => ':attribute պետք է լինի :date -ից առաջ ամսաթիվ:',
    'before_or_equal' => ':attribute պետք է լինի :date -ին նախորդող կամ հավասար ամսաթիվ:',
    'after_or_equal' => ':attribute պետք է լինի :date -ին հաջորդող կամ հավասար ամսաթիվ:',
    'date_format' => ':attribute ձևաչափն անվավեր է:',
    'between' => [
        'array' => ':attribute պետք է ունենա :min և :max տարրերի միջև:',
        'file' => ':attribute պետք է լինի :min և :max կիլոբայթների միջև:',
        'numeric' => ':attribute պետք է լինի :min -ի և :max -ի միջև:',
        'string' => ':attribute պետք է լինի :min և :max նիշերի միջև:',
    ],
    'boolean' => ':attribute դաշտը պետք է լինի true կամ false:',
    'confirmed' => ':attribute հաստատումը չի համընկնում:',
    'current-password' => 'Գաղտնաբառը սխալ է:',
    'date' => ':attribute վավեր ամսաթիվ չէ:',
    'date-equals' => ':attribute պետք է լինի :date -ին հավասար ամսաթիվ:',
    'date-format' => ':attribute չի համապատասխանում :format ձևաչափին:',
    'decimal' => ':attribute պետք է ունենա :decimal տասնորդական թվեր:',
    'declined' => ':attribute պետք է մերժվի:',
    'declined-if' => ':attribute պետք է մերժվի, երբ :other -ը :value է:',
    'different' => ':attribute -ը և :other -ը պետք է տարբեր լինեն։',
    'digits' => ':attribute պետք է լինի :digits թվանշան:',
    'digits-between' => ':attribute պետք է լինի :min և :max թվանշանների միջև:',
    'dimensions' => ':հատկանիշն ունի պատկերի անվավեր չափեր:',
    'distinct' => ':attribute դաշտը կրկնօրինակված արժեք ունի:',
    'doesnt-end-with' => ':attribute չի կարող ավարտվել հետևյալներից որևէ մեկով. :values',
    'doesnt-start-with' => ':attribute չի կարող սկսվել հետևյալներից որևէ մեկով. :values',
    'email' => ':attribute պետք է վավեր էլփոստի հասցե լինի:',
    'ends-with' => ':attribute պետք է ավարտվի հետևյալներից մեկով. :values',
    'enum' => 'Ընտրված :հատկանիշն անվավեր է:',
    'exists' => 'Ընտրված :հատկանիշն անվավեր է:',
    'file' => ':attribute պետք է լինի ֆայլ:',
    'filled' => ':attribute դաշտը պետք է արժեք ունենա:',
    'gt' => [
        'array' => ':attribute պետք է ունենա ավելի քան :value տարրեր:',
        'file' => ':attribute պետք է լինի :value կիլոբայթից մեծ:',
        'numeric' => ':attribute պետք է լինի :value -ից մեծ:',
        'string' => ':attribute պետք է մեծ լինի :value նիշերից:',
    ],
    'gte' => [
        'array' => ':attribute պետք է ունենա :value տարրեր կամ ավելին:',
        'file' => ':attribute պետք է մեծ կամ հավասար լինի :value կիլոբայթին:',
        'numeric' => ':attribute պետք է մեծ կամ հավասար լինի :value -ին:',
        'string' => ':attribute պետք է մեծ կամ հավասար լինի :value նիշերին:',
    ],
    'image' => ':attribute պետք է լինի պատկեր:',
    'in' => 'Ընտրված :attribute անվավեր է:',
    'in-array' => ':attribute դաշտը գոյություն չունի :other -ում:',
    'integer' => ':attribute պետք է լինի ամբողջ թիվ։',
    'ip' => ':attribute պետք է լինի վավեր IP հասցե:',
    'ipv4' => ':attribute պետք է լինի վավեր IPv4 հասցե:',
    'ipv6' => ':attribute պետք է լինի վավեր IPv6 հասցե:',
    'json' => ':attribute պետք է լինի վավեր JSON տող:',
    'lowercase' => ':attribute պետք է լինի փոքրատառ:',
    'lt' => [
        'array' => ':attribute պետք է ունենա :value -ից պակաս տարրեր.',
        'file' => ':attribute պետք է լինի :value կիլոբայթից փոքր.',
        'numeric' => ':attribute պետք է լինի :value -ից փոքր։',
        'string' => ':attribute պետք է լինի փոքր :value նիշերից.',
    ],
    'lte' => [
        'array' => ':attribute չպետք է ունենա ավելի քան :value տարրեր։',
        'file' => ':attribute պետք է լինի :value կիլոբայթից փոքր կամ հավասար:',
        'numeric' => ':attribute պետք է լինի փոքր կամ հավասար :value -ին:',
        'string' => ':attribute պետք է լինի փոքր կամ հավասար :value նիշերին:',
    ],
    'mac-address' => ':attribute պետք է լինի վավեր MAC հասցե:',
    'max' => [
        'array' => ':attribute չպետք է ունենա ավելի քան :max տարրեր:',
        'file' => ':attribute չպետք է լինի :max կիլոբայթից մեծ:',
        'numeric' => ':attribute չպետք է լինի :max -ից մեծ:',
        'string' => ':attribute չպետք է լինի :max նիշից մեծ:',
    ],
    'max-digits' => ':attribute չպետք է ունենա ավելի քան :max թվանշան:',
    'mimes' => ':attribute պետք է լինի :values ​​տեսակի ֆայլ:',
    'mimetypes' => ':attribute պետք է լինի :values ​​տեսակի ֆայլ:',
    'min' => [
        'array' => ':attribute պետք է ունենա առնվազն :min տարրեր.',
        'file' => ':attribute պետք է լինի առնվազն :min կիլոբայթ.',
        'numeric' => ':attribute պետք է լինի առնվազն :min.',
        'string' => ':attribute պետք է լինի առնվազն :min նիշ.',
    ],
    'min-digits' => ':attribute պետք է ունենա առնվազն :min թվանշաններ:',
    'missing' => ':attribute դաշտը պետք է բացակայի:',
    'missing-if' => ':attribute դաշտը պետք է բացակայի, երբ :other -ը :value է:',
    'missing-unless' => ':attribute դաշտը պետք է բացակայի, եթե :other -ը :value չէ:',
    'missing-with' => ':attribute դաշտը պետք է բացակայի, երբ առկա է :values:',
    'missing-with-all' => ':attribute դաշտը պետք է բացակայի, երբ առկա են :values:',
    'multiple-of' => ':attribute պետք է լինի :value -ի բազմապատիկ:',
    'not-in' => 'Ընտրված :հատկանիշն անվավեր է:',
    'not-regex' => ':attribute ձևաչափն անվավեր է:',
    'numeric' => ':attribute պետք է լինի թիվ։',
    'password' => [
        'letters' => ':attribute պետք է պարունակի առնվազն մեկ տառ:',
        'mixed' => ':attribute պետք է պարունակի առնվազն մեկ մեծատառ և մեկ փոքրատառ:',
        'numbers' => ':attribute պետք է պարունակի առնվազն մեկ թիվ։',
        'symbols' => ':attribute պետք է պարունակի առնվազն մեկ նշան:',
        'uncompromised' => 'Տվյալ :attribute հայտնվել է տվյալների արտահոսքի մեջ: Խնդրում ենք ընտրել այլ :attribute :',
    ],
    'present' => ':attribute դաշտը պետք է լինի:',
    'prohibited' => ':attribute դաշտն արգելված է:',
    'prohibited-if' => ':attribute դաշտն արգելված է, երբ :other -ը :value է:',
    'prohibited-unless' => ':attribute դաշտն արգելված է, եթե :other-ը :values -ում չէ:',
    'prohibits' => ':attribute դաշտն արգելում է :other -ին ներկա լինել:',
    'regex' => ':attribute ձևաչափն անվավեր է:',
    'required' => ':attribute դաշտը պարտադիր է:',
    'required-array-keys' => ':attribute դաշտը պետք է պարունակի գրառումներ՝ :values -ի համար:',
    'required-if' => ':attribute դաշտը պարտադիր է, երբ :other-ը :value է:',
    'required-if-accepted' => ':attribute դաշտը պարտադիր է, երբ :other ընդունված է:',
    'required-unless' => ':attribute դաշտը պարտադիր է, եթե :other -ը :values-ում չէ:',
    'required-with' => ':attribute դաշտը պահանջվում է, երբ առկա է :values:',
    'required-with-all' => ':attribute դաշտը պահանջվում է, երբ առկա են :values:',
    'required-without' => ':attribute դաշտը պահանջվում է, երբ :values ​​չկա:',
    'required-without-all' => ':attribute դաշտը պարտադիր է, երբ :value -ներից ոչ մեկը չկա:',
    'same' => ':attribute -ը և :other -ը պետք է համապատասխանեն:',
    'size' => [
        'array' => ':attribute պետք է պարունակի :size տարրեր:',
        'file' => ':attribute պետք է լինի :size կիլոբայթ:',
        'numeric' => ':attribute պետք է լինի :size :',
        'string' => ':attribute պետք է լինի :size նիշ:',
    ],
    'starts-with' => ':attribute պետք է սկսվի հետևյալներից մեկով. :values :',
    'string' => ':attribute պետք է լինի տող:',
    'timezone' => ':attribute պետք է վավեր ժամային գոտի լինի:',
    'unique' => ':attribute արդեն գոյություն ունի։',
    'uploaded' => 'Չհաջողվեց վերբեռնել :attribute :',
    'uppercase' => ':attribute պետք է լինի մեծատառ:',
    'url' => ':attribute պետք է լինի վավեր URL:',
    'ulid' => ':attribute պետք է լինի վավեր ULID:',
    'uuid' => ':attribute պետք է լինի վավեր UUID:',
    'result_search_dont_matched' => 'Որոնման արդյունքը բացակայում է։',


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

        'result_search_dont_matched'=>[
            'required'=>'Որոնման արդյունքը բացակայում է։'
        ],

        'event-date' => [
            'required'=>'Իրադարձության ամսաթիվ բացակայում է։'
        ],

        'value' => [
            'integer'=>'Գործի համար պետք է լինի թիվ։'
        ],

        'search_text' => [
            'required'=>'Որոնման տեքստը բացակայում է։'
        ],

        'deadline' => [
            'after'=>'Հսկողության վերջնաժամկետը պետք է լինի երեկվանից հետո։'
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'username' => 'օգտագործողի անուն',
        'password' => 'գաղտնաբառ',
        'roles' => 'դեր',
        'confirm-password' => 'գաղտնաբառի կրկնությունը'

    ]

];
