import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const zoneRequiredFields = {
    name: {
        required: required,
        minLength: minLength(3)
    },
    code: {
        required: required,
        minLength: minLength(3)
    },
};

export const zoneForm = {
    name: null,
    code: null,
    id: null,
    parishId: null,
}
