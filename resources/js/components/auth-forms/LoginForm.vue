<template>
    <h2>請登入</h2>
    <form @submit.prevent="createSession">
        <label for="account">帳號</label>
        <input type="text" id="account" v-model="account">
        
        <label for="password">密碼</label>
        <input type="password" id="password" v-model="password">

        <button type="submit">登入</button>
    </form>
    <button @click.prevent="authOptionStore.goToRegister">註冊頁面</button>
    <button @click.prevent="authOptionStore.goToCreateOrganization">建立機關單位頁面</button>
</template>

<script setup>
import { useAuthOptionStore } from '../../stores/authOption';
import { ref } from 'vue';

const authOptionStore = useAuthOptionStore();

const baseUrl = document.head.querySelector('meta[name="base-url"]').getAttribute('content');
const account = ref('');
const password = ref('');

async function createSession() {
    if (account.value === '' || password.value === '') {
        alert('帳號或密碼不得為空');
    }
    try {
        const response = await axios.post(baseUrl + '/sessions', {
            account: account.value,
            password: password.value
        });

        if (response.status === 201) {
            alert(response.data.success);
            window.location.href = baseUrl;
        }

    } catch(e) {
        console.error(e);
        alert(e?.response?.data?.message)
    }
}
</script>
