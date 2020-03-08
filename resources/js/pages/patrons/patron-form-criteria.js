import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const patronRequiredFields = {
    memberIds: {
        required: required
    },
    givingId: {
        required: required,
    },
    amount: {
        required: required,
    },
    datePaid: {
        required: required
    },
};

export const patronForm = {
    id: null,
    memberIds: [],
    givingId: null,
    amount: null,
    datePaid: null,
}
