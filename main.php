<?php

interface AnimalInterface
{
    public function getProducts();
    public function getAnimalType();
}

class Animal implements AnimalInterface
{
    // уникальный регистрационный номер
    public $code;
    // тип животного
    protected $type;
    // количество производимой продукции
    protected $productsCount;

    public function __construct($type, $productsCount)
    {
        $this->code = rand(100000, 999999);
        $this->type = $type;
        $this->productsCount = $productsCount;
    }

    // получение произведенной продукции
    public function getProducts()
    {
        return $this->productsCount;
    }

    // получение типа животного
    public function getAnimalType()
    {
        return $this->type;
    }
}

class Farm
{
    // все животный, которые есть на ферме
    protected $animals = [];

    // добавление нового животного на ферме
    public function createAnimal($type, $productsCount)
    {
        $this->animals[] = new Animal($type, $productsCount);
    }

    // получение произведенной продукции за определенный период времени
    public function getProductsCount($period = 1)
    {
        $productsCount = [];

        foreach ($this->getAnimalsTypes() as $type) {
            $count = 0;
            foreach ($this->animals as $animal) {
                if($animal->getAnimalType() === $type) {
                    for($i = 0; $i < $period; $i++) {
                        $count += $animal->getProducts();
                    }
                }
            }

            $productsCount[$type] = $count;
        }

        return $productsCount;
    }

    // Получение количества животных каждого типа
    public function getAnimalsCount()
    {
        $animalsCount = [];

        foreach ($this->getAnimalsTypes() as $type) {
            $count = 0;
            foreach ($this->animals as $animal) {
                if($animal->getAnimalType() === $type) {
                    $count++;
                }
            }

            $animalsCount[$type] = $count;
        }

        return $animalsCount;
    }

    // Получение всех типов животных, которые есть на ферме
    private function getAnimalsTypes()
    {
        return array_unique(array_map(function ($animal) {
            return $animal->getAnimalType();
        }, $this->animals));
    }
}

$farm = new Farm();

// Добавление 10 коров на ферму
for ($i = 0; $i < 10; $i++) {
    $farm->createAnimal('cow', rand(8, 10));
}

// Добавление 20 кур на ферму
for($i = 0; $i < 20; $i++) {
    $farm->createAnimal('chicken', rand(0, 1));
}

// Получение количества животных каждого типа
$animalsCount = $farm->getAnimalsCount();
// Получение количества произведенной продукции за неделю
$productsCount = $farm->getProductsCount(7);

echo "На ферме {$animalsCount['chicken']} куриц \n";
echo "На ферме {$animalsCount['cow']} коров \n";

echo "За неделю собрано {$productsCount['chicken']} яиц \n";
echo "За неделю собрано {$productsCount['cow']} литров молока \n";

echo str_repeat('-', 50) . "\n";

// Добавление еще 5 кур на ферму
for($i = 0; $i < 5; $i++) {
    $farm->createAnimal('chicken', rand(0, 1));
}
// Добавление 1 коровы на ферму
$farm->createAnimal('cow', rand(8, 10));

// Получение количества животных каждого типа
$animalsCount = $farm->getAnimalsCount();
// Получение количества произведенной продукции за неделю
$productsCount = $farm->getProductsCount(7);

echo "На ферме {$animalsCount['chicken']} куриц \n";
echo "На ферме {$animalsCount['cow']} коров \n";

echo "За неделю собрано {$productsCount['chicken']} яиц \n";
echo "За неделю собрано {$productsCount['cow']} литров молока \n";