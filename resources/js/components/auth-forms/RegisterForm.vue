<template>
    <h2>註冊新帳戶</h2>
    <form @submit.prevent="createUser">
        <label for="org-no">機關編號</label>
        <input type="text" id="org-no" v-model="orgNo">

        <label for="name">姓名</label>
        <input type="text" id="name" v-model="name">

        <label for="birthday">生日</label>
        <input type="date" id="birthday" v-model="birthday">

        <label for="email">Email</label>
        <input type="email" id="email" v-model="email">

        <label for="account">帳號</label>
        <input type="text" id="account" v-model="account">
        
        <label for="password">密碼</label>
        <input type="password" id="password" v-model="password">

        <label for="apply-file">申請文件</label>
        <input type="file" id="apply-file" @change="handleFileChange">
        <button type="submit">建立帳戶</button>
    </form>
    <button @click.prevent="authOptionStore.goToLogin">登入頁面</button>
    <button @click.prevent="authOptionStore.goToCreateOrganization">建立機關單位頁面</button>
</template>

<script setup>
    import { useAuthOptionStore } from '../../stores/authOption';
    import { ref } from 'vue';

    const authOptionStore = useAuthOptionStore();

    const authOptions = authOptionStore.authOptions;

    const orgNo = ref('');
    const name = ref('');
    const birthday = ref('');
    const email = ref('');
    const account = ref('');
    const password = ref('');
    const baseUrl = document.head.querySelector('meta[name="base-url"]').getAttribute('content');
    let applyFile = null;

    function handleFileChange(event) {
        applyFile = event.target.files[0];
        console.log(applyFile);
    }

    async function createUser() {
        if (orgNo.value === '' || name.value === '' || email.value === '' || account.value === '' || password.value === '' || !applyFile) {
            alert('必填欄位不得為空');
            return;
        }

        if (password.value.length < 8) {
            alert('密碼長度不得少於 8 個字元');
            return;
        }

        if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(email.value)) {
            alert('請輸入正確的 Email');
            return;
        }

        const formData = new FormData();
        formData.append('org_no', orgNo.value);
        formData.append('name', name.value);
        formData.append('birthday', birthday.value);
        formData.append('email', email.value);
        formData.append('account', account.value);
        formData.append('password', password.value);
        formData.append('apply_file', applyFile);

        try {
            const response = await axios.post(baseUrl + '/users', formData);
            if (response.status === 201) {
                alert('帳號建立成功，請重新登入。');
                window.history.pushState({}, '', baseUrl + '/sessions/new');
                authOptionStore.setAuthOption(authOptions.LOGIN);
            }
        } catch(e) {
            console.error(e);
            alert(e?.response?.data?.message);
        }
    }
</script>
