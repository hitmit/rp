
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('random-porn-component', require('./components/RandomPornComponent.vue'));
Vue.component('porn-home-component', require('./components/PornHomeComponent.vue'));
Vue.component('porn-categories-component', require('./components/PornCategoriesComponent.vue'));
Vue.component('porn-category-component', require('./components/PornCategoryComponent.vue'));
Vue.component('porn-tag-component', require('./components/PornTagComponent.vue'));
Vue.component('porn-video-component', require('./components/PornVideoComponent.vue'));

Vue.filter('pornURL', function (value) {
  	if (value) {
		return "http://www.pornrabbit.com/embed/" + value + '/'
	}
	return "images/noimagefound.jpg"
});

Vue.filter('videoURL', function (value) {
  	if (value) {
		return "/porn/video/" + value
	}
	return '#';
});

const app = new Vue({
    el: '#app'
});
