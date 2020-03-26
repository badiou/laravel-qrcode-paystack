LARAVEL PAYSTACK PAYMENT PROJECT

1-	INTRODUCTION
This application is an application that allows you to create QR codes of items and to make an online payment for these items using the paystack payment method 
(https://www.paystack.com).
2-	INFYOM-GENERATOR
To set up this application, I use infyomlabs / laravel-generator to generate the CRUD from the tables generated in the database:
To access the documentation of InfyOm, please go to the following link: 
https://labs.infyom.com/laravelgenerator/docs/5.6/installation.

3-	QRCODE GENERATOR
The QRCODE generator uses this repository : https://github.com/werneckbh/laravel-qr-code.git

4-	PAYMENT METHOD
As part of payment with Paystack (a payment method from Nigeria to Naira), my application uses the git repos: https://github.com/unicodeveloper/laravel-paystack.git
If the user click on pay with paystack button the application redirect him to paystack website. Here, i use just a test card that i have created when i have sign up on paystack website.
5-	After making payment, You will be redirect user to our laravel application. You can see on the datatables the status of transactions and the date of the transaction. After this paystack would be send you an email for to notify about transaction.DATABABLE
This documentation can help you to implement datatable on your project…. 
https://yajrabox.com/docs/laravel-datatables/master/introduction
