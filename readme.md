Introduction 
Create a API that handles request / responses for a made up BANK. 
This API should be able to handle the following calls and reply in json format: 
[x] - adding of a customer: 
	- Request: name, cnp 
	- Response: customerId 
[x] - getting a transaction: 
	- Request: customerId, transactionId 
	- Response: transactionId, amount, date 
[x] - getting transaction by filters: 
	- Request: customerId, amount, date, offset, limit 
	- Response: an array of transactions 
[x] - adding a transaction: 
	- Request: customerId, amount 
	- Response: transactionId, customerId, amount, date 
[x] - updating a transaction: 
	- Request: transactionId, amount 
	- Response: transactionId, customerId, amount, date 
[x] - deleting a transaction: 
	- Request: trasactionId 
	- Response: success/fail 
Request example for getting a transaction: APP_URL/transaction/{customerId}/{transactionId} Response example for getting a transaction: 
{ 
	"transactionId":100, 
	"amount":205.67, 
	"date":"20.03.2015" 
} 

API 
[x] 1. Framework Setup
	a. Start and setup an app with any framework you wish. 
	b. Bonus: Using Laravel will be plus
[x] 2. Database handling
	a. You are free to create a database structure that will fulfill the API requirements. 
	b. Bonus: Use ORM system. 
[x] 3. Security
	a. Create a login system for GUI. 
	b. Create an auth system for API. 
[x] 4. Logging
	a. Log every request and response. Feel free to log anything else you think may also be important. 
[x] 5. Caching 
	a. Cache all API request / responses. API should use cached response if same request is sent within 1 hour. 

GUI 
1. Views
	a. Create a page where we can see transactions. Page should be accessible only for logged in users. 
2. Pagination 
	a. Based on the view created at point 1., implement a pagination. 5/10/50 transactions / page should be displayed. 
3. Filtering
	a. Based on the same view, we should be able to filter transactions by: 
	i. amount
	ii. date
	iii. Bonus: use a datepicker


Please create the UI responsive.

	iv. customerId All the points above should use the API to get the list of transactions.  
