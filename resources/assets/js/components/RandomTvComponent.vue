<template>
	<div class="container">
		<loading
          :active.sync="loading"
          :is-full-page="fullPage"
        ></loading>
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-control">
                    <button type="button" class="btn" @click.prevent="getTvs"><i class="fa fa-random" aria-hidden="true"></i> Random List</button>
                </div>
                <h3 class="panel-title">Random Tv Shows</h3>
            </div>
        </div>
        <div class="row" v-for="i in Math.ceil(tvs.length / 4)">
		    <div class="col-md-3" v-for="item in tvs.slice((i - 1) * 4, i * 4)">  
			    <div class="panel">
			        <div class="panel-heading">
                        <h3 class="panel-title">{{item.name}}</h3>
                    </div>
		            <img  :src="item.poster_path|imageURL" class="img-responsive" />    
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
    	props: ['page'],
    	filters: {
		  imageURL: function (value) {
		    if (value) {
                return "https://image.tmdb.org/t/p/w300_and_h450_bestv2/" + value
            }
            return "images/noimagefound.jpg"
		  }
		},
    	data() {
            return {
                loading: false,
                fullPage: true,
                tvs: [],
                pageId: this.page,
        	}
    	},
    	methods: {
            getTvs() {
                let vm = this;
            	console.log('response.data')
                vm.loading = true;
                axios.post('/api/random/tv', {page: this.pageId})
                .then(function (response) {
                	console.log(response.data.data)
                    vm.loading = false;
                    vm.tvs = response.data.data.tvs;
                    vm.pageId = response.data.data.page;
                }).catch(function (error) {
                    vm.loading = false;
                });
            },
        },
        mounted() {
        	this.getTvs()
        }
    }
</script>
