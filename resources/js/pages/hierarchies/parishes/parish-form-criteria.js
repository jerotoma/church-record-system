import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const parishRequiredFields = {
    name: {
        required: required,
        minLength: minLength(3)
    },
    code: {
        required: required,
        minLength: minLength(3)
    },
};

export const parishForm = {
    name: null,
    code: null,
    id: null,
}
