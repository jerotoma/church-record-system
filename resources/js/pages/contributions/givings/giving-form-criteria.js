import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const givingRequiredFields = {
    memberIds: {
        required: required
    },
    givingTypeId: {
        required: required,
    },
    amount: {
        required: required,
    },
    datePaid: {
        required: required
    },
};

export const givingForm = {
    id: null,
    memberIds: [],
    givingTypeId: null,
    amount: null,
    datePaid: null,
}
