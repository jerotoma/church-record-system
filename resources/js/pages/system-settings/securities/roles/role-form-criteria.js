import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const roleRequiredFields = {
    name: {
        required: required,
        minLength: minLength(3)
    },
    slug: {
        required: required,
        minLength: minLength(3)
    },
    level: {
        required: required,
        minLength: minLength(1)
    },
    description: {
        required: required,
        minLength: minLength(3)
    },
};

export const roleForm = {
    id: null,
    name: null,
    slug: null,
    level: null,
    description: null
}
