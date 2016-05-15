<?php

namespace App\Tests\JsonSerializer;

use App\Serializer\JsonSerializer;

/**
 * Class JsonSerializerTest
 */
class JsonSerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var JsonSerializer
     */
    protected $serializer;

    public function setUp()
    {
        $this->serializer = new JsonSerializer();
    }

    /**
     * @dataProvider dataProvider
     */
    public function testSerialize($serializable, $expected)
    {
        $this->assertSame($expected, $this->serializer->serialize($serializable));
    }

    public function dataProvider()
    {
        $serializable = $this->getMockBuilder('\JsonSerializable')
            ->setMethods(['jsonSerialize'])
            ->getMock();

        $serializable
            ->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(['key' => 'value']);

        return [
            [$serializable, '{"key":"value"}'],
            ['test', '"test"'],
            [['key' => 'value'], '{"key":"value"}']
        ];
    }

    public function testDeserialize()
    {
        $serialized = '{"key":"value"}';
        $deserialized = $this->serializer->deserialize($serialized);

        $this->assertSame(['key' => 'value'], $deserialized);
    }

    /**
     * @expectedException \App\Exception\InvalidJsonException
     */
    public function testInvalidJsonException()
    {
        $this->serializer->deserialize(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidArgumentException()
    {
        $this->serializer->serialize($this->getMock('\ArrayIterator'));
    }
}