import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const parishRequiredFields = {
    parishName: {
        required: required,
        minLength: minLength(3)
    },
    parishCode: {
        required: required,
        minLength: minLength(3)
    },
};

export const parishForm = {
    parishName: null,
    parishCode: null,
    parishID: null,
}
