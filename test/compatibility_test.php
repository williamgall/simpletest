<?php

require_once dirname(__FILE__) . '/../autorun.php';
require_once dirname(__FILE__) . '/../compatibility.php';

class ComparisonClass { }
class ComparisonSubclass extends ComparisonClass { }
interface ComparisonInterface { }
class ComparisonClassWithInterface implements ComparisonInterface { }

class TestOfCompatibility extends UnitTestCase
{
    
    function testIsA() {
        $this->assertTrue(is_a(new ComparisonClass(), 'ComparisonClass'));
        $this->assertFalse(is_a(new ComparisonClass(), 'ComparisonSubclass'));
        $this->assertTrue(is_a(new ComparisonSubclass(), 'ComparisonClass'));
    }
    
    function testIdentityOfNumericStrings() {
        $numericString1 = "123";
        $numericString2 = "00123";
        $this->assertNotIdentical($numericString1, $numericString2);
    }
    
    function testIdentityOfObjects() {
        $object1 = new ComparisonClass();
        $object2 = new ComparisonClass();
        $this->assertIdentical($object1, $object2);
    }
    
    function testReferences () {
        $thing = "Hello";
        $thing_reference = &$thing;
        $thing_copy = $thing;
        $this->assertTrue(SimpleTestCompatibility::isReference(
                $thing,
                $thing));
        $this->assertTrue(SimpleTestCompatibility::isReference(
                $thing,
                $thing_reference));
        $this->assertFalse(SimpleTestCompatibility::isReference(
                $thing,
                $thing_copy));
    }
    
    function testObjectReferences () {
        $object = new ComparisonClass();
        $object_reference = $object;
        $object_copy = new ComparisonClass();
        $object_assignment = $object;
        $this->assertTrue(SimpleTestCompatibility::isReference(
                $object,
                $object));
        $this->assertTrue(SimpleTestCompatibility::isReference(
                $object,
                $object_reference));
        $this->assertFalse(SimpleTestCompatibility::isReference(
                $object,
                $object_copy));
        $this->assertTrue(SimpleTestCompatibility::isReference(
                $object,
                $object_assignment));
    }
    
    function testInteraceComparison() {
        $object = new ComparisonClassWithInterface();
        $this->assertFalse(is_a(new ComparisonClass(),'ComparisonInterface'));
        $this->assertTrue(is_a(new ComparisonClassWithInterface(),'ComparisonInterface'));
    }
}