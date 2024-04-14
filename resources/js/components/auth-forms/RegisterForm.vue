<template>
    <div class="max-w-md mx-auto my-10">
        <h2 class="text-2xl font-bold mb-5">註冊新帳戶</h2>
        <form @submit.prevent="createUser" class="auth-form">
            <div>
                <label for="org-no" class="auth-form-label">機關編號<span class="text-red-500 text-sm">(必填)</span></label>
                <input type="text" id="org-no" v-model="orgNo" class="auth-form-input">
            </div>

            <div>
                <label for="name" class="auth-form-label">姓名<span class="text-red-500 text-sm">(必填)</span></label>
                <input type="text" id="name" v-model="name" class="auth-form-input">
            </div>

            <div>
                <label for="birthday" class="auth-form-label">生日</label>
                <input type="date" id="birthday" v-model="birthday" class="auth-form-input">
            </div>

            <div>
                <label for="email" class="auth-form-label">Email<span class="text-red-500 text-sm">(必填)</span></label>
                <input type="email" id="email" v-model="email" class="auth-form-input">
            </div>

            <div>
                <label for="account" class="auth-form-label">帳號<span class="text-red-500 text-sm">(必填)</span></label>
                <input type="text" id="account" v-model="account" class="auth-form-input">
            </div>
        
            <div>
                <label for="password" class="auth-form-label">密碼<span class="text-red-500 text-sm">(必填)</span></label>
                <input type="password" id="password" v-model="password" class="auth-form-input">
            </div>

            <div>
                <label for="apply-file" class="auth-form-label">申請文件<span class="text-red-500 text-sm">(必填)</span></label>
                <input type="file" id="apply-file" @change="handleFileChange" class="auth-form-input">
            </div>
            
            <div>
                <button type="submit" class="auth-form-submit">建立帳戶</button>
            </div>
        </form>
        <div>
            <button @click.prevent="authOptionStore.goToLogin" class="auth-switch-btn">登入頁面</button>
            <button @click.prevent="authOptionStore.goToCreateOrganization" class="auth-switch-btn">建立機關單位頁面</button>
        </div>
    </div>
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
