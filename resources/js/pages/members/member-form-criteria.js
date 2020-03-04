import {
    required,
    email,
    minLength,
    maxLength,
    sameAs,
} from 'vuelidate/lib/validators';
export const memberRequiredFields = {
    firstName: {
        required: required,
        minLength: minLength(3)
    },
    lastName: {
        required: required,
        minLength: minLength(3)
    },
    middleName: {
        required: required,
    },
    emailAddress: {
        required: required,
        email: email
    },
    phoneNumber: {
        required: required,
        minLength: minLength(3)
    },
    occupation: {
        required: required,
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
    parishId: {
        required: required,
    },
    zoneId: {
        required: required,
    },
    communityId: {
        required: required,
    }
};

export const memberForm = {
    firstName: null,
    lastName: null,
    middleName: null,
    emailAddress: null,
    phoneNumber: null,
    gender: 'male',
    occupation: null,
    streetAddress: null,
    parishId: null,
    zoneId: null,
    communityId: null,
    unitNumber: null,
    city: null,
    country: null,
    state: null,
    postalCode: null,
}
