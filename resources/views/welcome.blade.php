<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="{{asset('/css/app.css')}}"/>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
        </style>
    </head>
    <body ng-app="app">
        <div class="container" ng-controller="AppController as vm">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="usr">Customer ID:</label>
                        <input type="text" ng-model="customer" class="form-control" id="usr">
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="usr">Amount:</label>
                        <input type="text" ng-model="amount" class="form-control" id="usr">
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="usr">Date:</label>
                        <input type="text" ng-model="date" class="form-control datepicker" id="usr">
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-8">
                    <div class="form-group">
                        <button type="button" ng-click="vm.submitSearch()" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>

            <table id="transactions" ng-if="vm.checkIfTransactionsEmpty()" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer ID</th>
                        <th>Amount</th>
                        <th>Create At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="transaction in vm.transactions track by $index">
                        <td>@{{ transaction.transactionId }}</td>
                        <td>@{{ transaction.customerId }}</td>
                        <td>@{{ transaction.amount }}</td>
                        <td>@{{ transaction.created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.7/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('/js/app.js')}}"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
        });
    </script>

    </body>
</html>
