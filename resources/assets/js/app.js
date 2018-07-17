/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import axios from "axios";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',

    // init
    data: {
        search: '',
        hasSuccess: false,
        hasError: false,
        showButton: false,
        searching: false,
        usernameList: [],
        errorMessages: [],
    },
    // do this on load
    mounted: function () {
        axios.get('/usernames')
            .then(response => this.usernameList = response.data);
    },
    // setup methods
    methods: {

        // do a search of a name
        searchNames: function () {
            const vm = this;
            vm.searching = true;
            axios.get('/usernames/search', {
                params: {
                    search: vm.search
                }
            })
            // Found the username... no need to add to list!
                .then(function (response) {
                    console.log(response);
                    vm.showButton = false;
                    vm.hasSuccess = true;
                    vm.hasError = false;
                    vm.errorMessages = [];
                    vm.searching = false;
                })
                // didn't find
                .catch(function (error) {
                    if (error.response) {

                        // validation error or other error
                        if (error.response.data.search) {
                            vm.errorMessages = error.response.data.search;
                        }

                        // not available error
                        if (error.response.data.message) {
                            vm.errorMessages = [error.response.data.message];
                            vm.showButton = true; // if we get this type of error then show the button.
                        }
                    }
                    vm.hasSuccess = false;
                    vm.hasError = true;
                    vm.searching = false;
                });
        },

        addToList: function () {
            const vm = this;
            axios.post('/usernames', {
                search: vm.search,
            })
                .then(function (response) {
                    console.log(vm.usernameList);
                    vm.usernameList.push({
                        username: vm.search
                    });
                    vm.search = '';
                    vm.hasError = false;
                    vm.showButton = false;
                    vm.errorMessages = [];
                    vm.hasSuccess = false;
                })
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.data.search) {
                            vm.errorMessages = error.response.data.search;
                        }

                        if (error.response.data.message) {
                            vm.errorMessages = [error.response.data.message];
                        }
                    }
                    vm.hasSuccess = false;
                    vm.hasError = true;
                    vm.showButton = false;
                    vm.searching = false;
                });
        },
        deleteUsername: function (username) {
            const vm = this;
            axios.delete('/usernames/' + username)
                .then(response => vm.usernameList = response.data);
        }
    }
});
