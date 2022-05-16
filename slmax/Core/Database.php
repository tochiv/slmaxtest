<?php

/**
 * Автор: Костюк Антон
 *
 * Дата реализации: 16.05.2022 22:00
 *
 * Дата изменения: 16.05.2022 22:00
 *
 * Класс для подключения к БД.
 */

namespace Core;

/**
 * Класс для создания подключения к БД.
 * Расширяется от PDO класса.
 */
class Database extends \PDO
{
    public function __construct()
    {
        try {
            parent::__construct('mysql:dbname=slmax; host=localhost', 'root', 'root');
        }
        catch(\PDOException $e) {
            echo "ОШИБКА ПОДКЛЮЧЕНИЯ К БД\n";
            echo $e->getMessage();
        }
    }
}
