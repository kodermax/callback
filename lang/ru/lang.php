<?php
return [
    'messages' => [
        'phone' => [
            'required' => 'Поле Телефон не заполнено!'
        ]
    ],
    'component' => [
      'name' => 'Компонент CallBack',
      'description' => 'Выводит форму обратного звонка'
    ],
    'plugin' => [
        'name' => 'CallBack',
        'description' => 'Создание формы обратного звонка'
    ],
    'settings' => [
        'label' => 'Настройки CallBack',
        'description' => 'Управление настройками формы обратного звонка',
    ],
    'email' => [
        'message' => 'Письмо отправляется администратору после заполнения пользователем формы обратного звонка'
    ],
    'menu' => [
        'label' => 'CallBack'
    ]
];
?>