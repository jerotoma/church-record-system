import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const communityRequiredFields = {
    name: {
        required: required,
        minLength: minLength(3)
    },
    code: {
        required: required
    },
    zoneId: {
        required: required,
    },
};

export const communityForm = {
    name: null,
    code: null,
    id: null,
    zoneId: null,
    parishId: null,
}
