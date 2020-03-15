import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const permissionRequiredFields = {
    name: {
        required: required,
        minLength: minLength(3)
    },
    slug: {
        required: required,
        minLength: minLength(3)
    },
    model: {
        required: required,
        minLength: minLength(3)
    },
    description: {
        required: required,
        minLength: minLength(3)
    },
};

export const permissionForm = {
    id: null,
    name: null,
    slug: null,
    model: null,
    description: null
}
