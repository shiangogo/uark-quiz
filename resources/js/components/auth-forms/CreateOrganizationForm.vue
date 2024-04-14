<template>
    <h2>建立機關單位</h2>
    <form @submit.prevent="createOrganization">
        <label for="org-no">編號</label>
        <input type="text" id="org-no" v-model="orgNo">

        <label for="title">名稱</label>
        <input type="text" id="title" v-model="title">
        <button type="submit">建立機關單位</button>
    </form>
    <button @click.prevent="authOptionStore.goToLogin">登入頁面</button>
    <button @click.prevent="authOptionStore.goToRegister">註冊頁面</button>
</template>

<script setup>
import { useAuthOptionStore } from '../../stores/authOption';
import { ref } from 'vue';

const authOptionStore = useAuthOptionStore();

const orgNo = ref('');
const title = ref('');
const baseUrl = document.head.querySelector('meta[name="base-url"]').getAttribute('content');

async function createOrganization() {
    if (orgNo.value === '' || title.value === '') {
        alert('必填欄位不得為空');
    }

    try {

        const response = await axios.post(baseUrl + '/organizations', {
            org_no: orgNo.value,
            title: title.value
        });

        if (response.status === 201) {
            alert(response.data.success);
            window.location.href = baseUrl;
        }
    } catch(e) {
        console.error(e);
        alert('建立機關單位失敗');
    }
}
</script>
