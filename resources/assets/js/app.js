
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Next, we will create a fresh Vue application instance and attach it to the
 * page. Then, you may begin adding components to this application or customize
 * the JavaScript scaffolding to fit your unique needs.
 */



// visibility filters
var filters = {
    all: function (items) {
        return items
    },
    active: function (items) {
        return items.filter(function (item) {
            return !item.completed
        })
    },
    faved: function (items) {
        return items.filter(function (item) {
            return !item.liked
        })
    },
    completed: function (items) {
        return items.filter(function (item) {
            return item.completed
        })
    }
}


// app Vue instance
var app = new Vue({
    el: '#vue-wrapper',

    // app initial state
    data: {
        items: [],
        newItem : {'name':'', 'category_id':'1', 'description': ''},
        editedItem: null,
        visibility: 'all',
        hasError: true,
        hasDeleted: true,
        loading: true,
        searchString: '',
        liked: false
    },


    created: function () {
        this.fetchItemData()
    },

    computed: {

        filteredItems: function () {
            var items_array = this.items,
                searchString = this.searchString;

            // console.dir(this.items);
            // console.dir(searchString);

            if (!searchString){
                return items_array;
            }

            searchString = searchString.trim().toLowerCase();

            items_array = items_array.filter(function(item) {
                if(item.name.toLowerCase().indexOf(searchString) !== -1){
                    return item;
                }
            })

            // Return an array with the filtered data.
            return items_array;
        },
        
        // filteredItems: function () {
        //     return filters[this.visibility](this.items)
        // },
        remaining: function () {
            return filters.active(this.items).length
        },
        allDone: {
            get: function () {
                return this.remaining === 0
            },
            set: function (value) {
                this.items.forEach(function (item) {
                    item.completed = value
                })
            }
        }
    },

    filters: {
        pluralize: function (n) {
            return n === 1 ? 'item' : 'items'
        }
    },

    methods: {

        fetchItemData: function () {
            var _this = this;

            axios.get('/vueitems/' + selected_category, {
                before: () => {
                    this.loading = true;
                }
                }).then(response => {
                    _this.items = response.data;
                }).then(() => {
                    //set loading flag to false
                    this.loading = false;
                })

        },

        createItem: function () {
            var input = this.newItem;
            if  (input['name'] == '') {
                this.hasError = false;
            } else {
                this.hasError = true;
                axios.post('/vueitems',input)
                    .then(response => {
                    this.newItem = {'name':'','category_id': input['category_id']};
                this.fetchItemData();
            });
            }
        },

        faveItem: function(item){
            this.submitted = true;
            axios.post('/fave/' + item.id).then((response) => {

                this.fetchItemData();
            this.liked = true;
            this.submitted = false;
            this.text = 'Unlike';
        });
        },

        unfaveItem: function(item) {
            axios.post('/unfave/' + item.id).then((response) => {

                this.fetchItemData();
            this.liked = false;
            this.submitted = false;
            this.text = 'Like';

        });
        },


        toggleFave: function(item)
        {
            if(this.liked) {
                this.unfaveItem(item)
            } else {
                this.faveItem(item)
            }
        },


        deleteItem: function(item) {
            axios.post('/vueitems/'+item.id).then((response) => {
                this.fetchItemData();
            });
        },

        editItem: function (item) {
            this.beforeEditCache = item.name
            this.editedItem = item
        },

        doneEdit: function (item) {
            if (!this.editedItem) {
                return
            }
            this.editedItem = null
            item.name = item.name.trim()
            if (!item.name) {
                this.removeItem(item)
            }
        },

        cancelEdit: function (item) {
            this.editedItem = null
            item.name = this.beforeEditCache
        },

        removeCompleted: function () {
            this.items = filters.active(this.items)
        },


    },

    // a custom directive to wait for the DOM to be updated
    // before focusing on the input field.
    // http://vuejs.org/guide/custom-directive.html
    directives: {
        'item-focus': function (el, value) {
            if (value) {
                el.focus()
            }
        }
    }
});



// handle routing
function onHashChange () {
    var visibility = window.location.hash.replace(/#\/?/, '')
    if (filters[visibility]) {
        app.visibility = visibility
    } else {
        window.location.hash = ''
        app.visibility = 'all'
    }
}

window.addEventListener('hashchange', onHashChange)
onHashChange()


$(function() {

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $("#register-form").hide();
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $("#login-form").hide();
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });

});



