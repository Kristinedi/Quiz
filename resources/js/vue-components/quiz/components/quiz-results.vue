<template>
    <div>
        <h1 class="mb-4">Quiz Results</h1>
        <h2 class="mb-4">Thank you, {{ name }}!</h2>

        <p>You have answered correctly to {{ result.correctAnswerCount }} out of {{ currentQuiz.questionCount }} questions</p>

        <div class="my-3">
            <b-progress class="mt-2" :max="currentQuiz.questionCount" show-value height="1rem">
                <b-progress-bar :value="result.correctAnswerCount" variant="success"></b-progress-bar>
                <b-progress-bar :value="currentQuiz.questionCount - result.correctAnswerCount" variant="danger"></b-progress-bar>
            </b-progress>
        </div>

        <button class="btn btn-info" @click="endQuiz">Go to start</button>
    </div>
</template>

<script>
    export default {
        props: {
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
            },

            name: {
                required: true,
            }
        },

        methods: {
            endQuiz() {
                this.$emit('quiz-finished');
            }
        }
    }
</script>
