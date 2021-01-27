<?php

declare(strict_types=1);

namespace WsdlToPhp\PackageBase\Tests;

use DOMDocument;
use InvalidArgumentException;
use WsdlToPhp\PackageBase\Utils;

class UtilsTest extends TestCase
{
    public function testGetFormattedXmlAsString()
    {
        $this->assertEquals(file_get_contents(__DIR__ . '/resources/formated.xml'), Utils::getFormattedXml(file_get_contents(__DIR__ . '/resources/oneline.xml')));
    }

    public function testGetFormattedXmlAsDomDocument()
    {
        $this->assertInstanceOf(DOMDocument::class, Utils::getFormattedXml(file_get_contents(__DIR__ . '/resources/oneline.xml'), true));
    }

    public function testGetFormattedXmlEmptyStringAsString()
    {
        $this->expectException(InvalidArgumentException::class);

        Utils::getFormattedXml('');
    }

    public function testGetFormattedXmlEmptyStringAsDomDocument()
    {
        $this->expectException(InvalidArgumentException::class);

        Utils::getFormattedXml('', true);
    }

    public function testGetFormattedXmlInvalidXmlAsDomDocument()
    {
        $this->expectException(InvalidArgumentException::class);

        Utils::getFormattedXml('<xsd:schema xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:img="http://ws.estesexpress.com/imageview" attributeFormDefault="unqualified" elementFormDefault="qualified" targetNamespace="http://ws.estesexpress.com/imageview" xml:lang="en"><root>', true);
    }

    public function testGetFormattedXmlNullAsString()
    {
        $this->assertNull(Utils::getFormattedXml(null));
    }

    public function testGetFormattedXmlNullAsDomDocument()
    {
        $this->assertNull(Utils::getFormattedXml(null, true));
    }

    public function testGetDOMDocument()
    {
        $this->assertInstanceOf(DOMDocument::class, Utils::getDOMDocument(file_get_contents(__DIR__ . '/resources/oneline.xml')));
    }

    public function testGetDOMDocumentException()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->assertInstanceOf(DOMDocument::class, Utils::getDOMDocument(''));
    }
}
