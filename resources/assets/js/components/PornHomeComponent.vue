<template>
	<div class="container">
		<loading
          :active.sync="loading"
          :is-full-page="fullPage"
        ></loading>
        <div class="row" v-for="i in Math.ceil(porns.length / 3)">
		    <div class="col-md-4" v-for="item in porns.slice((i - 1) * 3, i * 3)">  
			    <div class="panel">
			        <div class="panel-heading">
                        <h3 class="panel-title"><a :href="item.id|videoURL">{{item.title}}</a></h3>
                    </div>
		            <iframe :src="item.id|pornURL" width="100%" height="200" frameborder="0" scrolling="no"><a href="http://www.pornrabbit.com" title="Porn Rabbit">Porn Rabbit</a></iframe>    
			    </div>
		    </div>
		</div>
        <!-- Pagination -->
        <pagination :pagination="pagination" :callback="getResults" :options="paginationOptions"></pagination>        
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
        filters: {
          pornURL: function (value) {
            if (value) {
                return "http://www.pornrabbit.com/embed/" + value + '/'
            }
            return "images/noimagefound.jpg"
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
                porns: [],
                loading: false,
                fullPage: true,                
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
            this.getResults();
        }
    }
</script>
