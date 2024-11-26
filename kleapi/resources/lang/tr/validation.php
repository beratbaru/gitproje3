<?php

return [
    'accepted'             => ':attribute kabul edilmelidir.',
    'active_url'           => ':attribute geçerli bir URL değil.',
    'after'                => ':attribute şundan daha eski bir tarih olmalı: :date.',
    'after_or_equal'       => ':attribute şundan daha eski veya bu tarihe eşit bir tarih olmalı: :date.',
    'alpha'                => ':attribute sadece harflerden oluşmalıdır.',
    'alpha_dash'           => ':attribute sadece harfler, rakamlar ve tirelerden oluşabilir.',
    'alpha_num'            => ':attribute sadece harfler ve rakamlar içerebilir.',
    'array'                => ':attribute bir dizi olmalı.',
    'before'               => ':attribute şundan daha önceki bir tarih olmalı: :date.',
    'before_or_equal'      => ':attribute şundan daha önceki veya bu tarihe eşit bir tarih olmalı: :date.',
    'between'              => [
        'numeric' => ':attribute :min ile :max arasında olmalı.',
        'file'    => ':attribute :min ile :max kilobayt arasında olmalı.',
        'string'  => ':attribute :min ile :max karakter arasında olmalı.',
        'array'   => ':attribute :min ile :max arasında öğe içermeli.',
    ],
    'boolean'              => ':attribute alanı true veya false olmalı.',
    'confirmed'            => ':attribute tekrarı eşleşmiyor.',
    'date'                 => ':attribute geçerli bir tarih değil.',
    'date_format'          => ':attribute :format formatına uymuyor.',
    'different'            => ':attribute ile :other farklı olmalı.',
    'digits'               => ':attribute :digits basamaklı olmalı.',
    'digits_between'       => ':attribute :min ile :max basamak arasında olmalı.',
    'email'                => ':attribute geçerli bir e-posta adresi olmalı.',
    'exists'               => 'Seçilen :attribute geçersiz.',
    'image'                => ':attribute bir resim olmalı.',
    'in'                   => 'Seçilen :attribute geçersiz.',
    'integer'              => ':attribute bir tam sayı olmalı.',
    'max'                  => [
        'numeric' => ':attribute :max değerinden büyük olamaz.',
        'file'    => ':attribute :max kilobayttan büyük olamaz.',
        'string'  => ':attribute :max karakterden uzun olamaz.',
        'array'   => ':attribute en fazla :max öğe içerebilir.',
    ],
    'min'                  => [
        'numeric' => ':attribute en az :min olmalı.',
        'file'    => ':attribute en az :min kilobayt olmalı.',
        'string'  => ':attribute en az :min karakter olmalı.',
        'array'   => ':attribute en az :min öğe içermeli.',
    ],
    'not_in'               => 'Seçilen :attribute geçersiz.',
    'numeric'              => ':attribute bir sayı olmalı.',
    'regex'                => ':attribute formatı geçersiz.',
    'required'             => ':attribute alanı zorunludur.',
    'same'                 => ':attribute ile :other eşleşmeli.',
    'size'                 => [
        'numeric' => ':attribute :size olmalı.',
        'file'    => ':attribute :size kilobayt olmalı.',
        'string'  => ':attribute :size karakter olmalı.',
        'array'   => ':attribute :size öğe içermeli.',
    ],
    'unique'               => ':attribute daha önce alınmış.',
    'url'                  => ':attribute formatı geçersiz.',

    // Özel doğrulama mesajları
    'custom' => [
        'email' => [
            'unique' => 'Bu e-posta adresi zaten kullanılıyor.',
        ],
        'password' => [
            'min' => 'Şifreniz en az :min karakter olmalı.',
        ],
    ],

    // Öznitelik adlarının çevirisi
    'attributes' => [
        'name' => 'Ad',
        'email' => 'E-posta',
        'password' => 'Şifre',
        'password_confirmation' => 'Şifre Onayı',
    ],
];