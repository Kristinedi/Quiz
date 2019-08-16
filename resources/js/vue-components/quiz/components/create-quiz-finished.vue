<template>
    <div class="mt-4">
        <h2 class="mb-4">Finished creating quiz: {{ quiz.title }} </h2>
        <h3>Created {{ questionsCreated }} questions</h3>

        <div class="mt-4">
            <button class="btn btn-info mr-2" @click="endQuizCreation">Create another quiz</button>
            <a class="btn btn-info" href="/">Go to home page</a>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import {Quiz, Question, Answer} from "../models/create-quiz.models";

    export default {
        props: {
            /** @type {Quiz} */
            quiz: {
                required: true,
            },

            /** @type {int} */
            questionsCreated: {
                required: true
            }
        },

        methods: {
            endQuizCreation() {
                this.$emit('end-quiz-creation', this.questionCount);
            }
        },
    }
</script>

