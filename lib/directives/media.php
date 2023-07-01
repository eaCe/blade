<?php

return [
    'mediasrc' => static function ($fileName) {
        $fileName = Blade::stripDelimiter($fileName);
        $media = rex_media::get($fileName);

        if ($media) {
            $url = $media->getUrl();
            return "<?php echo '{$url}' ?>";
        }

        return "<?php echo '' ?>";
    },
];
