<?php
namespace \PharSight;

class Generator
{
    private $phar;
    private $root; // the root of the phar

    public function __construct(\Phar $phar)
    {
        $this->phar = $phar;
    }

    public function addIncluded()
    {
        $files = get_included_files();

        foreach($files as $path) {
            $localName = $this->geLocalName($path);
            try {
                // remove the path prefix, this way every included file doesn't start
                // with your local source path
                $this->phar->addFile(realpath($path), $localName);
                echo "Added $path as $localName" . PHP_EOL;
            } catch (\Exception $e) {
                echo "Failed to add path: $path " . PHP_EOL;
            }
        }
    }

    public function setMain($path)
    {
        $localName = $this->getLocalName($path);
        $this->phar->addFile($path, $localName);
        $this->phar->setDefaultStub($localName);
    }

    private function getLocalName($path)
    {
        return str_replace($this->root, '', $path);
    }
}

