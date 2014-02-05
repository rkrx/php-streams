<?php
namespace Kir\Streams\Common\Tests;

use Kir\Streams\Impl\PhpStream;

class PhpStreamTest extends \PHPUnit_Framework_TestCase {
	/**
	 */
	public function testRead() {
		$stream = $this->createStream();
		$data = $stream->read(7);
		$this->assertEquals('0987654', $data);
	}

	/**
	 */
	public function testReadAll() {
		$stream = $this->createStream();
		$data = $stream->read();
		$this->assertEquals('0987654321234567890', $data);
	}

	/**
	 */
	public function testWrite() {
		$stream = $this->createStream();
		$stream->truncate();
		$stream->write('ABCDEFG');
		$stream->rewind();
		$data = $stream->read();
		$this->assertEquals('ABCDEFG', $data);
	}

	/**
	 */
	public function testPositioning() {
		$stream = $this->createStream();
		$stream->setPosition(0);
		$this->assertEquals(0, $stream->getPosition(), 'Set position to stream start');
		$stream->setPosition(5);
		$this->assertEquals(5, $stream->getPosition(), 'Set position to 5');
		$this->assertEquals('54321', $stream->read(5));
	}

	/**
	 */
	public function testSerialization() {
		$stream = $this->createStream();
		$stream->setPosition(5);
		$expected = 'C:';
		$ser = serialize($stream);
		$this->assertStringStartsWith($expected, $ser);
		$stream = unserialize($ser);
		/* @var $stream PhpStream */
		$content = $stream->read();
		$this->assertEquals('54321234567890', $content);
		$stream->close();
	}

	/**
	 * @return PhpStream
	 */
	private function createStream() {
		$tempName = tempnam(sys_get_temp_dir(), __CLASS__);
		file_put_contents($tempName, '0987654321234567890');
		$stream = new PhpStream($tempName, 'r+');
		return $stream->open();
	}
}
 