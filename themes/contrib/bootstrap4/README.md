# Bootstrap 4 theme

## INTRODUCTION

This is a very non-prescriptive vanilla Bootstrap 4 theme 
with simple configuration. It can be used out of the box or 
as a subtheme for creating very flexible web designs with 
minimal changes (just override Bootstrap 4 variables.scss 
and recompile css!)

## FEATURES

* Bootstrap 4 library (4.4.1 and 4.5.0) included
* Bootstrap 4 style guide (view all Bootstrap 4 components on one page)
* Bootstrap 4 breakpoints
* Bootstrap 4 integration with CKEditor
* Bootstrap 4 configuration within admin user interface
* Interface for creating subtheme
* Can be used as is (subtheme is required for template overrides)
* Drupal 7, 8 and 9 compatible

## SASS compilation:

* SASS compilation is no longer in the theme.

## REQUIREMENTS

### Installation: composer
INSTALLATION

`composer require drupal/bootstrap4`

Head to `Appearance` and install bootstrap4 theme.

## CONFIGURATION

Head to `Appearance` and clicking bootstrap4 `settings`.

### Subtheme

* If you require subtheme (usually if you want to override templates), 
    see [subtheme docs](_SUBTHEME/README.md).

* You can create subtheme by running `bash bin/subtheme.sh [name] [path]`,
    e.g. `bash bin/subtheme.sh b4subtheme ..`

* Interface subtheme creation is coming to [Bootstrap4 Tools](https://www.drupal.org/project/bootstrap4_tools) module

## Development and patching

- Install development dependencies by running `npm install`
- To lint SASS files run `npm run lint:sass` (it will fail build if lint fails)
- To compile SASS (for Bootstrap 4.4.1) run `sass scss/style.scss css/style.css` (requires [SASS compiler](https://sass-lang.com/install))
- To compile SASS (for Bootstrap 4.5.0) run `sass scss/style-4-5-0.scss css/style.css` (requires [SASS compiler](https://sass-lang.com/install))
