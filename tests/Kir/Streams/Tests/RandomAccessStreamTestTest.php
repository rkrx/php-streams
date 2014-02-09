<?php
namespace Kir\Streams\Tests;

use Kir\Streams\Tests\Helper\ClosureStreamFactory;
use Kir\Streams\Tests\Helper\NondestructiveReadWriteStream;
use Kir\Streams\Tests\Helper\ResourceStream;

class RandomAccessStreamTestTest extends ResourceStreamTest {
	protected function setUp() {
		$factory = new ClosureStreamFactory(function () {
			$stream = new ResourceStream(__DIR__.'/../../../../tests/assets/test-data.txt', 'r');
			$stream = new NondestructiveReadWriteStream($stream);
			return $stream;
		});
		parent::setUp($factory);
	}
}
 