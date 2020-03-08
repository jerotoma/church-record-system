import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const givingRequiredFields = {
    name: {
        required: required,
        minLength: minLength(3)
    },
    amount: {
        required: required,
        minLength: minLength(3)
    },
    targetNumber: {
        required: required,
        minLength: minLength(3)
    },
    minAmount: {
        required: required,
        minLength: minLength(3)
    },
    maxAmount: {
        required: required,
        minLength: minLength(3)
    },
    description: {
        required: required,
        minLength: minLength(3)
    },
};

export const givingForm = {
    id: null,
    name: null,
    amount: null,
    maxAmount: null,
    minAmount: null,
    description: null,
    targetNumber: null,
}
