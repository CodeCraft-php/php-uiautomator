<?php
declare(strict_types=1);

namespace Codecraft\PhpUiautomator\DTO;

use CodeCraft\PhpUiAutomator\UiElement\UiElement;

class UiElementInfo{
    public function __construct(
       private readonly UiElement $element
    ) {}
    public function toArray(): array{
        return [
            "index" => $this->element->getNode()->getAttribute("index"),
            "text" => $this->element->getNode()->getAttribute("text"),
            "resource-id" => $this->element->getNode()->getAttribute("resource-id"),
            "class" => $this->element->getNode()->getAttribute("class"),
            "package" => $this->element->getNode()->getAttribute("package"),
            "content-desc" => $this->element->getNode()->getAttribute("content-desc"),
            "checkable" => $this->element->getNode()->getAttribute("checkable"),
            "checked" => $this->element->getNode()->getAttribute("checked"),
            "clickable" => $this->element->getNode()->getAttribute("clickable"),
            "enabled" => $this->element->getNode()->getAttribute("enabled"),
            "focusable" => $this->element->getNode()->getAttribute("focusable"),
            "focused" => $this->element->getNode()->getAttribute("focused"),
            "scrollable" => $this->element->getNode()->getAttribute("scrollable"),
            "long-clickable" => $this->element->getNode()->getAttribute("long-clickable"),
            "password" => $this->element->getNode()->getAttribute("password"),
            "selected" => $this->element->getNode()->getAttribute("selected"),
            "bounds" => $this->element->getNode()->getAttribute("bounds")
        ];
    }
    public function getIndex(){
        return $this->toArray()["index"];
    }
    public function getText(){
        return $this->toArray()["text"];
    }
    public function getResourceId(){
        return $this->toArray()["resource-id"];
    }
    public function getClass(){
        return $this->toArray()["class"];
    }
    public function getPackage(){
        return $this->toArray()["package"];
    }
    public function getContentDesc(){
        return $this->toArray()["content-desc"];
    }
    public function isCheckable(){
        return (bool)$this->toArray()["checkable"];
    }
    public function isChecked(){
        return (bool)$this->toArray()["checked"];
    }
    public function isClickable(){
        return (bool)$this->toArray()["clickable"];
    }
    public function isEnabled(){
        return (bool)$this->toArray()["enabled"];
    }
    public function isFocusable(){
        return (bool)$this->toArray()["focusable"];
    }
    public function isFocused(){
        return (bool)$this->toArray()["focused"];
    }
    public function isScrollable(){
        return (bool)$this->toArray()["scrollable"];
    }
    public function isLongClickable(){
        return (bool)$this->toArray()["long-clickable"];
    }
    public function isPassword(){
        return (bool)$this->toArray()["password"];
    }
    public function isSelected(){
        return (bool)$this->toArray()["selected"];
    }
    public function getBounds(){
        return $this->toArray()["bounds"];
    }
    public function isEditable(){
        return "android.widget.EditText" === $this->toArray()["class"];
    }
}