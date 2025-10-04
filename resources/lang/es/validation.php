<?php
return [
    'required' => 'El campo :attribute es obligatorio.',
    'email'    => 'El campo :attribute debe ser un correo válido.',
    'min'      => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'unique'   => 'El :attribute ya ha sido registrado.',
    'confirmed'=> 'La confirmación de :attribute no coincide.',
    'attributes' => [
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'name' => 'nombre',
    ],
];
