# Carglite Anvil

Anvil is an opinionated PHP code style fixer for minimalists, forked from Laravel Pint, which itself is built on top of **[PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)** and makes it simple to ensure that your code style stays **clean** and **consistent**.

> *anvil (non)* — a heavy iron block with a flat top and concave sides, on which metal can be hammered and shaped.

## Documentation

The only difference between Pint and Anvil is the ability to specify which indentation styles and line-endings you prefer. By default, indentation is four spaces, so a configuration file needs to be created to use the recommended Cargolite guideline of two spaces.

> The recommended anvil.json file is at the end of this readme.

Documentation for Pint can be found on the [Laravel website](https://laravel.com/docs/pint).

### Installation

You can install the package using `composer require cargolite/anvil --dev`

At the time of writing, Cargolite does not use Packagist or such-like service for first-party packages. Ideally, GitHub should provide a mechanism for this, failing which we will host our own at some point. But for now, you will need to add the below to the `repositories` section of your `composer.json` file in order for the `require` command to work:

```json
{
  "type": "github",
  "url": "https://github.com/cargolite/anvil"
}
```

## License

Like Pint, Anvil is open-sourced software licensed under the [MIT license](LICENSE.md).

## Recommended `anvil.json` for all projects

```json
{
  "indent": "  ",
  "preset": "per",
  "rules": {
    "@PER-CS2.0": true,
    "array_indentation": true,
    "array_push": true,
    "array_syntax": {
      "syntax": "short"
    },
    "attribute_empty_parentheses": true,
    "backtick_to_shell_exec": true,
    "declare_strict_types": false,
    "function_declaration": {
      "closure_fn_spacing": "one",
      "closure_function_spacing": "one"
    },
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
    "ordered_imports": true,
    "ordered_interfaces": true,
    "ordered_traits": true,
    "protected_to_private": true,
    "return_assignment": true,
    "self_static_accessor": true,
    "single_import_per_statement": true,
    "single_quote": true,
    "ternary_to_null_coalescing": true,
    "trailing_comma_in_multiline": true
  }
}
```
