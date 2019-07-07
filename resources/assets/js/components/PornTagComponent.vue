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
                        <h3 class="panel-title">Tags</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
        props: ['tag_id'],
        filters: {
            pornURL: function (value) {
                if (value) {
                    return "http://www.pornrabbit.com/embed/" + value + '/'
                }
                return "images/noimagefound.jpg"
            },
            videoURL: function (value) {
                if (value) {
                    return "porn/video/" + value 
                }
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
                tagId: this.tag_id,
            }
        },
        methods: {
            getResults(page) {
                let vm = this;
                vm.loading = true;
                if (typeof page === 'undefined') {
                    page = vm.pagination.current_page;
                }

                axios.get('/api/porn/tag/' + this.tagId + '?page=' + page)
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
