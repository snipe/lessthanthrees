
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

const app = new Vue({
    el: '#vue-wrapper',

    data: {
        items: [],
        hasError: true,
        hasDeleted: true,
        category: 'movies',
        newItem : {'name':'', 'category_id':'1', 'description': ''}
    },
    mounted : function(){
        this.getVueItems();
    },
    methods : {
        getVueItems: function(){
            axios.get('/vueitems/movies').then(response => {
                this.items = response.data;
                console.dir(this.items);

        });
        },
        createItem: function(){
            var input = this.newItem;
            if  (input['name'] == '') {
                this.hasError = false;
                this.hasDeleted = true;
            } else {
                this.hasError = true;
                axios.post('/vueitems',input)
                    .then(response => {
                    this.newItem = {'name':'','category_id': input['category_id']};
                this.getVueItems();
            });
                this.hasDeleted = true;
            }
        },
        deleteItem: function(item){
            axios.post('/vueitems/'+item.id).then((response) => {
                this.getVueItems();
            this.hasError = true,
                this.hasDeleted = false
        });
        },

        faveItem: function(item){
            this.hasFave = true
            this.hasUnfave = false
            axios.post('/fave/'+item.id).then((response) => {
                this.getVueItems();
            this.hasError = true,
                this.hasFave = false
        });
        },

        unfaveItem: function(item){
            this.hasFave = false
            this.hasUnfave = true
            axios.post('/unfave/'+item.id).then((response) => {
                this.getVueItems();
            this.hasError = true,
                this.hasUnfave = false
        });
        },
    }
});

// localStorage persistence
var STORAGE_KEY = 'todos-vuejs-2.0'
var todoStorage = {
    fetch: function () {
        var todos = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]')
        todos.forEach(function (todo, index) {
            todo.id = index
        })
        todoStorage.uid = todos.length
        return todos
    },
    save: function (todos) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(todos))
    }
}

// visibility filters
var filters = {
    all: function (todos) {
        return todos
    },
    active: function (todos) {
        return todos.filter(function (todo) {
            return !todo.completed
        })
    },
    completed: function (todos) {
        return todos.filter(function (todo) {
            return todo.completed
        })
    }
}

// app Vue instance
var app = new Vue({
    // app initial state
    data: {
        todos: todoStorage.fetch(),
        newTodo: '',
        editedTodo: null,
        visibility: 'all'
    },

    // watch todos change for localStorage persistence
    watch: {
        todos: {
            handler: function (todos) {
                todoStorage.save(todos)
            },
            deep: true
        }
    },

    // computed properties
    // http://vuejs.org/guide/computed.html
    computed: {
        filteredTodos: function () {
            return filters[this.visibility](this.todos)
        },
        remaining: function () {
            return filters.active(this.todos).length
        },
        allDone: {
            get: function () {
                return this.remaining === 0
            },
            set: function (value) {
                this.todos.forEach(function (todo) {
                    todo.completed = value
                })
            }
        }
    },

    filters: {
        pluralize: function (n) {
            return n === 1 ? 'item' : 'items'
        }
    },

    // methods that implement data logic.
    // note there's no DOM manipulation here at all.
    methods: {
        addTodo: function () {
            var value = this.newTodo && this.newTodo.trim()
            if (!value) {
                return
            }
            this.todos.push({
                id: todoStorage.uid++,
                title: value,
                completed: false
            })
            this.newTodo = ''
        },

        removeTodo: function (todo) {
            this.todos.splice(this.todos.indexOf(todo), 1)
        },

        editTodo: function (todo) {
            this.beforeEditCache = todo.title
            this.editedTodo = todo
        },

        doneEdit: function (todo) {
            if (!this.editedTodo) {
                return
            }
            this.editedTodo = null
            todo.title = todo.title.trim()
            if (!todo.title) {
                this.removeTodo(todo)
            }
        },

        cancelEdit: function (todo) {
            this.editedTodo = null
            todo.title = this.beforeEditCache
        },

        removeCompleted: function () {
            this.todos = filters.active(this.todos)
        }
    },

    // a custom directive to wait for the DOM to be updated
    // before focusing on the input field.
    // http://vuejs.org/guide/custom-directive.html
    directives: {
        'todo-focus': function (el, value) {
            if (value) {
                el.focus()
            }
        }
    }
})

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

