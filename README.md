## Nkls Livewire tables

#### Installation
`` composer require nkls/tables ``
#### Publish all
`` php artisan vendor:publish --provider='Nkls\Tables\Providers\NklsTablesServiceProvider' ``
#### Publish only views
`` php artisan vendor:publish --tag=nkls-tables-views ``
#### Publish only config
`` php artisan vendor:publish --tag=nkls-tables-config ``
##### after changes in the configuration, execute in the console
`` php artisan optimize ``

##### del keywords