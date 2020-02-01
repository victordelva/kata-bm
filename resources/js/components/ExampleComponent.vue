<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        mounted() {
            let self = this;
            this.transform().then(function () {
                self.turnOn().then(function () {
                    self.requests();
                });
            });
        },
        methods: {
            ...mapActions([
                'requests',
                'transform',
                'turnOn'
            ]),
        },
    }
</script>
