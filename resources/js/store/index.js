import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    strict: debug,
    state: {
        requests: 0
    },
    mutations: {
        requests (state, requests) {
            state.request = requests;
        }
    },
    actions: {
        requests (context) {
            axios.get('/api/requests').then(function (data) {
                console.log(data);
                context.commit('request', data);
            });
        },
        transform (context) {
            axios.put('/api/sequences/all/transform').then(function (data) {
                console.log(data);
                context.commit('request', data);
            });
        },
        turnOn (context) {
            axios.put('/api/elevators/all/turn-on').then(function (data) {
                console.log(data);
                context.commit('request', data);
            });
        },
    }
})
