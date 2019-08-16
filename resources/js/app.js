import Vue from 'vue';

// Import quiz component
Vue.component('quiz', require('./vue-components/quiz/components/quiz-main.vue').default);
Vue.component('create-quiz', require('./vue-components/quiz/components/create-quiz-main.vue').default);

new Vue({
    el: '#app',
});