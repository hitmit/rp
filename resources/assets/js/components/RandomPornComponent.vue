<template>
	<div class="container">
		<loading
          :active.sync="loading"
          :is-full-page="fullPage"
        ></loading>
        <div class="row">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-control">
                        <button type="button" class="btn" @click.prevent="getPorn"><i class="fa fa-random" aria-hidden="true"></i> Random Porn</button>
                    </div>
                    <h3 class="panel-title">Random Porn</h3>
                </div>
            </div>
        </div>
		<div class="row">
	        <div class="panel">
		        <div class="panel-heading">
                    <h3 class="panel-title">{{porn.title}}</h3>
                </div>
                <div class="panel-body">
                    <iframe :src="porn.id|pornURL" width="100%" height="478" frameborder="0" scrolling="no"><a href="http://www.pornrabbit.com" title="Porn Rabbit">Porn Rabbit</a></iframe>
                </div>
		    </div>    
		</div>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay'
    import 'vue-loading-overlay/dist/vue-loading.css'

    export default {
        components: {
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
    	props: ['page'],
    	data() {
            return {
                loading: false,
                fullPage: true,
                porn: [],
                pageId: this.page,
        	}
    	},
    	methods: {
            getPorn() {
                let vm = this;
            	vm.loading = true;
                axios.get('/api/random/porn')
                .then(function (response) {
                    vm.loading = false;
                    vm.porn = response.data.data.porn[0];
                }).catch(function (error) {
                    vm.loading = false;
                });
            },
        },
        mounted() {
        	this.getPorn()
        }
    }
</script>
