import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const patronRequiredFields = {
    memberId: {
        required: required,
        minLength: minLength(3)
    },
    givingId: {
        required: required,
        minLength: minLength(3)
    },
    amount: {
        required: required,
        minLength: minLength(3)
    },
    datePaid: {
        required: required,
        minLength: minLength(3)
    },
};

export const patronForm = {
    id: null,
    memberId: null,
    givingId: null,
    amount: null,
    datePaid: null,
}
