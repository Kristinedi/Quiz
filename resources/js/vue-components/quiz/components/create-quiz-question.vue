<template>
    <div>
        <h2 class="mb-4">Create new question for quiz: {{ quiz.title }}</h2>
        <h3>Question {{ questionCount + 1 }}</h3>

        <div class="my-3">
            <input v-model="questionText" placeholder="Question text...">
        </div>

        <div class="my-2" v-for="(answer, index) in answers" >
            <input required
                   type="text"
                   placeholder="Answer text..."
                   v-model="answer.text">
            <label for="correctAnswer" class="ml-2">Check if correct</label>
            <input type="checkbox"
                   id ="correctAnswer"
                   v-model="answer.isCorrect">
            <a class="btn btn-outline-danger py-0 ml-2"
               v-on:click="removeAnswer(index)"
               style="cursor: pointer">Remove</a>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary mr-2"
                    @click="addAnswer">
                Add answer
            </button>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary"
                    @click="createQuestion"
                    :disabled="isCreateButtonDisabled">
                Save question and create next question
            </button>
        </div>

        <div class="mt-4">
            <button class="btn btn-success"
                    @click="finishQuizCreation"
                    :disabled="isFinishButtonDisabled">
                Finish quiz creation
            </button>
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
        },

        data() {
            return {
                /** @type {boolean} */
                loading: false,

                /** @type {String} */
                questionText: "",

                /** @type {Array<Answer>>} */
                answers: [],

                questionCount: 0,
            }
        },

        methods: {
            addAnswer: function() {
                let answer = Answer.fromArray({
                    text: "",
                    isCorrect: false,
                });

                this.answers.push(answer);
            },

            removeAnswer(index) {
                this.answers.splice(index, 1);
            },

            createQuestion() {
                if (this.isCreateButtonDisabled) {
                    return;
                }

                let data = new FormData;

                data.append('quizId', this.quiz.id);
                data.append('questionText', this.questionText);

                this.answers.forEach(answer => {
                    data.append('answerText[]', answer.text);
                    data.append('isCorrect[]', answer.isCorrect)
                });

                this.loading = true;

                axios.post('/create-quiz/create-question', data)
                    .then((response) => {

                        if (response.data.error) {
                            window.alert(response.data.error);
                            return;
                        } else {
                            this.questionCount++;
                            this.answers = [];
                            this.questionText = null;
                        }

                    }).finally(() => {
                        this.loading = false;
                    })
            },

            finishQuizCreation() {
                if (this.isFinishButtonDisabled) {
                    return;
                }

                this.$emit('quiz-creation-finished', this.questionCount);
            }
        },

        computed: {
            isCreateButtonDisabled() {
                let hasCorrectAnswer = this.answers.some(answer => answer.isCorrect);
                let hasAnswerWithoutText = this.answers.some(answer => answer.text === "");
                return this.questionText === "" ||
                    this.answers.length === 0 ||
                    (!hasCorrectAnswer) ||
                    hasAnswerWithoutText||
                    this.loading;
            },

            isFinishButtonDisabled() {
                return this.questionCount === 0 || this.loading;
            }
        },
    }
</script>

