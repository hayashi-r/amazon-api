<?php

return [
  'database' => [
    'name' => 'sendjapa_amazon',
    'username' => 'sendjapa_amazon',
    'password' => 'hayashir',
    'connection' => 'mysql:host=127.0.0.1',
    'options' => [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
  ]
];
