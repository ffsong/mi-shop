<?php

return [
    'alipay' => [
        'app_id'         => '2016100100639828',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAt5ufVYx1zzj66KjdwKbCbd87iglXFksw+qiGRYCy4PVKWYsTYviut0bAbccn2TvBGeFlAv4RsZpTPHsnRaJcleftUO44oYyjsX4YN8uo8NyG07qPSpgsS7k/CI74ZtPdgjhHOHvqemOKK6sivD9QSMGL4YRpjpE3HmSUpgdP+FdKB1VkvFGu08YeEJ8EY6ljnpqhRShVdVO8R0tsGyPvFZVoNF65EvqheaF2iDoUsJBvdblgbGv7KnitpK9s2/5skWXaX01yhd4FLgBGEuG9RWlK6J4+Ms1FiRcLcCnTmzReyPcCMMmLD8y1Q/UCAq0aTg9owg+Pu2X3hF1nafJqdQIDAQAB',
        'private_key'    => 'MIIEpAIBAAKCAQEAzWHUX4yep8fVawIZMuJ5ksP4on1+SFgX3g2q3QmWWJ6leuPjdS1X3klkmodF/pMN/wWqGkZTgIO5Yjb0JLmHzPhGUyE3ZXXjJIhVzn8Xt7KjFbvkco7ZeR6Z9/qwLDUs2Pwke4DNjtFx5kHaB5yv80qyrC7o+Lmdl8VTGJpAlAa58WV1Vjaxa8x0gAEbbfe7E+uGwAHOh21ZE5EWhkwIUB2axHKiUtvzwNG1A0DyRP9YpJuDWYJHqCT/abfr4BNa50KKpLcdgq9JPG5Cm8uyiyBgCjMVUBDtRwH09Ay5zisPZ/T4PqeKNpxgyddJS63EEVOM0Geo/h9JQIk2Bq902wIDAQABAoIBAG9sas5nuM9nr9Y9LjSX/8LrBOIK2U8gU9qJabA/ekybzUUti4JP1kLnaGgZiZTCbS51AUL98mFflVy+WZfu+8jszSJee/JUkaWJPZwpAVIM3UN2S0sHSt7WBkwtuhRRyQHzUUubpmmcIYH9Ke9FR4Pje6nETWpbMS9cw2cukGh9gObuG9hUBAfmzVpY2taLib7NCVZX3pKktfk7o0oNDwBNp7MqcEHQIwcUez41M0YgB9jJu28+hwndCY0FFw0Nkyu7TdHPX3bSho+hCEn2Flufc+O0TlR6PQqQGs9EyLV/d8I5/W8BW77lUQpNzP30zdtAFunhtuqETwQq5xOm3ukCgYEA5uPn5szAw8bOABZMmt0aLTelc26lzt4EXgiFG3UuWOdSpyIOzI1o5PvOJT05JsTf887BXO+cA4P/bHF7GpvfmJjCRWJT/TZ0SXmnrGyIc7f0TU0zSIcB+6sq3kVNgQ4+xhLcdIKqsJOua0Mj+i7J7CLPOx5bXO3xvnkVzup1EEUCgYEA47fEDgEtjNjHQ5hWtlOEjSyKyta35snz2hpg7lxkAEkdYOlnWHzN/wsApoOFEssspkVzIRX0Ia27sYbLkP1vWkx++k4qSy/8CASskOgwClhpXws/pnmjFRXLbc74a2aElq2feddmZ9Ri+6RNHZ77rV0/bzkus2IVst2rwZyXkp8CgYAzrf2BJoFbEMuZL2SUITsztcndrX2FcSJPHd8VR0RJd/WDHVdsp5Y78rSwlySMrfJmsveK4sLr8oagckIYsZz5ne+V8i1UdvTOYWGLcXuVUy5mgwogiL+D4kslFyQC5/pbAWvA1GJ6RYP71DpgTEq8BQqXc/MFOOksNhQQjWAIdQKBgQCYezkA17EUmyPzE1MdC5e6oJTfdh/2nkx3Qyqc8ajUuCDAAAp/qjKWEVwCJBc7mmjvfZm2EelDk/4WxdgR4mJp6Mct/KE9b4goJlkXPyLMCp+kUPfyFYkqWUm64dhesmseKmybPa0I4aLWNhKdPxPv5nzPkU7AN3GoL98O6jhkqQKBgQDcEj2QQI5YBkQPaHMKtm2j/9WiA0fSchUsZhiy6/Y5LsE1OpLmZhOOk4Qpx98kXO60bZlJ5iPlTYCw01gqa3YGKzKlK1W8OoLm9HjxlPKTh+aqU3184lk52qiTq7g+VE4mE9Sf+B2rdXI7L+dPv+LVnT0FYsqj6WQmcziPsIrGDQ==',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];