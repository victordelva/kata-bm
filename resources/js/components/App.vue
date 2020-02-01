<template>
    <div class="container">
        <v-btn v-if="!requests[0] && !chargeActivated" @click="charge">Cargar Request</v-btn>
        <v-btn @click="inform">Generar Informe</v-btn>
        <v-data-table
            :loading="!myRequests[0] && (chargeActivated || informActivated)"
            :headers="headers"
            :items="myRequests"
            item-key="id"
            sort-by="time"
            sort-asc
            class="elevation-1"
        ></v-data-table>
        <v-snackbar
            v-model="snackbar"
            top
        >
            Esto podria tardar un poco
            <v-btn
                color="pink"
                text
                @click="snackbar = false"
            >
                Close
            </v-btn>
        </v-snackbar>
    </div>
</template>

<script>
    import { mapActions, mapState, mapGetters, mapMutations } from 'vuex';

    export default {
        computed: {
            ...mapState([
                'requests'
            ]),
            myRequests: function () {
                let self = this;
                return Object.values(this.requests).map(function (item) {
                    item.from_floor_id = self.getFloor(item.from_floor_id).name;
                    item.to_floor_ids = self.getFloor(item.to_floor_ids).name;
                    return item;
                });
            },
        },
        data () {
            return {
                headers: [
                    {
                        text: 'Origen',
                        align: 'left',
                        value: 'from_floor_id',
                    },
                    { text: 'Destino', value: 'to_floor_ids' },
                    { text: 'Hora', value: 'time' },
                    { text: 'Ascensor', value: 'elevator_id' },
                    { text: 'Plantas recorridas en la petición', value: 'floors_on_request' },
                    { text: 'Plantas recorridas hasta la llegada', value: 'floors_on_movement' },
                ],
                chargeActivated: false,
                informActivated: false,
                snackbar: false,
            }
        },
        mounted() {
            let self = this;
            this.fetchRequests();
            this.fetchFloors();
        },
        methods: {
            ...mapGetters([
                'findFloor'
            ]),
            ...mapActions([
                'fetchRequests',
                'fetchFloors',
                'transform',
                'turnOn',
            ]),
            ...mapMutations({
                'mutateRequests': 'requests',
            }),
            charge () {
                let self = this;
                this.snackbar = true;
                self.chargeActivated = true;
                this.transform().then(function () {
                    self.fetchRequests();
                });
            },
            inform() {
                let self = this;
                this.mutateRequests([]);
                this.snackbar = true;
                self.informActivated = true;
                this.turnOn().then(function () {
                    self.fetchRequests();
                });
            },
            getFloor(id) {
                return this.findFloor()(id);
            }
        },
    }
</script>
