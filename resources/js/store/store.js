import axios from "axios";
import { reject } from "lodash";
import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({

    state: {

        status: "",
        token: localStorage.getItem("token") ? localStorage.getItem("token") : "",
        user_id: window.authUser.id,
        errors: [],
        error_message: "",
        access_token: "",
        response: '',
    },

    getters: {

        user_id: state => state.user_id,

        errorMessage: state => state.error_message,

        errors: state => state.errors,

        response: state => state.response,

        isLoggedIn: state => state.token,
    },

    mutations: {
        AUTH_REQUEST: state => {
            state.status = "loading";
        },
        AUTH_SUCCESS: (state, token, user) => {
            state.status = "success";
            state.token = token;
            state.user = user;
        },
        AUTH_ERROR: state => {
            state.status = "error";
        },
        LOGOUT: state => {
            state.status = "";
            state.token = "";
        },



    },

    actions: {
        createTask({commit}, data) {
            return new Promise((resolve, reject)=> {
                axios.post("/api/todo_list", data).then(response => {
                    this.state.response = response.data;
                    resolve(response)
                }).catch(error => {
                    this.state.errors = error;
                    reject(error)
                })
            })

        },

        updateTask({commit}, data) {
            return new Promise((resolve, reject)=> {
                console.log(data)
                axios.put("/api/todo_list/"+data.id, data).then(response => {
                    this.state.response = response.data;
                    resolve(response)
                }).catch(error => {
                    this.state.errors = error;
                    reject(error)
                })
            })

        },

        deleteTask({commit}, data) {
            return new Promise((resolve, reject)=> {
                console.log(data)
                axios.delete("/api/todo_list/"+data).then(response => {
                    this.state.response = response.data;
                    resolve(response)
                }).catch(error => {
                    this.state.errors = error;
                    reject(error)
                })
            })

        },

        completeTask({commit}, data) {
            return new Promise((resolve, reject)=> {
                console.log(data)
                axios.put("/api/todo_list/"+data.id, data).then(response => {
                    this.state.response = response.data;
                    resolve(response)
                }).catch(error => {
                    this.state.errors = error;
                    reject(error)
                })
            })
        },

    }

})
