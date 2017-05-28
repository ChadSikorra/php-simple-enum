# php-simple-enum
Provides a simple enum and flag enum for PHP using traits and interfaces.

A simple enum example:

```php
use Enums\SimpleEnumInterface;
use Enums\SimpleEnumTrait;

class DayOfWeek implements SimpleEnumInterface
{
    use SimpleEnumTrait;

    const Monday = 1;

    const Tuesday = 2;

    const Wednesday = 3;

    const Thursday = 4;

    const Friday = 5;

    const Saturday = 6;

    const Sunday = 7;
}

// Get all of the names
var_dump(DayOfWeek::names());

// Get all of the values
var_dump(DayOfWeek::values());

// View it as an array
var_dump(DayOfWeek::toArray());

// Check if a name is valid. This is case insensitive.
if (DayOfWeek::isValidName('Monday')) {
    // ...
}

// Check if a value is valid.
if (DayOfWeek::isValidValue(DayOfWeek::Monday)) {
    // ...
}

// Get the name for a specific value.
var_dump(DayOfWeek::getValueName(1));

// Get the value for a specific name. This is case insensitive.
var_dump(DayOfWeek::getNameValue('Monday'));
```

A flag enum example:

```php
use Enums\FlagEnumInterface;
use Enums\FlagEnumTrait;

class FilePermission implements FlagEnumInterface
{
    use FlagEnumTrait;

    const Read = 1;

    const Write = 2;

    const Execute = 4;
}

$permission = new FilePermission(FilePermission::Read | FilePermission::Write);

// Remove a permission
$permission->remove('Write');

// Add a permission
$permission->add('Execute');

// Check for a permission
if ($permission->has('Read')) {
    // ...
}

// Get the flag value
var_dump($permission->getValue());

// Get all of the names for the flag as an array
var_dump($permission->getNames());

// View the string representation (comma delimited list)
var_dump((string) $permission);
```

The static methods are available in both the simple and flag enums.
