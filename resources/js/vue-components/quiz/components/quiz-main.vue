<template>
    <div>
        <quiz-start v-if="currentStep === 1"
                    :name="name"
                    :quizzes="quizzes"
                    @quiz-started="onQuizStarted">
        </quiz-start>

        <quiz-questions v-else-if="currentStep === 2"
                        :current-question="currentQuestion"
                        :current-quiz="currentQuiz"
                        :result="result"
                        @results-received="onResultsReceived">
        </quiz-questions>

        <quiz-results v-else-if="currentStep === 3"
                      :name="name"
                      :current-quiz="currentQuiz"
                      :result="result"
                      @quiz-finished="onQuizFinished">
        </quiz-results>

        <div v-else>
            <button @click="currentStep = 1">
                How did you get here? Return back to start.
            </button>
        </div>
    </div>
</template>

<script>
    import QuizStartComponent from './quiz-start.vue';
    import QuizQuestionsComponent from './quiz-questions.vue';
    import QuizResultsComponent from './quiz-results.vue';
    import {Quiz} from './../models/quiz.models.js';
    import Vue from 'vue';
    import BootstrapVue from 'bootstrap-vue';
    import 'bootstrap/dist/css/bootstrap.css'
    import 'bootstrap-vue/dist/bootstrap-vue.css'
    Vue.use(BootstrapVue);


    export default {
        components: {
            'quiz-start': QuizStartComponent,
            'quiz-questions': QuizQuestionsComponent,
            'quiz-results': QuizResultsComponent,
        },

        props: {
            name: {
                required: true,
            },

            quizzesProp: {
                default: [],
                required: true,
            },
        },

        created () {
            this.quizzes = this.quizzesProp.map((quizDatum) => {
                return Quiz.fromArray(quizDatum);
            });
        },

        data() {
            return {
                /** @type {Array<Quiz>} */
                quizzes: [],

                /** @type {Number} */
                currentStep: 1,

                /** @type {?Number} */
                currentQuiz: null,

                /** @type {?Question} */
                currentQuestion: null,

                /** @type {?Result} */
                result: null,
            }
        },

        methods: {
            /**
             * @param {{quizId: number, firstQuestion: Question}} emittedData
             */
            onQuizStarted(emittedData) {
                let quizId = emittedData.quizId;


                this.currentQuiz = this.quizzes.find((quiz) => {
                    return quiz.id === quizId;
                });


                this.currentQuestion = emittedData.firstQuestion;

                this.currentStep++;
            },

            /**
             * @param {Result} emittedResult
             */
            onResultsReceived(emittedResult) {
                this.result = emittedResult;

                this.currentStep++;

                this.currentQuestion = null;
            },

            onQuizFinished() {
                this.currentStep = 1;
                this.currentQuiz = null;
                this.result = null;
            }
        }
    }
</script>