<template>
    <LoginForm v-if="authOptionStore.authOption === authOptions.LOGIN"/>
    <RegisterForm v-if="authOptionStore.authOption === authOptions.REGISTER"/>
    <CreateOrganizationForm v-if="authOptionStore.authOption === authOptions.CREATE_ORGANIZATION"/>
</template>

<script setup>
import RegisterForm from './auth-forms/RegisterForm.vue';
import LoginForm from './auth-forms/LoginForm.vue';
import CreateOrganizationForm from './auth-forms/CreateOrganizationForm.vue';
import { onMounted } from 'vue';
import { useAuthOptionStore } from '../stores/authOption';

const authOptionStore = useAuthOptionStore();

const authOptions = authOptionStore.authOptions;

const props = defineProps({
    authOption: Number
})


onMounted(() => {
    authOptionStore.setAuthOption(props.authOption);
})

</script>
