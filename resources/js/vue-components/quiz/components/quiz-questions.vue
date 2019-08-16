<template>
    <div>
        <h2 class="mb-4">{{ currentQuestion.text }}</h2>

        <div>
            <template v-for="answer in currentQuestion.answers">
                <button @click="selectAnswer(answer)"
                        class="btn mr-3"
                        :class="getAnswerButtonClass(answer)">
                    {{ answer.text }}
                </button>
            </template>
        </div>

        <div>
            <button class="btn btn-primary mt-5"
                    @click="getNextQuestion"
                    :disabled="isButtonDisabled">
                Next question
            </button>
        </div>

        <div class="mt-3">
            <b-progress :max="currentQuiz.questionCount" height="1rem">
                <b-progress-bar :value="questionProgress">
                    <strong>{{ questionProgress }} / {{ currentQuiz.questionCount }}</strong>
                </b-progress-bar>
            </b-progress>
        </div>

    </div>
</template>

<script>
    import axios from 'axios';
    import {Question, Answer} from "../models/quiz.models.js";
    import {Result} from "../models/quiz.models";

    export default {
        props: {
           /** @type {Question} */
            currentQuestion: {
                required: true,
            },

            /**
             * @type {Quiz}
             */
            currentQuiz: {
                required: true,
            },

            /**
             * @type {Result}
             */
            result: {
                required: true,
            }
        },

        data() {
            return {
                /** @type {Answer} */
                selectedAnswer: null,

                /** @type {boolean} */
                loading: false,

                /** @type {Number} */
                value: 1,

                questionProgress: 1,

            }
        },

        methods: {
            selectAnswer(answer) {
                this.selectedAnswer = answer;
            },

            getAnswerButtonClass(answer) {
                return {
                    'btn-light': answer !== this.selectedAnswer,
                    'btn-success': answer === this.selectedAnswer,
                }
            },

            getNextQuestion() {
                if (this.isButtonDisabled) {
                    return;
                }

                let data = new FormData;
                data.append('answerId', this.selectedAnswer.id);

                this.loading = true;
                this.selectedAnswer = null;

                axios.post('/quiz/next-question', data)
                    .then((response) => {

                        if (response.data.error) {
                            window.alert(response.data.error);
                            return;
                        }

                        if (response.data.resultData) {
                            this.onResultsReceived(response.data.resultData);
                            return;
                        }


                        let nextQuestion = Question.fromArray(response.data.questionData);
                        this.currentQuestion.id = nextQuestion.id;
                        this.currentQuestion.text = nextQuestion.text;
                        this.currentQuestion.answers = nextQuestion.answers;


                    }).finally(() => {
                        this.questionProgress++;
                        this.loading = false;
                    })
            },

            onResultsReceived(resultData) {
                let result = Result.fromArray(resultData);

                this.$emit('results-received', result);
            }
        },

        computed: {
            isButtonDisabled() {
                return !this.selectedAnswer || this.loading;
            }
        },
    }
</script>

