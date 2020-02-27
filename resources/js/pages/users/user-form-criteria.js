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
    emailAddress: {
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
    streetAddress: {
        required: required,
    },
    city: {
        required: required,
    },
    country: {
        required: required,
    },
    state: {
        required: required,
    },
    postalCode: {
        required: required,
    },
};

export const userForm = {
    firstName: null,
    lastName: null,
    username: null,
    emailAddress: null,
    password: null,
    gender: 'male',
    confirmPassword: null,
    streetAddress: null,
    unitNumber: null,
    city: null,
    country: null,
    state: null,
    postalCode: null,
}



