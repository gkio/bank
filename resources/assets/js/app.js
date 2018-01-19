angular
    .module('app', [])

angular
    .module('app')
    .controller('AppController', AppController);

AppController.$inject = ['$http', '$scope'];

function AppController($http, $scope) {
    var vm = this;
    vm.transactions = []

    vm.submitSearch = function() {

        var customer = $scope.customer;
        var amount = $scope.amount
        var date = $scope.date;
        $http.get(`api/transaction/filtered/${customer}/${amount}/${date}/0/500`)
            .then(function(res) {
                if(res.status == 200 && res.data.transactions.length){
                    vm.transactions = res.data.transactions
                }
            })

        setTimeout(function() {
            document.getElementById('transactions').DataTable();
        }, 300)
    }

    vm.checkIfTransactionsEmpty = function() {
        return !!vm.transactions.length;
    }
}