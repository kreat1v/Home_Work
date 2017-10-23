<?php

// Задание 1 - Сделайте класс Task1, в котором будут следующие public поля - name (имя), age (возраст), salary (зарплата). Создайте объект этого класса, затем установите поля в следующие значения (не в __construct, а для созданного объекта) - имя 'Иван', возраст 25, зарплата 1000. Создайте второй объект этого класса, установите поля в следующие значения - имя 'Вася', возраст 26, зарплата 2000. Выведите на экран сумму зарплат Ивана и Васи. Выведите на экран сумму возрастов Ивана и Васи.

class Task1
{
    public $name;
    public $age;
    public $salary;
}

$firstObjectTask = new Task1;
$firstObjectTask->name = 'Иван';
$firstObjectTask->age = 25;
$firstObjectTask->salary = 1000;

$secondObjectTask = new Task1;
$secondObjectTask->name = 'Вася';
$secondObjectTask->age = 26;
$secondObjectTask->salary = 2000;

echo $firstObjectTask->name.' и '.$secondObjectTask->name.' имеют следующую сумму зарплат: '.($firstObjectTask->salary + $secondObjectTask->salary).'<br>';
echo $firstObjectTask->name.' и '.$secondObjectTask->name.' имеют следующую сумму возрастов: '.($firstObjectTask->age + $secondObjectTask->age);
echo '<hr>';

// Задание 2 - Сделайте класс Task2, в котором будут следующие private поля - name (имя), age (возраст), salary (зарплата) и следующие public методы setName, getName, setAge, getAge, setSalary, getSalary. Создайте 2 объекта этого класса: 'Иван', возраст 25, зарплата 1000 и 'Вася', возраст 26, зарплата 2000. Выведите на экран сумму зарплат Ивана и Васи. Выведите на экран сумму возрастов Ивана и Васи.

class Task2
{
    private $name;
    private $age;
    private $salary;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->checkAge($age);
    }

    private function checkAge($age)
    {
        if ($age <= 100 && $age >= 1) {
            $this->age = $age;
        } else {
            echo 'Вы ввели неккоректный возраст!';
        }
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }
}

$firstObjectTask2 = new Task2;
$firstObjectTask2->setName('Иван');
$firstObjectTask2->setAge(25);
$firstObjectTask2->setSalary(1000);

$secondObjectTask2 = new Task2;
$secondObjectTask2->setName('Вася');
$secondObjectTask2->setAge(26);
$secondObjectTask2->setSalary(2000);

echo $firstObjectTask2->getName().' и '.$secondObjectTask2->getName().' имеют следующую сумму зарплат: '.($firstObjectTask2->getSalary() + $secondObjectTask2->getSalary().'<br>');

echo $firstObjectTask2->getName().' и '.$secondObjectTask2->getName().' имеют следующую сумму зарплат: '.($firstObjectTask2->getAge() + $secondObjectTask2->getAge());
echo '<hr>';

// Задание 3 - Дополните класс Task3 из предыдущей задачи private методом checkAge, который будет проверять возраст на корректность (от 1 до 100 лет). Этот метод должен использовать метод setAge перед установкой нового возраста (если возраст не корректный - он не должен меняться).

$thirdObjectTask2 = new Task2;
$thirdObjectTask2->setAge(105);
$thirdObjectTask2->setAge(27);
echo '<br>'.$thirdObjectTask2->getAge();
echo '<hr>';

// Задание 4 - Сделайте класс Task4, в котором будут следующие private поля - name (имя), salary (зарплата). Сделайте так, чтобы эти свойства заполнялись в методе __construct при создании объекта (вот так: new Worker(имя, возраст) ). Сделайте также public методы getName, getSalary. Создайте объект этого класса 'Дима', возраст 25, зарплата 1000. Выведите на экран произведение его возраста и зарплаты.

class Task4
{
    private $name;
    private $age;
    private $salary;

    public function __construct($name, $age, $salary)
    {
        $this->name = $name;
        $this->age = $age;
        $this->salary = $salary;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getSalary()
    {
        return $this->salary;
    }
}

$worker = new Task4('Дима', 25, 1000);
echo $worker->getSalary() * $worker->getAge();
echo '<hr>';

/* Задание 5 - Сделайте класс User, в котором будут следующие protected поля - name (имя), age (возраст), public методы setName, getName, setAge, getAge.

Сделайте класс Worker, который наследует от класса User и вносит дополнительное private поле salary (зарплата), а также методы public getSalary и setSalary.

Создайте объект этого класса 'Иван', возраст 25, зарплата 1000. Создайте второй объект этого класса 'Вася', возраст 26, зарплата 2000. Найдите сумму зарплата Ивана и Васи.

Сделайте класс Student, который наследует от класса User и вносит дополнительные private поля стипендия, курс, а также геттеры и сеттеры для них. */

class User
{
    protected $name;
    protected $age;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }
}

class Worker extends User
{
    private $salary;

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function getSalary()
    {
        return $this->salary;
    }
}

$firstWorker = new Worker;
$firstWorker->setName('Иван');
$firstWorker->setAge(25);
$firstWorker->setSalary(1000);

$secondWorker = new Worker;
$secondWorker->setName('Вася');
$secondWorker->setAge(26);
$secondWorker->setSalary(2000);

echo $firstWorker->getName().' и '.$secondWorker->getName().' имеют следующую сумму зарплат: '.($firstWorker->getSalary() + $secondWorker->getSalary().'<br>');
echo '<hr>';

class Student extends User
{
    private $grant;
    private $course;

    public function setGrant($grant)
    {
        $this->grant = $grant;
    }

    public function getGrant()
    {
        return $this->grant;
    }

    public function setCourse($course)
    {
        $this->course = $course;
    }

    public function getCourse()
    {
        return $this->course;
    }
}

// Задание 6 - Сделайте класс Driver (Водитель), который будет наследоваться от класса Worker из предыдущей задачи. Этот метод должен вносить следующие private поля: водительский стаж, категория вождения (A, B, C).

class Driver extends Worker
{
    private $drivingExperience;
    private $drivingCategory;

    public function getDrivingExperience()
    {
        return $this->drivingExperience;
    }

    public function setDrivingExperience($drivingExperience)
    {
        $this->drivingExperience = $drivingExperience;
    }

    public function getDrivingCategory()
    {
        return $this->drivingCategory;
    }

    public function setDrivingCategory($drivingCategory)
    {
        if ($drivingCategory == 'A' || $drivingCategory == 'B' || $drivingCategory == 'C') {
            $this->drivingCategory = $drivingCategory;
        } else {
            echo 'Вы ввели не верную категорию!';
        }
    }
}

$newDriver = new Driver;
echo $newDriver->setDrivingCategory('H').'<br>';
$newDriver->setDrivingCategory('A');
echo $newDriver->getDrivingCategory();
echo '<hr>';

/* Задание 7 - Создайте класс Form - оболочку для создания форм. Он должен иметь методы input, submit, password, textarea, open, close. Каждый метод принимает массив атрибутов.

	echo $form->open(['action'=>'index.php', 'method'=>'POST']);
	//Код выше выведет <form action="index.php" method="POST">

	echo $form->input(['type'=>'text', 'value'=>'!!!']);
	//Код выше выведет <input type="text" value="!!!">

	echo $form->password(['value'=>'!!!']);
	//Код выше выведет <input type="password" value="!!!">

	echo $form->submit(['value'=>'go']);
	//Код выше выведет <input type="submit" value="go">

	echo $form->textarea(['placeholder'=>'123', 'value'=>'!!!']);
	//Код выше выведет <textarea placeholder="123">!!!</textarea>

	echo $form->close();
	//Код выше выведет </form> */

class Form
{
    public function open($value)
    {
        return "<form ".$this->forEach($value).">";
    }

    public function input($value)
    {
        return "<input ".$this->forEach($value) .">";
    }

    public function password($value)
    {
        return "<input type=\"password\" ".$this->forEach($value).">";
    }

    public function submit($value)
    {
        return "<input type=\"submit\" ".$this->forEach($value).">";
    }

    public function textarea($textarea)
    {
        $string = "";
        foreach ($textarea as $key => $newValue) {
            if ($key != 'value') {
                $string .= "$key=\"$newValue\" ";
            }
        }
        return "<textarea $string>$textarea[value]</textarea>";
    }

    public function close()
    {
        return "</form>";
    }

    private function forEach($value)
    {
        $string = "";
        foreach ($value as $key => $newValue) {
            $string .= "$key=\"$newValue\" ";
        }
        return $string;
    }
}

$form = new Form;
echo $form->open(['action'=>'index.php', 'method'=>'POST']);
echo $form->input(['type'=>'text', 'value'=>'!!!']);
echo $form->password(['value'=>'!!!']);
echo $form->submit(['value'=>'go']);
echo $form->textarea(['placeholder'=>'123', 'value'=>'!!!']);
echo $form->close();
echo '<hr>';

// Задание 8 - Создайте класс Cookie - оболочку над работой с куками. Класс должен иметь следующие методы: установка куки set(имя куки, ее значение), получение куки get(имя куки), удаление куки del(имя куки).

class Cookie
{
    public function setCookie($name, $value)
    {
        setcookie($name, $value);
    }

    public function getCookie($name)
    {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
    }

    public function delCookie($name)
    {
        setcookie($name, '');
    }
}

$cookie = new Cookie;
$cookie->setCookie('Foo', 'New Cookie');
echo $cookie->getCookie('Foo');
echo '<hr>';

// Задание 9 - Создайте класс Session - оболочку над сессиями. Он должен иметь следующие методы: создать переменную сессии, получить переменную, удалить переменную сессии, проверить наличие переменной сессии. Сессия должна стартовать (session_start) в методе __construct.

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function sessionVariable($variable, $value)
    {
        $_SESSION[$variable] = $value;
    }

    public function getVariable($variable)
    {
        if (isset($_SESSION[$variable])) {
            return $_SESSION[$variable];
        }

    }

    public function delVariable($variable)
    {
        if (isset($_SESSION[$variable])) {
            unset($_SESSION[$variable]);
        }
    }

    public function presenceVariable($variable)
    {
        if (isset($_SESSION[$variable])) {
            return true;
        } else {
            return false;
        }
    }
}

$newSession = new Session;
$newSession->sessionVariable('a', 'New Session!');
echo $newSession->getVariable('a').'<br>';
var_dump($newSession->presenceVariable('a'));
$newSession->delVariable('a');
echo '<br>';
var_dump($newSession->presenceVariable('a'));