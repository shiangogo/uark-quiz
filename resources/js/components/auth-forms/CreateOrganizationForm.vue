<template>
    <div class="max-w-md mx-auto my-10">
        <h2 class="text-2xl font-bold mb-5">建立機關單位</h2>
        <form @submit.prevent="createOrganization" class="auth-form">
            <div>
                <label for="org-no" class="auth-label">編號</label>
                <input type="text" id="org-no" v-model="orgNo" class="auth-form-input">
            </div>

            <div>
                <label for="title" class="auth-form-label">名稱</label>
                <input type="text" id="title" v-model="title" class="auth-form-input">
            </div>
            <div>
                <button type="submit" class="auth-form-submit">建立機關單位</button>
            </div>
        </form>
        <div class="auth-switch-btn-container">
            <button @click.prevent="authOptionStore.goToLogin" class="auth-switch-btn">登入頁面</button>
            <button @click.prevent="authOptionStore.goToRegister" class="auth-switch-btn">註冊頁面</button>
        </div>
    </div>
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
