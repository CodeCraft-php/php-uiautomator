<?php
declare(strict_types=1);

namespace Codecraft\PhpUiautomator\Trait;

use Codecraft\PhpUiautomator\Exception\UiElementNotFoundException;
use CodeCraft\PhpUiAutomator\UiElement\UiElement;

Trait UiSelectorTrait{
    private function UiElementOrException(mixed $nodes){
        if ($nodes->length == 0) {
            throw new UiElementNotFoundException("Element not found: ".json_encode($nodes));
        }

        $node = $nodes->item(0);
        return new UiElement($node,$this->device);
    }
    public function find(string $attribute, string $value){
        $nodes = $this->uiautomatorDump()->query("//node[@$attribute='$value']");
        return $this->UiElementOrException($nodes);
    }
    public function findByClass(string $value){
        $nodes = $this->uiautomatorDump()->query("//node[@class='$value']");
        return $this->UiElementOrException($nodes);
    }
    public function findByResourceId(string $value){
        $nodes = $this->uiautomatorDump()->query("//node[@resource-id='$value']");
        return $this->UiElementOrException($nodes);
    }
    public function findByText(string $value){
        $nodes = $this->uiautomatorDump()->query("//node[@text='$value']");
        return $this->UiElementOrException($nodes);
    }
    public function findByContentDesc(string $value){
        $nodes = $this->uiautomatorDump()->query("//node[@content-desc='$value']");
        return $this->UiElementOrException($nodes);
    }
    public function findAll(string $attribute, string $value){
        $nodes = $this->uiautomatorDump()->query("//node[@$attribute='$value']");
        if ($nodes->length == 0) {
            throw new UiElementNotFoundException("Element not found: ".json_encode($nodes));
        }

        $array_nodes = [];
        
       for ($i=0; $i < $nodes->length; $i++) { 
            $array_nodes[] = new UiElement($nodes->item($i),$this->device);
       }

       return $array_nodes;
    }
}