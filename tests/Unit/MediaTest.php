<?php

describe('mediasrc', function () {
    it('should compile the mediasrc directive with arguments correctly', function () {
        $directive = "@mediasrc('test.jpg')";

        $fileName = 'test.jpg';
        $url = 'http://example.com/test.jpg';
        $media = new class() {
            public function getUrl() {
                return 'http://example.com/test.jpg';
            }
        };

        // Create a mock for the rex_media class
        $mediaMock = Mockery::mock('overload:rex_media');

        // Define the behavior for the get method
        $mediaMock->shouldReceive('get')
            ->with($fileName)
            ->andReturn($media);

        $compiled = $this->compile($directive);

        $expected = "<?php echo '{$url}' ?>";

        expect($compiled)->toBe($expected);
    });

    it('should compile the mediasrc directive with incorrect arguments correctly', function () {
        $directive = "@mediasrc('test.jpg')";

        $fileName = 'test.jpg';

        // Create a mock for the rex_media class
        $mediaMock = Mockery::mock('overload:rex_media');

        // Define the behavior for the get method
        $mediaMock->shouldReceive('get')
            ->with($fileName)
            ->andReturn(null);

        $compiled = $this->compile($directive);

        $expected = "<?php echo '' ?>";

        expect($compiled)->toBe($expected);
    });
});

