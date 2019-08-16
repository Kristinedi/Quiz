<template>
    <div>
        <create-quiz-title v-if="currentStep === 1"
                    @title-created="onTitleCreated">
        </create-quiz-title>

        <create-quiz-question v-else-if="currentStep === 2"
                    :quiz="quiz"
                    @quiz-creation-finished="onQuizCreationFinished">
        </create-quiz-question>

        <create-quiz-finished v-else-if="currentStep === 3"
                      :quiz="quiz"
                      :questions-created="questionsCreated"
                      @end-quiz-creation="onEndQuizCreation">
        </create-quiz-finished>

        <div v-else>
            <button @click="currentStep = 1">
                How did you get here? Return back to start.
            </button>
        </div>
    </div>
</template>

<script>
    import CreateQuizTitleComponent from './create-quiz-title.vue';
    import CreateQuizQuestionComponent from './create-quiz-question.vue';
    import CreateQuizFinishedComponent from './create-quiz-finished.vue';
    import {Quiz} from './../models/create-quiz.models.js';

    export default {
        components: {
            'create-quiz-title': CreateQuizTitleComponent,
            'create-quiz-question': CreateQuizQuestionComponent,
            'create-quiz-finished': CreateQuizFinishedComponent,
        },

        data() {
            return {
                /** @type {Number} */
                currentStep: 1,

                /** @type {?Quiz} */
                quiz: null,

                /** @type {int} */
                questionsCreated: 0,
            }
        },

        methods: {
            /**
             * @param {{quizId: number, firstQuestion: Question}} emittedData
             */
            onTitleCreated(emittedData) {
                this.quiz = emittedData;
                this.currentStep++;
            },

            /**
             * @param {int} emittedData
             */
            onQuizCreationFinished(emittedData) {
                this.questionsCreated = emittedData;
                this.currentStep++;
            },

            onEndQuizCreation() {
                this.currentStep = 1;
                this.quiz = null;
                this.questionsCreated = 0;
            }
        }
    }
</script>