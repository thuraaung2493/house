<template>
    <section class="new-properties bg-black-2 pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5" v-for="gallery in galleries">
                    <div class="property">
                        <div class="image"><img :src="path + '/' + gallery.image_name + '.' + gallery.extension" alt="Condo with pool view" class="img-fluid gallery">
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <a :href="'/houses/' + gallery.house_id" class="btn btn-gradient btn-sm">View Details</a>
                            </div>
                        </div>
                        <div class="info">
                            <a href="property-single.html" class="no-anchor-style">
                                <h3 class="h4 text-thin text-uppercase mb-1">   {{ gallery.title }}
                                </h3>
                            </a>
                            <p>{{ gallery.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="text-center bg-black-2 pt-3">
            <button class="btn btn-gradient" v-if="seen" @click="loadMore">Load More</button>
        </section>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                galleries: [],
                path: '',
                num_of_data: 0,
                count: '',
                length: '',
            }
        },

        mounted() {
            this.readData();
        },

        methods: {
            readData() {
                this.num_of_data = 3;
                axios.get('/gallery/data/' + this.num_of_data)
                    .then(response => {
                        this.galleries = response.data.galleries;
                        this.path = response.data.path;
                        this.count = response.data.count;
                    });
            },

            loadMore() {
                this.num_of_data += 3;
                axios.get('/gallery/data/' + this.num_of_data)
                    .then(response => {
                        this.galleries = response.data.galleries;
                        this.path = response.data.path;
                    });
            },
        },

        computed: {
            seen() {
                return this.num_of_data < this.count; // 3 <= 5
            }
        }
    }
</script>
