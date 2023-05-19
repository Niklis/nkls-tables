## Nkls Livewire tables

#### Installation
`` composer require nkls/tables ``
#### Publish config
`` php artisan vendor:publish --tag=nkls-tables-config ``

#### You have to choose at least one theme and publish assets using tags
#### Available themes are:
#### - nkls-tables-bootstrap-5-3
#### - nkls-tables-mdb-bootstrap
#### For example you have choosen 'nkls-tables-bootstrap-5-3' theme, so the command you should execute would be:
`` php artisan vendor:publish --tag=nkls-tables-bootstrap-5-3 ``
#### set preffered theme in the config file:
``'theme' => 'bootstrap-5-3'``
##### after changes in the configuration, execute in the console
`` php artisan optimize ``
#### Publish all
`` php artisan vendor:publish --provider='Nkls\Tables\Providers\NklsTablesServiceProvider' ``
#### Publish only views
`` php artisan vendor:publish --tag=nkls-tables-views ``