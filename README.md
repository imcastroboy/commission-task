# Paysera Commission task skeleton

Following steps:
- don't forget to change `Paysera` namespace and package name in `composer.json`
 to your own, as `Paysera` keyword should not be used anywhere in your task;
- `\Paysera\CommissionTask\Service\Math` is an example class provided for the skeleton and could or could not be used by your preference;
- needed scripts could be found inside `composer.json`;
- before submitting the task make sure that all the scripts pass (`composer run test` in particular);
- this file should be updated before submitting the task with the documentation on how to run your program.

Good luck! :)


Situation
Paysera users can go to a branch to cash in and/or cash out from Paysera account. Several currencies are supported. There are also commission fees for both cash in and cash out.

Commission Fees
For Cash In
Commission fee - 0.03% from total amount, but no more than 5.00 EUR.

For Cash Out
There are different commission fees for cash out for natural and legal persons.

Natural Persons
Commission fee - 0.3% from cash out amount.

Legal persons
Commission fee - 0.3% from amount, but not less than 0.50 EUR for operation.

Supported currencies
3 currencies are supported: EUR, USD and JPY.

When converting currencies, following conversion rates are applied: EUR:USD - 1:1.1497, EUR:JPY - 1:129.53

Currency for Commission Fee
Commission fee is always calculated in the currency of particular operation (for example, if you cash out USD, commission fee is also in USD).

Rounding
After calculating commission fee, it's rounded to the smallest currency item (for example, for EUR currency - cents) to upper bound (ceiled). For example, 0.023 EUR should be rounded to 3 Euro cents.

Rounding is performed after currency conversion.

Input data
Input data is given in CSV file. Performed operations are given in that file. In each line following data is provided:

operation date in format Y-m-d
user's identificator, number
user's type, one of natural or legal
operation type, one of cash_in or cash_out
operation amount (for example 2.12 or 3)
operation currency, one of EUR, USD, JPY
All operations are ordered by their date ascendingly.

Expected Result
As a single argument program must accept a path to the input file.

Program must output result to stdout.

Result - calculated commission fees for each operation. In each line only final calculated commission fee must be provided without currency.

Example Data
➜  cat input.csv
2014-12-31,4,natural,cash_out,1200.00,EUR
2015-01-01,4,natural,cash_out,1000.00,EUR
2016-01-05,4,natural,cash_out,1000.00,EUR
2016-01-05,1,natural,cash_in,200.00,EUR
2016-01-06,2,legal,cash_out,300.00,EUR
2016-01-07,1,natural,cash_out,1000.00,EUR
2016-01-10,1,natural,cash_out,100.00,EUR
2016-01-10,2,legal,cash_in,1000000.00,EUR
2016-01-10,3,natural,cash_out,1000.00,EUR
2016-02-15,1,natural,cash_out,300.00,EUR
2016-01-07,1,natural,cash_out,100.00,USD
2016-02-19,5,natural,cash_out,3000000,JPY
➜  php script.php input.csv
3.60
3.00
3.00
0.06
0.90
3.00
0.30
5.00
3.00
0.90
0.30
9000
