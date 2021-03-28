<?php

function validFirstLastname(array $Post) : array{
    $error = [];

    if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/', $_POST['first_name'])) {
        $error[] = 'В имени запрещённые символы';
    }

    if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/', $_POST['last_name'])) {
        $error[] = 'В фамилии запрещённые символы';
    }

    if (empty($error)) {
        echo 'Всё отлично';
    } else {
        foreach ($error as $err) {
            echo $err;
        }
    }
}


function valid(array $post) : array {
    $validate =[
        'error' => false,
        'success' => false,
        'messages' => [],
    ];

    if(!empty($post['login']) && !empty($post['password'])) {
        $login = trim($post['login']);
        $password = trim($post['password']);

        $constraints = [
            'login' => 6,
             'password' => 4,
        ];
         $validateForm = validLoginAndPassword($login, $password, $constraints);

         if (!validateForm['login']) {
            $validate['error'] = true;
            array_push(
                $validate ['messages'],
                "логин должен содерж больше {$constraints['login']} символов"
            );
         }
        if (!$validateForm['password']) {
            $validate['error'] = true;
             array_push(
                $validate['messages'],
                "пароль должен содержать больше {$constraints['password']} символов"
             );
        }

        if (!$validate['error']) {
            $validate['succes'] = true;
            array_push(
                $validate['messages'],
                "ваш логин : {$login}",
                        "Ваш пароль: {$password}"
            );
        }

        return $validate;
    }
    return $validate;
}


function validLoginAndPassword(string $login, string $password, array $constraints) : array{

    $validateForm = [
        'login' => true,
        'password' => true,
    ];

    if (strlen($login) < $constraints['login']) {
        $validateForm['login'] = false;
     }

    if (strlen($password) < $constraints['password']) {
        $validateForm['password'] = false;
    }

    return $validateForm;

}
