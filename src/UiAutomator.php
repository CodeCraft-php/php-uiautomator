<?php
declare(strict_types=1);

namespace CodeCraft\PhpUiAutomator;
require "src/Trait/UiSelectorTrait.php";

use Codecraft\PhpUiautomator\Exception\UiAutomatorException;
use Codecraft\PhpUiautomator\Trait\UiSelectorTrait;
use Xvq\PhpAdb\Device;
use Xvq\PhpAdb\Exception\AdbException;

class UiAutomator{
    use UiSelectorTrait;
    private bool $redump = true;

    public function __construct(
       public Device $device
    ) {}
    private function uiautomatorDump(): \DOMXPath{
        $path = __DIR__."/UiDumpStorage/".date("d_m_o")."_".$this->device->info->model."_uidump.xml";
        
        if ($this->redump) {
           try {
                $resource = fopen($path,"w+");
                $dump = $this->device->shell->dumpHierarchy();
                fwrite($resource,$dump);
                fclose($resource);
           } catch (AdbException $th) {
                throw new UiAutomatorException($th->getMessage());
           }
        }

        $dom = new \DOMDocument();
        @$dom->loadXML(file_get_contents($path));

        return new \DOMXPath($dom);
    }
    public function setRedump(bool $dump){
        $this->redump = $dump;
    }
}