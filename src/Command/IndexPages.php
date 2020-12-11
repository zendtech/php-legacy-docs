<?php
declare(strict_types=1);

namespace App\Command;

class IndexPages
{
    public function execute()
    {
        $legacyUrlsIndex = [];
        foreach ([4, 5] as $versionNumber) {
            $filenames = $this->getHtmlFilenames($versionNumber);

            foreach ($filenames as $filename) {
                $uri = $this->filenameToUri($filename);
                $legacyUrlsIndex[$uri][] = $versionNumber;
            }
        }

        file_put_contents('var/legacyurls.json', json_encode($legacyUrlsIndex));
    }

    /**
     * @return string[]
     */
    private function getHtmlFilenames(int $versionNumber): array
    {
        return glob('php' . $versionNumber . '/**/*.html');
    }

    private function filenameToUri(string $filename): string
    {
        return preg_replace_callback('/^php.*\/.*\/(.*)\.html$/', function (array $matches) {
            return $matches[1];
        }, $filename);
    }
}
