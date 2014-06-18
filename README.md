VeriCoinDice-PHP
================

vericoindice.com PHP library - allows access to the getbalance and roll

Get your API key at https://vericoindice.com

### Usage

##### Initialise
Create a VericoindiceClient object, and pass your API key

```php
$client = new VericoindiceClient('YOUR_API_KEY');
```

##### Get account balance
```php
$client->get_balance();
```

##### Roll the dice
VericoindiceClient::roll() takes two parameters: $amount and $chance
$amount is the amount of VRC you wish to bet on the roll
$chance is the percentage odds you wish to roll with 
```php
$client->roll('1','12.5');
```


### Example

```php
try {
  $client = new VericoindiceClient('YOUR_API_KEY');
  echo 'balance: ' . $client->get_balance() . PHP_EOL;
  echo 'running...' . PHP_EOL;
  print_r($client->roll(100));
  echo 'balance: ' . $client->get_balance() . PHP_EOL;
} catch (VericoindiceError $e) {
  echo 'error: ' . $e . PHP_EOL;
}
```