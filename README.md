# PHP UiAutomator

A PHP library for Android UI automation, built on top of xvq/php-adb and ReactPHP.

## Description

PHP UiAutomator allows automating interactions with Android applications via ADB (Android Debug Bridge). It provides a simple API to find UI elements and perform actions like clicking, entering text, etc.

## Installation

Make sure you have Composer installed, then run:

```bash
composer require codecraft-php/php-uiautomator
```

## Prerequisites

- PHP 8.0 or higher
- ADB installed and configured
- An Android device connected in USB debugging mode

## Basic Usage

```php
<?php
require "vendor/autoload.php";

use CodeCraft\PhpUiAutomator\UiAutomator;
use Xvq\PhpAdb\AdbClient;

// Initialize ADB client
$adbClient = new AdbClient();
$device = $adbClient->device();

// Create UiAutomator instance
$uiautomator = new UiAutomator($device);

// Disable redump for better performance (optional)
$uiautomator->setRedump(false);

// Find an element by its resource-id and click it
$element = $uiautomator->findByResourceId("com.example.app:id/button");
$element->click();

// Enter text in an editable field
$textField = $uiautomator->findByClass("android.widget.EditText");
$textField->setText("Hello World");
```

## API

### UiAutomator Class

- `__construct(Device $device)`: Initializes with an ADB device.
- `setRedump(bool $dump)`: Enables/disables UI hierarchy redumping (default true).

#### Element Finding Methods

- `find(string $attribute, string $value)`: Find an element by generic attribute.
- `findByClass(string $value)`: Find by class (e.g., "android.widget.Button").
- `findByResourceId(string $value)`: Find by resource-id.
- `findByText(string $value)`: Find by visible text.
- `findByContentDesc(string $value)`: Find by content description.
- `findAll(string $attribute, string $value)`: Find all matching elements (returns an array).

### UiElement Class

Represents a found UI element.

#### Action Methods

- `click()`: Clicks the element.
- `doubleClick()`: Double-clicks the element.
- `longClick(int $duration = 1)`: Long press (in seconds).
- `setText(string $text)`: Enters text (only for editable elements).

#### Properties

- `$info`: UiElementInfo instance containing element information.

### UiElementInfo Class

Provides information about the element.

#### Methods

- `toArray()`: Returns all information as an array.
- `getIndex()`, `getText()`, `getResourceId()`, etc.: Individual accessors.
- `isEditable()`: Checks if the element is editable (based on class).

## Exceptions

- `UiAutomatorException`: General UiAutomator errors.
- `UiElementNotFoundException`: Element not found.
- `UiElementNotEditableException`: Attempt to input on a non-editable element.

## Complete Example

```php
<?php
require "vendor/autoload.php";

use CodeCraft\PhpUiAutomator\UiAutomator;
use Xvq\PhpAdb\AdbClient;

$adbClient = new AdbClient();
$device = $adbClient->device();
$uiautomator = new UiAutomator($device);

// Open an application
$uiautomator->findByText("Open App")->click();

// Enter text in a search field
$searchBox = $uiautomator->findByResourceId("com.app:id/search");
$searchBox->setText("search query");

// Click the search button
$searchButton = $uiautomator->findByText("Search");
$searchButton->click();
```

## License

MIT
