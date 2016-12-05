<?php

abstract class Vehicle
{
    abstract public function go(int $speed);
}

class Car extends Vehicle
{
    public function go(int $speed)
    {
        // Implementation of go() method.
    }
}

class Bike extends Vehicle
{
    public function go(int $speed)
    {
        // Implementation of go() method.
    }
}

class Human{
    public function move(Vehicle $vehicle)
    {
        $vehicle->go(50);
    }
}