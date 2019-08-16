
class Quiz {
    constructor() {
        /** @type {?int} */
        this.id = null;

        /** @type {string} */
        this.title = '';
    }

    static fromArray (rawData) {
        let quiz = new Quiz();

        quiz.id = rawData.id;
        quiz.title = rawData.title;

        return quiz;
    }
}

class Question {
    constructor() {
        /** @type {string} */
        this.text = '';

        /** @type {Array<Answer>>} */
        this.answers = [];
    }

    static fromArray (rawData) {
        let question = new Question();

        question.text = rawData.text;
        question.answers = rawData.answers.map((answerDatum) => {
            return Answer.fromArray(answerDatum);
        });

        return question;
    }
}

class Answer {
    constructor() {
        /** @type {string} */
        this.text = '';

        /** @type {boolean} */
        this.isCorrect = false;
    }

    static fromArray (rawData) {
        let answer = new Answer();

        answer.text = rawData.text;
        answer.isCorrect = rawData.isCorrect;

        return answer;
    }
}

export {Quiz, Question, Answer}