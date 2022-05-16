<?php

/**
 * Автор: Костюк Антон
 *
 * Дата реализации: 16.05.2022 22:00
 *
 * Дата изменения: 16.05.2022 22:00
 *
 * Класс для моделей.
 */

namespace Core;

/**
 * Класс для моделей.
 * Родительский класс, с функцией для работы с БД.
 */
class Model
{
    protected Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function statement(string $sql): bool|\PDOStatement
    {
        return $this->db->prepare($sql);
    }
}
