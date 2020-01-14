# Commission Task
## How to setup
After cloning the repo, make sure to run this command in your terminal
```
composer install
```
## Usage
Here's an example command on how to use the code.
```
php script.php input.csv
```
The second paramater which is input.csv is the file that the script.php
will read.
You can change the value of the second parameter according to the name of
your file.

### **CSV File Format**
The csv file must follow these format.

| Date | User ID | User Type | Operation Type | Amount | Currency |
| --- | --- | --- | --- | --- | --- |

Here's an example values.

| 2014-02-14 | 9 | natural | cash_in | 1200 | EUR |
| --- | --- | --- | --- | --- | --- |
| 2014-03-04 | 8 | legal | cash_out | 500 | USD |
| 2014-03-04 | 8 | legal | cash_out | 500 | USD |

**Important note: Make sure not to include headers to your csv file.**

### **Supported Currencies**
These are the 3 currencies supported: **EUR**, **USD** and **JPY**

### **Supported Operation Types**
These are the types available: **cash_in** and **cash_out**

### **Supported User Types**
These are the user types available: **natural** and **legal**

## Unit Testing
Run these command to test the code.
```
composer run test
```
