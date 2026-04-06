<?php
declare(strict_types=1);

namespace CodeCraft\PhpUiAutomator\UiElement;

use Codecraft\PhpUiautomator\DTO\UiElementInfo;
use Codecraft\PhpUiautomator\Exception\UiElementNotEditableException;
use Codecraft\PhpUiautomator\Exception\UiElementNotFoundException;
use Xvq\PhpAdb\Device;

class UiElement{
    public readonly UiElementInfo $info;
    public function __construct(
      private \DOMNode|\DOMNameSpaceNode|null $node,
      private Device $device
    ) {
        $this->info = new UiElementInfo($this);
    }

    private function parseBounds(string $bounds){
        if (!preg_match('/\[(\d+),(\d+)]\[(\d+),(\d+)]/',$bounds,$m)) {
            return null;
        }

        return [
            'left'    => (int)$m[1],
            'top'     => (int)$m[2],
            'right'   => (int)$m[3],
            'bottom'  => (int)$m[4],
            'centerX' => (int)(((int)$m[1] + (int)$m[3]) / 2),
            'centerY' => (int)(((int)$m[2] + (int)$m[4]) / 2),
        ];
    }

    public function click(){
        if ($this->node instanceof \DOMNode || $this->node instanceof \DOMNameSpaceNode) {
            $bounds = $this->parseBounds($this->info->toArray()["bounds"]);
            $x = $bounds['centerX'];
            $y = $bounds['centerY'];
            $this->device->input->tap($x,$y);
            return true;
        }
        throw new UiElementNotFoundException("Element not found: ".json_encode($this->node));
    }

    public function doubleClick(){
        if ($this->node instanceof \DOMNode || $this->node instanceof \DOMNameSpaceNode) {
           $bounds = $this->parseBounds($this->info->toArray()["bounds"]);
            $x = $bounds['centerX'];
            $y = $bounds['centerY'];
            for ($i=0; $i < 2; $i++) { 
                $this->device->input->tap($x,$y);
            }
            return true;
        }
        throw new UiElementNotFoundException("Element not found: ".json_encode($this->node));
    }

    public function longClick(int $duration=1){
        if ($this->node instanceof \DOMNode || $this->node instanceof \DOMNameSpaceNode) {
            $bounds = $this->parseBounds($this->info->toArray()["bounds"]);
            $x = $bounds['centerX'];
            $y = $bounds['centerY'];
            $this->device->input->swipe($x,$y,$x,$y,$duration);
            return true;
        }
        throw new UiElementNotFoundException("Element not found: ".json_encode($this->node));
    }

    public function getNode(){
        if ($this->node instanceof \DOMNode || $this->node instanceof \DOMNameSpaceNode) {
            return $this->node;
        }
        throw new UiElementNotFoundException("Element not found: ".json_encode($this->node));
    }
    public function setText(string $text){
        if ($this->node instanceof \DOMNode || $this->node instanceof \DOMNameSpaceNode) {
            if ($this->info->isEditable()) {
                $bounds = $this->parseBounds($this->info->toArray()["bounds"]);
                $x = $bounds['centerX'];
                $y = $bounds['centerY'];
                $this->device->input->tap($x,$y);
                $this->device->input->sendText($text);
                return true;
            }
            throw new UiElementNotEditableException("Element can't be editable: ".json_encode($this->node));
        }
        throw new UiElementNotFoundException("Element not found: ".json_encode($this->node));
    }

}