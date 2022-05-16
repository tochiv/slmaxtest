<?php

/**
 * Автор: Костюк Антон
 *
 * Дата реализации: 16.05.2022 22:00
 *
 * Дата изменения: 16.05.2022 22:00
 *
 * Класс для работы с таблицей humans.
 */

namespace Model;

use Core\Model;
use stdClass;

/**
 * Класс для работы с таблицей humans.
 * Наследует класс Model.
 * При помощи функции statement(), класс Model, получает доступ к другим фунциям PDO.
 * Создав объект этого класса, данные, полученные конструктором, сохранятся в БД.
 */
class Human extends Model
{
    private int $id;

    private string $name;

    private string $surname;

    private string $birth;

    private string $sex;

    private string $city;

    public function __construct(string $name, string $surname, string $birth, string $sex, string $city)
    {
        parent::__construct();

        $statement = $this->statement("INSERT INTO human(name, surname, birth, sex, city) VALUES('$name', '$surname', '$birth', $sex, '$city')");

        $statement->execute();
    }

    public function save(string $name, string $surname, string $birth, int $sex, string $city)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->birth = $birth;
        $this->sex = $sex;
        $this->city = $city;

        $statement = $this->statement("INSERT INTO human(name, surname, birth, sex, city) VALUES('$name', '$surname', '$birth', $sex, '$city')");

        $statement->execute();

        return $this;
    }

    public function delete(int $id): void
    {
        $statement = $this->statement("DELETE FROM human WHERE id = $id");

        $statement->execute();
    }

    public static function birthToYears($birth)
    {
        $timestamp = strtotime($birth);

        return date('Y') - date('Y', $timestamp);
    }

    static public function toSex($sex): string
    {
        if($sex == 0){
            return 'муж';
        }
        if ($sex == 1) {
            return 'жен';
        } else {
            return 'Пол не определен';
        }
    }

    /**
     * Форматирует человека по параметрам возраста и (или) пола
     *
     * @param string $birth
     * @param string $sex
     * @return stdClass
     */
    public function humanFormat(string $birth = '', string $sex = '')
    {
        $class = new StdClass;
        $class->name = $this->name;
        $class->surname = $this->surname;
        $class->birth = $this->birth;
        $class->sex = $this->sex;
        $class->city =  $this->city;

        if(!empty($birth)){
            $this->birth = self::birthToYears($birth);
        } else {
            $this->birth = self::birthToYears($this->birth);
        }

        if(!empty($sex)){
            $this->sex = self::toSex($sex);
        } else {
            $this->sex = self::toSex($this->sex);
        }

        return $class;
    }
}
