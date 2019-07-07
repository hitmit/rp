<template>
	<div class="container">
        <loading
          :active.sync="loading"
          :is-full-page="fullPage"
        ></loading>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-control">
                        </div>
                        <h3 class="panel-title">Categories</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
        		<div class="row" v-for="i in Math.ceil(porns.length / 2)">
                    <div class="col-md-6" v-for="item in porns.slice((i - 1) * 2, i * 2)">  
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><a :href="item.id|videoURL">{{item.title}}</a></h3>
                            </div>
                            <iframe :src="item.id|pornURL" width="100%" height="300" frameborder="0" scrolling="no"><a href="http://www.pornrabbit.com" title="Porn Rabbit">Porn Rabbit</a></iframe>    
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                <pagination :pagination="pagination" :callback="getResults" :options="paginationOptions"></pagination>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Categories</h3>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"  v-for="category in categories"> <a :href="category.id|categoryIdFilter">{{ category.name|categoryFilter }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import pagination from 'vue-bootstrap-pagination';

    import Loading from 'vue-loading-overlay'
    import 'vue-loading-overlay/dist/vue-loading.css'

    export default {
        components: {
            pagination,
            Loading
        },
    	props: ['category_list'],
    	filters: {
            categoryFilter: function (value) {
                return value.charAt(0).toUpperCase() + value.slice(1);    
            },
            categoryIdFilter: function (value) {
                return "/porn/category/" + value;    
            }
		},
    	data() {
            return {
               pagination: {
                    total: 0,
                    per_page: 10,
                    current_page: 1,
                    last_page: 0,
                    from: 1,
                    to: 10
                },
                paginationOptions: {
                    offset: 4,
                    previousText: 'Prev',
                    nextText: 'Next',
                    alwaysShowPrevNext: true
                },    
                loading: false,
                fullPage: true,
                porns: [],
                categories: this.category_list,
        	}
    	},
    	methods: {
            getResults(page) {
                let vm = this;
                vm.loading = true;
                if (typeof page === 'undefined') {
                    page = vm.pagination.current_page;
                }

                axios.get('/api/porn/home?page=' + page)
                .then(function (response) {
                    vm.loading = false;
                    vm.porns = response.data.data;
                    vm.pagination = response.data;
                }).catch(function (error) {
                    vm.loading = false;
                });
            },
        },
        mounted() {
        	this.getResults()
        }
    }
</script>
