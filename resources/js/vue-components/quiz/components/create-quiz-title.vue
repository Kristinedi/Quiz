<template>
    <div>
        <h2 class="mb-4">Create new quiz</h2>

        <div>
            <input v-model="quizTitle" placeholder="Quiz title...">
        </div>

        <div>
            <button class="btn btn-primary mt-5"
                    @click="createTitle"
                    :disabled="isButtonDisabled">
                Create title
            </button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import {Quiz} from "../models/create-quiz.models";

    export default {
        data() {
            return {
                /** @type {boolean} */
                loading: false,

                /** @type {String} */
                quizTitle: "",

            }
        },

        methods: {

            createTitle() {
                if (this.isButtonDisabled) {
                    return;
                }

                let data = new FormData;
                data.append('quizTitle', this.quizTitle);

                this.loading = true;

                axios.post('/create-quiz/create-title', data)
                    .then((response) => {

                        if (response.data.error) {
                            window.alert(response.data.error);
                            return;
                        }

                        this.onResultsReceived(response.data.quizData);
                        return;
                    }).finally(() => {
                        this.loading = false;
                    })
            },

            onResultsReceived(quizData) {
                let quiz = Quiz.fromArray(quizData);

                this.$emit('title-created', quiz);
            }
        },

        computed: {
            isButtonDisabled() {
                return !this.quizTitle || this.loading;
            }
        },
    }
</script>

