<template>
    <div class="max-w-md mx-auto my-10">
      <h2 class="text-2xl font-bold mb-5">請登入</h2>
      <form @submit.prevent="createSession" class="auth-form">
        <div>
          <label for="account" class="auth-form-label">帳號</label>
          <input type="text" id="account" v-model="account" class="auth-form-input" />
        </div>
        <div>
          <label for="password" class="auth-form-label">密碼</label>
          <input type="password" id="password" v-model="password" class="auth-form-input" />
        </div>
        <div>
          <button type="submit" class="auth-form-submit">
            登入
          </button>
        </div>
      </form>
      <div class="auth-switch-btn-container">
        <button @click.prevent="authOptionStore.goToRegister" class="auth-switch-btn">
          註冊頁面
        </button>
        <button @click.prevent="authOptionStore.goToCreateOrganization" class="auth-switch-btn">
          建立機關單位頁面
        </button>
      </div>
    </div>
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
