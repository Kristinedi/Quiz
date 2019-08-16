<template>
    <div>
        <h2 class="mb-4">Hi, {{ name }}!</h2>

        <div v-if="error.length" class="alert alert-danger">
            {{ error }}
        </div>

        <div class="container mt-3  col-md-4 text-center">
            <select class="custom-select custom-select-sm" v-model="selectedQuizId">
                <option value="">Please select a quiz..</option>
                <option :value="quiz.id" v-for="quiz in quizzes">
                    {{ quiz.title }}
                </option>
            </select>
        </div>



        <br />

        <button class="mt-4 btn btn-success" @click="startQuiz" :disabled="!canStartQuiz">
            Start
        </button>
    </div>
</template>

<script>
    import axios from 'axios';
    import {Question} from "../models/quiz.models.js";

    export default {
        props: {
            name: {
                required: true,
            },

            quizzes: {
                default: [],
                required: true,
            },
        },

        data() {
            return {
                selectedQuizId: '',
                loading: false,
                error: '',
            }
        },

        methods: {
            startQuiz() {
                if (!this.canStartQuiz) {
                    return;
                }

                let data = new FormData;
                data.append('quizId', this.selectedQuizId);

                this.loading = true;

                axios.post('/quiz/start', data)
                    .then((response) => {
                        if (response.data.error) {
                            window.alert(response.data.error);
                            return;
                        }

                        let question = Question.fromArray(response.data.questionData);
                        this.$emit('quiz-started', {
                            'quizId': this.selectedQuizId,
                            'firstQuestion': question,
                        });
                    }).finally(() => {
                        this.loading = false;
                    });
            }
        },

        computed: {
            canStartQuiz() {
                return !!this.selectedQuizId && !this.loading;
            }
        }
    }
</script>
