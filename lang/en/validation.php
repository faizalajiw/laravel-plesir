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

    'accepted' => 'The :attribute must be accepted.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'array' => 'The :attribute must have between :min and :max items.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'numeric' => 'The :attribute must be between :min and :max.',
        'string' => 'The :attribute must be between :min and :max characters.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'doesnt_end_with' => 'The :attribute may not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute may not start with one of the following: :values.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'array' => 'The :attribute must have more than :value items.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'numeric' => 'The :attribute must be greater than :value.',
        'string' => 'The :attribute must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute must have :value items or more.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'array' => 'The :attribute must have less than :value items.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'numeric' => 'The :attribute must be less than :value.',
        'string' => 'The :attribute must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute must not have more than :value items.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'array' => 'The :attribute must not have more than :max items.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute must not be greater than :max.',
        'string' => 'The :attribute must not be greater than :max characters.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'array' => 'The :attribute must have at least :min items.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'numeric' => 'The :attribute must be at least :min.',
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

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

    // CUSTOM VALIDATION 
    'custom' => [
        'name' => [
            'required' => 'Nama tidak boleh kosong.',
            'regex' => 'Nama hanya diisi oleh huruf.',
            'unique' => 'Nama ini telah digunakan.',
        ],
        'title' => [
            'required' => 'Nama Tempat tidak boleh kosong.',
            'regex' => 'Nama Tempat hanya diisi oleh huruf.',
            'unique' => 'Nama ini telah digunakan.',
        ],
        'username' => [
            'required' => 'Username tidak boleh kosong.',
            'regex' => 'Username tidak boleh mengandung spasi.',
            'unique' => 'Username telah digunakan oleh pengguna lain.',
            'max' => 'Username terlalu panjang (max.50 karakter)',
        ],
        'email' => [
            'required' => 'Email tidak boleh kosong.',
            'email' => 'Tolong periksa kembali Email anda',
            'regex' => 'Tolong periksa kembali Email anda',
            'unique' => 'Sudah ada pengguna yang menggunakan Email ini.',
        ],
        'password' => [
            'required' => 'Password tidak boleh kosong.',
            'min' => 'Password min.8 karakter',
            'regex' => 'Password tidak boleh mengandung spasi.',
        ],
        'confirm_password' => [
            'required' => 'Isi Konfirmasi Password terlebih dahulu.',
            'same' => 'Password tidak cocok.',
        ],
        'new_password' => [
            'required' => 'Password tidak boleh kosong.',
            'min' => 'Password min.8 karakter',
            'regex' => 'Password tidak boleh mengandung spasi.',
        ],
        'new_confirm_password' => [
            'required' => 'Isi Konfirmasi Password Baru terlebih dahulu.',
            'same' => 'Password Baru dan Konfirmasi Password Baru harus cocok.',
        ],
        'role_name' => [
            'required' => 'Role tidak boleh kosong.',
        ],
        'place_id' => [
            'required'  => 'Place tidak boleh kosong.',
            'unique'    => 'Anda sudah menggunakan data Tempat ini.',
        ],
        'category_id' => [
            'required' => 'Kategori tidak boleh kosong.',
        ],
        'description' => [
            'required' => 'Deskripsi tidak boleh kosong.',
        ],
        'address' => [
            'required' => 'Alamat tidak boleh kosong.',
        ],
        'day' => [
            'required' => 'Hari tidak boleh kosong.',
        ],
        'operational_hours' => [
            'required' => 'Jam operasional tidak boleh kosong.',
        ],
        'longitude' => [
            'required' => 'Koordinat tidak boleh kosong. Isi dengan maps di bawah ini',
        ],
        'latitude' => [
            'required' => 'Koordinat tidak boleh kosong. Isi dengan maps di bawah ini',
        ],
        'avatar' => [
            'image' => 'Gambar harus berformat (.jpeg/.png/.jpg/.gif)',
            'max' => 'Gambar tidak boleh melebihi ukuran (max.2MB).',
        ],
        'image' => [
            'required' => 'Gambar tidak boleh kosong.',
            'image' => 'Gambar harus berformat (.jpeg/.png/.jpg/.gif)',
            'max' => 'Gambar tidak boleh melebihi ukuran (max.2MB).',
        ],
        'image.*' => [
            'required' => 'Gambar tidak boleh kosong.',
            'image' => 'Gambar harus berformat (.jpeg/.png/.jpg/.gif)',
            'max' => 'Gambar tidak boleh melebihi ukuran (max.2MB).',
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

    'attributes' => [],

];
