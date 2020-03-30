import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const userRequiredFields = {
    firstName: {
        required: required,
        minLength: minLength(3)
    },
    lastName: {
        required: required,
        minLength: minLength(3)
    },
    username: {
        required: required,
        maxLength: minLength(3)
    },
    email: {
        required: required,
        email: email
    },
    password: {
        required: required,
        minLength: minLength(3)
    },
    confirmPassword: {
        required: required,
        minLength: minLength(3),
        sameAsPassword: sameAs('password')
    },
    roleId: {
        required: required,
    },
};

export const userForm = {
    firstName: null,
    lastName: null,
    username: null,
    email: null,
    password: null,
    gender: '',
    roleId: null,
    confirmPassword: null,
    streetAddress: null,
    unitNumber: null,
    city: null,
    country: null,
    state: null,
    postalCode: null,
}
