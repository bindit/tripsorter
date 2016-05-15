<?php

namespace Trip\Tests;

/**
 * Class GetAndSetTest
 *
 * Class will cover only simple setters & getters (only with one parameter)
 * rest of functions must be cover manually
 *
 */
abstract class GetAndSetTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    public function tearDown()
    {
        $this->object = null;
    }

    public function testSettersAndGetters()
    {
        if (!is_object($this->object)) {
            throw new \Exception("Transfer must be defined");
        }

        $reflection = new \ReflectionClass($this->object);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $this->method($reflection, $property);
        }
    }

    /**
     * @param \ReflectionClass $reflection
     * @param \ReflectionProperty $property
     */
    protected function method(\ReflectionClass $reflection, \ReflectionProperty $property)
    {
        $name = $property->getName();
        $setMethod = 'set' . ucfirst($name);
        $getMethod = 'get' . ucfirst($name);
        $isMethod  = strpos('is', $name) == 0 ? $name : null;

        if ($reflection->hasMethod($setMethod)) {
            $method = new \ReflectionMethod($this->object, $setMethod);

            if (count($method->getParameters()) != 1) { //handle only simple set & get method, if more parameters - test it yourself
                return;
            }

            $parameters = $method->getParameters();
            $value = $this->buildParametersForMethod(reset($parameters));
            $this->object->$setMethod($value);
        }

        if (!isset($value)) {
            return;
        }

        if ($reflection->hasMethod($getMethod)) {
            $this->assertEquals($value, $this->object->$getMethod());
        }

        if ($isMethod && $reflection->hasMethod($isMethod)) {
            $this->assertEquals($value, $this->object->$isMethod());
        }
    }

    /**
     * @param \ReflectionParameter $parameter
     * @return \PHPUnit_Framework_MockObject_MockObject|string
     */
    protected function buildParametersForMethod(\ReflectionParameter $parameter)
    {
        if($parameter->getClass() === null) {
            return 'simpleValue';
        }

        return $this->getMockBuilder($parameter->getClass()->name)
            ->disableOriginalConstructor()
            ->getMock()
        ;
    }
}
