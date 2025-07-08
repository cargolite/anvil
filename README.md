# Anvil

Anvil is an opinionated PHP code style fixer for minimalists, forked from [Laravel Pint](https://laravel.com/docs/master/pint), which itself is built on top of **[PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)** and makes it simple to ensure that your code style stays **clean** and **consistent**.

> ***anvil** (noun)*
>
> — a heavy iron block with a flat top and concave sides, on which metal can be hammered and shaped.

## Documentation

The primary difference between Pint and Anvil is the ability to specify which indentation styles and line-endings you prefer. By default, indentation is four spaces, so a configuration file needs to be created to use the recommended Cargolite guideline of two spaces.

> The recommended anvil.json file is at the end of this readme.

### Installation

You can install the package using `composer require cargolite/anvil --dev`

At the time of writing, Cargolite does not use Packagist or such-like service for first-party packages. Ideally, GitHub should provide a mechanism for this, failing which we will host our own at some point. But for now, you will need to add the below to the `repositories` section of your `composer.json` file in order for the `require` command to work:

```json
{
  "type": "github",
  "url": "https://github.com/cargolite/anvil"
}
```

### Usage

To format your entire codebase:

```shell
$ vendor/bin/anvil
```

To format specific files or directories:

```shell
$ vendor/bin/anvil cargolite/Models # directory
$ vendor/bin/anvil cargolite/Models/Shipment.php # specific file
```

Anvil will display a thorough list of all of the files that it updates. You can view even more detail about Anvil's changes by providing the `-v` option:

```shell
$ vendor/bin/anvil -v
```

If you would like Anvil to simply inspect your code for style errors without actually changing the files, you may use the --test option. Anvil will return a non-zero exit code if any code style errors are found:

```shell
$ vendor/bin/anvil --test
```

If you would like Anvil to only modify the files that have uncommitted changes according to Git, you may use the --dirty option:

```shell
$ vendor/bin/anvil --dirty
```

> NOTE: Cargolite's repositories are mostly Docker based. Running the command inside a container will not work, as there is no git there.

If you would like Anvil to fix any files with code style errors but also exit with a non-zero exit code if any errors were fixed, you may use the --repair option:

```shell
$ vendor/bin/anvil --repair
```

It's recommended to have Anvil format your files on save. If your IDE supports this, either by way of baked-in functionality or otherwise a plugin, please direct it to the `anvil` binary.

For example, Visual Studio Code does not have the ability to run arbitrary commands on save, and so a package named [Run on Save](https://marketplace.visualstudio.com/items?itemName=emeraldwalk.RunOnSave) helps with this. Once installed, you can update your workspace configuration file with the following:

```json
{
  "settings": {
    "emeraldwalk.runonsave": {
      "commands": [
        {
          "match": ".php",
          "cmd": "vendor/bin/anvil ${relativeFile}"
        }
      ]
    }
  }
}
```

There is also a similar package [here](https://marketplace.visualstudio.com/items?itemName=pucelle.run-on-save).

You may also want to use a Docker-based implementation that watches for file changes and applies formatting automatically. Provided `inotify-tools` is installed, you can run the following command as a separate container:

```shell
/bin/sh -c 'file=""; inotifywait -m -r -e close_write -e create --format "%w%f" --include "\.php$" ./ | while read -r file; do if [ -n "$$file" ]; then vendor/bin/anvil "$$file"; fi; done'
```

Further documentation can be read over on the Laravel website: [Pint Docs](https://laravel.com/docs/master/pint)

## License

Like Pint, Anvil is open-sourced software licensed under the [MIT license](LICENSE.md).

## Recommended `anvil.json` for all projects

```json
{
  "indent": "  ",
  "preset": "per",
  "rules": {
    "@PER-CS2.0": true,
    "array_push": true,
    "attribute_empty_parentheses": true,
    "backtick_to_shell_exec": true,
    "declare_strict_types": false,
    "global_namespace_import": {
      "import_classes": true,
      "import_constants": true,
      "import_functions": true
    },
    "group_import": false,
    "method_chaining_indentation": true,
    "no_unused_imports": true,
    "no_useless_else": true,
    "ordered_class_elements": {
      "order": [
        "use_trait",
        "case",
        "constant",
        "constant_public",
        "constant_protected",
        "constant_private",
        "property_public",
        "property_protected",
        "property_private",
        "construct",
        "destruct",
        "magic",
        "phpunit",
        "method_abstract",
        "method_public_static",
        "method_public",
        "method_protected_static",
        "method_protected",
        "method_private_static",
        "method_private"
      ],
      "sort_algorithm": "none"
    },
    "ordered_interfaces": true,
    "ordered_traits": true,
    "protected_to_private": true,
    "return_assignment": true,
    "self_static_accessor": true,
    "simplified_if_return": true,
    "single_quote": true,
    "ternary_to_null_coalescing": true,
    "yoda_style": {
      "equal": false,
      "identical": false,
      "less_and_greater": false
    }
  }
}

```
